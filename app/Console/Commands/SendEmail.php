<?php

namespace App\Console\Commands;
use App\Services\MessageLog;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use Illuminate\Console\Command;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email with command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $message = "Send all user email message";
        $users = User::all();

        try {
            foreach ($users as $user) {
                $messgaeLog = new MessageLog();
                $messgaeLog->storeHistory($user->id, $message);
                Mail::to($user->email)->queue(new SendMail($message));
            }
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }

        $this->info('Email sent to all users successfully!');
    }
}
