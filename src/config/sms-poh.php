<?php 

return [

    /*
    |--------------------------------------------------------------------------
    | Auth Token
    |--------------------------------------------------------------------------
    |
    | This value is the token of your application for SMS Poh.
    | You can find it on profile/api-credential/auth-key
    |
    */

    'token' => env('SMS_POH_TOKEN', '4baQqzOUZmyBiD2tdYCQ4WSBziBBhNwIMmOHCMpcY0PoJ6w04HLX1SBOdaua_HHL'),

    /*
    |--------------------------------------------------------------------------
    | API endpoint
    |--------------------------------------------------------------------------
    |
    | This value is the entry point for api 
    |
    */

    'end_point' => env('SMS_POH_ENDPOINT', 'https://smspoh.com/api/v1')
];