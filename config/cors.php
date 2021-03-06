<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Accept'],
    'allowedMethods' => ['GET', 'POST', 'PUT', 'PATH',  'DELETE'], //['*']
    'exposedHeaders' => [],
    'maxAge' => 0,

];
