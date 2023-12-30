<?php

namespace App\Services;

use App\Services\MessageLog;

class SendSMSService
{
    public function messageSend($user)
    {
        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = config('services.sms.api_key');
        $senderid = config('services.sms.sender_id');
        $number = $user->phone;
        $message = "Test Sms Check for user";

        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $message,
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        try {
            $responseArray = json_decode($response, true);

            if ($responseArray && $responseArray['response_code'] === '202') {
                $messageLog = new MessageLog();
                $messageLog->storeHistory($user->id, $message);
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
