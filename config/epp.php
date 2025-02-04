<?php

return [
    /*
    |--------------------------------------------------------------------------
    | EPP Server Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the EPP (Extensible Provisioning Protocol) server connection.
    |
    */

    'username' => env('EPP_USERNAME', 'bluhub_rwf'),
    'password' => env('EPP_PASSWORD', 'CVQTsh8R64CCdt6G'),
    'server' => env('EPP_SERVER', 'registry.ricta.org.rw'),
    'port' => env('EPP_PORT', '700'),
    'certificate' => storage_path('app/certificate/test.pem'),
    'ssl' => env('EPP_SSL', true),
];
