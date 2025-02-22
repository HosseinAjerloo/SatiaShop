<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterPasswordRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\SendCodeWithSmsRequest;
use App\Http\Requests\Auth\SimpleLoginPost;
use App\Http\Traits\HasCart;
use App\Http\Traits\HasLogin;
use App\Models\Otp;
use App\Models\User;
use App\Services\SmsService\SatiaService;
use Carbon\Carbon;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LoginController extends Controller
{
    use HasLogin,HasCart;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Auth.login');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $cart=\session()->get('cart_id');
            Auth::logout();
            \session(['cart_id'=>$cart]);
        }
        return redirect()->route('panel.index');

    }

    public function simpleLogin(Request $request)
    {
        return view('Auth.simpleLogin');
    }

    public function simpleLoginPost(SimpleLoginPost $simpleLoginPost)
    {
        $user = User::where("mobile", $simpleLoginPost->mobile)->first();
        $inputs = $simpleLoginPost->all();

        $validPassword = password_verify($inputs['password'], $user->password);


        if (!$validPassword)
            return redirect()->back()->withErrors(['passwordNotMatch' => 'کلمه عبور وارد شده صحیح نمیباشد']);

        $remember = $simpleLoginPost->has('rememberMe') ? true : false;
        $cart=\session()->get('cart_id');
        Auth::loginUsingId($user->id, $remember);
        \session(['cart_id'=>$cart]);
        $this->ipConnectionToUserID();
        return redirect()->intended(route('panel.index'));
    }


    public function forgotPassword(Request $request)
    {
        return view('Auth.forgot');
    }

    public function sendLinkForget(SendCodeWithSmsRequest $request)
    {
        $message = 'باسلام جهت تغییر کلمه عبور خود روی لینک زیر کلیک کنید' . PHP_EOL;
        $token = $this->generateCode($request, $message);
        return redirect()->route('update.Password', $token->token);
    }

    public function updatePassword(Otp $otp)
    {
        if (!empty($otp->seen_at))
            return redirect()->route('login.index')->withErrors(['token' => 'لینک ارسالی معتبر نمیباشد']);

        return redirect()->route('login.index')->with(['success' => 'لینک ویرایش کلمه عبور برای شما ارسال شد.']);

    }

    public function updatePasswordPost(RegisterPasswordRequest $request, Otp $otp)
    {
        if (!empty($otp->seen_at))
            return redirect()->route('login.index')->withErrors(['token' => 'لینک ارسالی معتبر نمیباشد']);

        $otp->update(['seen_at' => date('Y-m-d H:i:s')]);
        $inputs = $request->all();
        $user = User::where('mobile', $otp->mobile)->first();
        $result = $user->update([
            'password' => password_hash($inputs['password'], PASSWORD_DEFAULT)
        ]);
        return $result ? redirect()->route('login.index')->with(['success' => 'کلمه عبور شما ویرایش شد']) : redirect()->route('login.index')->withErrors(['token' => 'عملیات ویرایش کلمه عبور با شکست روبه رو شد لطفا چند دقیقه دیگر تلاش فرمایید']);


    }

    public function forgotPasswordToken(Request $request, Otp $otp)
    {
        if (!empty($otp->seen))
            return redirect()->route('login.simple')->withErrors(['invalidOtp' => 'لینک وارد شده معتبر نمیباشد']);

        if (!Session::has('user'))
            Session::put(['user' => User::where('mobile', $otp->mobile)->first()->id]);

        $otp->update(['seen_at' => date('Y-m-d H:i:s')]);
        return view('Auth.updatePassword', compact('otp'));
    }

    public function register()
    {
        return view('Auth.register');
    }


    public function registerUser(RegisterRequest $request, Otp $otp)
    {
        $inputs = $request->all();
        $expiration = Carbon::now()->subMinutes(3)->toDateTimeString();
        $otp = $otp->where('created_at', ">", $expiration)->where('token', $otp->token)->whereNull('seen_at')->first();
        if (!$otp) {
            return redirect()->route('register')->withErrors(['expiration_at' => "مدت زمان استفاده از کد گذشته است و یا کد وارده صحیح نمیباشد "]);
        }
        $code = $otp->where('code', $inputs['code'])->whereNull('seen_at')->where('token', $otp->token)->where('created_at', ">", $expiration)->first();
        if ($code) {
            $user = User::firstOrCreate(['mobile' => $code->mobile], [
                'mobile' => $code->mobile
            ]);
            $user->update([
                'password' => password_hash($inputs['password'], PASSWORD_DEFAULT)
            ]);
            $code->update(['seen_at' => date('Y/m/d H:i:s', time())]);
            $cart=\session()->get('cart_id');
            Auth::loginUsingId($user->id);
            \session(['cart_id'=>$cart]);

            return redirect()->intended(route('panel.index'));
        } else {
            return redirect()->route('register', $otp->token)->withErrors(['expiration_at' => "کد وارد شده صحیح نمیباشد "]);
        }

    }


    public function ssoLink()
    {
        $state = Str::uuid()->toString();
        session(['state' => $state]);
        $query = http_build_query([
            'client_id' => env('AUTH_CLIENT_ID'),
            'redirect_uri' => route('login.loginWithSso'),
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
            // 'prompt' => '', // "none", "consent", or "login"
        ]);
        return redirect()->away( env('AUTH_AUTHORIZE_URL') . $query);
    }

    public function loginWithSso(Request $request)
    {
        if ($request->filled('code')) {
            $state = session('state');
            throw_unless(
                strlen($state) > 0 && $state === $request->state,
                InvalidArgumentException::class,
                'Invalid state value.'
            );

            $response = Http::asForm()->post(env('AUTH_TOKEN_URL'), [
                'grant_type' => 'authorization_code',
                'client_id' => env('AUTH_CLIENT_ID'),
                'client_secret' => env('AUTH_SECRET'),
                'redirect_uri' => route('login.loginWithSso'),
                'code' => $request->code,
            ]);
            $responseObj = $response->object();
            $responseUser = Http::withHeaders([
                'Authorization' => $responseObj->token_type . ' ' . $responseObj->access_token,
            ])->get('https://oauth.satia.co/api/user');
            if($responseUser->successful()) {
                $userObj = $responseUser->object();
                $user = User::firstOrCreate([
                    'mobile' => $userObj->mobile,
                    'email'=>$userObj->user
                ], [
                   'name'=>$userObj->first_name??'',
                    'family'=>$userObj->last_name??''
                ]);

                    auth()->login($user, true);
                    session(['login_type' => 'sso']);
                    session()->forget('state');
                    return redirect()->route('panel.index');
                }
            }


    }

    public function createCode(SendCodeWithSmsRequest $request)
    {
        $token = $this->generateCode($request);
        $token->route = route('register.post', $token->token);
        return \response()->json(['message' => $token]);
    }


}
