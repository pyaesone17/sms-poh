<?php

namespace pyaesone17\SmsPoh;

use Illuminate\Notifications\Notification;

class SmsPohChannel extends Notification
{
    public function __construct($token, $endPoint)
    {
        $this->token = $token;
        $this->endPoint = $endPoint;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $client = new SmsClient($this->endPoint, $this->token);
        $payload = $notification->toMMSms($notifiable);
        
        $client->send($payload);
    }
}