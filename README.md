# SMS Poh LARAVEL SDK
https://smspoh.com/

This is my personal library to make it easier for developers. This is not offical SDK for smspoh.
The main goal to create this package is I hate curl , guzzle or etc .... And I made abstraction.
Now I could use easily by calling like this. That is it.

``` php
send_smspoh(
    ['+959790646062','+95943160544'],
    'Nice to meet you'
);
```

## Install

Via Composer

``` bash
$ composer require pyaesone17/sms-poh:^1.1
```

## Set Up

Publish the config file first.
``` bash
$ php artisan vendor:publish
```

Configure the token in the sms-poh.php config file.
```
'token' => env('SMS_POH_TOKEN', 'Your_token_from_the_dashboard'),
```

## SDK Usage 

For fetching messages.

1. Using Facade
``` php
$results = SmsPohFacade::fetch(1);
```

2.Using Container 
``` php
$sms = app()->make(pyaesone17\SmsPoh\SmsPoh::class);
$results = $sms->fetch(1);
```

3.Using function 
``` php
$resutls = fetch_smspoh(1);
```

For sending messages.

1. Using Facade
``` php
$results = SmsPohFacade::send(
    ['+959790646062','+95943160544'],
    'Nice to meet you'
);

$results = SmsPohFacade::send(
    '+959790646062',
    'Nice to meet you'
);
```

2.Using Container 
``` php
$sms = app()->make(pyaesone17\SmsPoh\SmsPoh::class);
$results = $sms->send(
    ['+959790646062','+95943160544'],
    'Nice to meet you'
);
```

3.Using function 
``` php
$results = send_smspoh(
    ['+959790646062','+95943160544'],
    'Nice to meet you'
);
```

If you want to send message as testing purpose, you could pass true as a third parameter.

## Notification Channel Usage

This package also include custom notification channel for interacting with Laravel Notification features.
Here is how to use it.

``` php

class SendSmsPohNotification extends Notification
{
    use Queueable;

    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [pyaesone17\SmsPoh\SmsPohChannel::class];
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toMMSms($notifiable)
    {
        return [
            'message' => $this->message,
            'to' => '+959790646062',
            'test' => 1,
            'callback' => function (...$result)
            {
                // After sms is being sent or failed
                // The callback will fire, here you can
                // do whatever you want with the result.
                // If you don't want, just pass as null
                dd($result);
            }
        ];
    }
```

And Notify like this 

```
$user = App\User::first();
$user->notify(new App\Notifications\SendSmsPohNotification("Hello world"));
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/:vendor/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/:vendor/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/:vendor/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/:vendor/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/:vendor/:package_name.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/:vendor/:package_name
[link-travis]: https://travis-ci.org/:vendor/:package_name
[link-scrutinizer]: https://scrutinizer-ci.com/g/:vendor/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/:vendor/:package_name
[link-downloads]: https://packagist.org/packages/:vendor/:package_name
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
