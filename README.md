# SMS Poh LARAVEL SDK

This is my personal library to make it easier for developers.

## Install

Via Composer

``` bash
$ composer require pyaesone17/sms-poh
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

## Usage

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
