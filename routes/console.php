<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use \Illuminate\Support\Facades\Schedule;
Schedule::job(new \App\Jobs\SendNotificationWidthSms())->everyFiveMinutes();
Schedule::command('queue:work --stop-when-empty --queue sendNotificationWidthSms')->everyMinute()->runInBackground();
