<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use \App\Jobs\VoucherBankArrangementJob;
use \App\Jobs\transmissionsBankArrangementJob;
\Illuminate\Support\Facades\Schedule::job(new \App\Jobs\SmartCleaningOfTheShoppingCart)->everyMinute();
\Illuminate\Support\Facades\Schedule::command('queue:work --stop-when-empty --queue CleaningOfTheShoppingCart')->runInBackground()->everyMinute();
\Illuminate\Support\Facades\Schedule::command('queue:work --stop-when-empty --queue warning')->everyFiveMinutes();
