<?php
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Redis Manager Base Path
    |--------------------------------------------------------------------------
    |
    | Base path for Redis Manager
    |
    */

    'base_path' => 'redis-manager',

    /*
    |--------------------------------------------------------------------------
    | Redis Manager Middleware
    |--------------------------------------------------------------------------
    |
    | The Redis Manager's route middleware.
    |
    */

    'middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Redis Manager Disable Commands
    |--------------------------------------------------------------------------
    |
    | The commands listed here was disabled when you use Redis Manager Console
    | to run commands. Feel free to add commands here which you do not want
    | users to use.
    |
    */

    'disable_commands' => [
        'flushdb',
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Manager Information
    |--------------------------------------------------------------------------
    |
    | Here you can set some information for Redis Manager.
    | Use kv-pair format.
    |
    */

    'info' => [],

    /*
    |--------------------------------------------------------------------------
    | Redis Manager Data Types
    |--------------------------------------------------------------------------
    |
    | Determine which data types to use.
    | If in read-only mode, all of the 'POST'/'PUT'/'DELETE' requests will be aborted.
    |
    */

    'readonly' => true,
];
