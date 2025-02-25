<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use \Illuminate\Support\Facades\Schedule;
Schedule::job(new \App\Jobs\SmartCleaningOfTheShoppingCart)->everyMinute();
Schedule::command('queue:work --stop-when-empty --queue CleaningOfTheShoppingCart')->runInBackground()->everyMinute();
