<?php

namespace App\Services;
use App\Models\MessageHistory;
use Carbon\Carbon;

class MessageLog
{
    public function storeHistory($user_id, $message): void
    {

        MessageHistory::insert([
            "user_id"    => $user_id,
            "message"    => $message,
            "created_at" => Carbon::now(),
        ]);
    }
}
