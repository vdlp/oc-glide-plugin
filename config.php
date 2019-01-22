<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Glide Server
    |--------------------------------------------------------------------------
    |
    | This option controls the default server that gets used while using this
    | glide plugin. This configuration is used when another is not explicitly
    | specified.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Glide Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the glide "servers" for
    | your application.
    |
    */

    'servers' => [
        'main' => [
            # Source filesystem
            'source' => 'local',

            # Source filesystem path prefix
            'source_path_prefix' => '',

            # Cache filesystem
            'cache' => 'local',

            # Cache filesystem path prefix
            'cache_path_prefix' => '.cache',

            # Watermarks filesystem
            'watermarks' => 'local',

            # Watermarks filesystem path prefix
            'watermarks_path_prefix' => '',

            # Image driver (gd or imagick)
            'driver' => env('GLIDE_IMAGE_DRIVER', 'gd'),

            # Image size limit
            'max_image_size' => 2000 * 2000,

            # Secure your Glide image server with HTTP signatures.
            'signatures' => true,

            # Sign Key - A 128 character (or larger) signing key is recommended.
            'sign_key' => env('GLIDE_SIGN_KEY'),

            # Base URL of the images
            'base_url' => '',

            # Default image manipulations
            # see http://glide.thephpleague.com/1.0/config/defaults-and-presets/
            'defaults' => [
                // Examples:
                // 'mark' => 'logo.png',
                // 'markw' => '30w',
                // 'markpad' => '5w',
            ],

            # Preset image manipulations
            # see http://glide.thephpleague.com/1.0/config/defaults-and-presets/
            'presets' => [
                // Examples:
                // 'small' => [
                //     'w' => 200,
                //     'h' => 200,
                //     'fit' => 'crop',
                // ],
                // 'medium' => [
                //     'w' => 600,
                //     'h' => 400,
                //     'fit' => 'crop',
                // ],
            ],
        ],
    ],
];
