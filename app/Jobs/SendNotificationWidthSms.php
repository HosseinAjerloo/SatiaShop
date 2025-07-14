<?php

namespace App\Jobs;

use App\Models\ResideItem;
use App\Services\SmsService\SatiaService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendNotificationWidthSms implements ShouldQueue
{
    use Queueable;
    public $timeout = 0;
    /**
     * Create a new job instance.
     */
    public function __construct( )
    {
        $this->onQueue('sendNotificationWidthSms');
    }
    public function tries(){
        return 3;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sms=new SatiaService();
        $time=Carbon::now()->subMonths(10)->toDateString();
        $listResideItem=ResideItem::whereIn('status',['used','recharge'])->where('flag_sms','no_send')->whereDate('created_at',$time)->get();
        foreach ($listResideItem as $item)
        {
            $sms->send("مشترک گرامی کپسول شما با شناسه ".$item->unique_code." فقط تا دوماه دیگر اعتبار دارد لطفا جهت تمیدی آن کوشا باشید",$item->reside->user->mobile);
            $item->update(['flag_sms'=>'send']);
        }
    }
}
