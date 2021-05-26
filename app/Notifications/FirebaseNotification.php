<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;
use NotificationChannels\Fcm\Resources\Notification as NotificationFirebase;
use NotificationChannels\Fcm\Resources\WebpushConfig;
use NotificationChannels\Fcm\Resources\WebpushFcmOptions;

class FirebaseNotification extends Notification
{
    use Queueable;

    /**
     * The title.
     *
     * @var string
     */
    public $title;

    /**
     * The title.
     *
     * @var string
     */
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $param)
    {
        $this->title = $param['title'];
        $this->message = $param['message'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FcmChannel::class];
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData([
                'uuid' => $notifiable->uuid,
                'datetime' => now()->toDateTimeString(),
            ])
            ->setNotification(
                NotificationFirebase::create()
                ->setTitle($this->title)
                ->setBody($this->message)
                ->setImage('https://raw.githubusercontent.com/adiyansahcode/adiyansahcode/main/assets/laravel-icon-new.svg')
            )
            ->setAndroid(
                AndroidConfig::create()
                ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )
            ->setApns(
                ApnsConfig::create()
                ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios'))
            )
            ->setWebpush(
                WebpushConfig::create()
                ->setFcmOptions(WebpushFcmOptions::create()->setAnalyticsLabel('analytics_web'))
                ->setFcmOptions(WebpushFcmOptions::create()->setLink('http://localhost:8105'))
            );
    }
}
