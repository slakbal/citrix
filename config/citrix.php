<?php

return [

    //what authentication method to use 'direct', 'oauth2'. currently only 'direct' is implemented
    'auth_type' => 'direct',

    'direct' => [
        'username'  => env('CITRIX_DIRECT_USER', 'test@test.com'),
        'password'  => env('CITRIX_DIRECT_PASSWORD', 'password123'),
        'client_id' => env('CITRIX_CONSUMER_KEY', 'abcdefg'),
    ],

    'oauth2' => [
        'client_id'     => env('CITRIX_OAUTH_CONSUMER_KEY', ''),
        'client_secret' => env('CITRIX_OAUTH_CONSUMER_SECRET', ''),
        'redirect_uri'  => env('CITRIX_OAUTH_REDIRECT_URI', 'http://example.com/return/from/oauth/'),
    ],

];