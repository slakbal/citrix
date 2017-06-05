<?php

return [

    //what authentication method to use 'direct', 'oauth2'. currently only 'direct' is implemented
    'auth_type' => 'direct',

    'direct' => [
        'username'  => env('CITRIX_DIRECT_USER', 'user.account@test.com'),
        'password'  => env('CITRIX_CONSUMER_SECRET', 'someSecret'),
        'client_id' => env('CITRIX_CONSUMER_KEY', 'someConsumerKey'),
    ],

];