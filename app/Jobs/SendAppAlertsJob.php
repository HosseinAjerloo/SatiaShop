<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Role;

use App\Services\SmsService\SatiaService;

class SendAppAlertsJob implements ShouldQueue
{
    use Queueable;

    public $timeout = 0;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $satiaService = new SatiaService();
        $alertRecipients = Role::find(1)->users;
        foreach ($alertRecipients as $user) {
            $satiaService->send($this->message, $user->mobile, '30006928', 'New137', '140101101');
        }
    }
}
