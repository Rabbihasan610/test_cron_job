<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\SendSMSService;
use Illuminate\Console\Command;


class SendSMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS ALL User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        try {
            foreach ($users as $user) {
                $smsService = new SendSMSService();
                $smsService->messageSend($user);
            }
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }

        $this->info('SMS sent to all users successfully!');
    }
}
