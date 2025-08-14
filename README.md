# Vdlp.Glide

Glide is a wonderfully easy on-demand image manipulation library written in PHP. 
Its straightforward API is exposed via HTTP, similar to cloud image processing services like Imgix and Cloudinary. 
Glide leverages powerful libraries like Intervention Image (for image handling and manipulation) and Flysystem (for file system abstraction).

## Requirements

* PHP 8.0.2 or higher
* October CMS 2.x or higher

## Installation

```
composer require vdlp/oc-glide-plugin
```

## Configuration

To configure this plugin execute the following command:

```
php artisan vendor:publish --provider="Vdlp\Glide\ServiceProviders\GlideServiceProvider" --tag="config"
```

This will create a `config/glide.php` file in your app where you can modify the configuration.

Modify the environment file by adding the following lines:

```
GLIDE_IMAGE_DRIVER = "gd"
GLIDE_SIGN_KEY = "[YOUR SIGN KEY HERE]"
```

> We recommend using a 128 character (or larger) signing key to prevent trivial key attacks. Consider using a package like [CryptoKey](https://github.com/AndrewCarterUK/CryptoKey) to generate a secure key.

For more details about the security and why a sign key is used, check [glide.thephpleague.com](https://glide.thephpleague.com/2.0/config/security/).

Add an url to your disk in the `config/filesystem.php` to display the images properly, for example:

```diff
    ...

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
+           'url' => 'storage/app/',
        ],

    ],

    ...
```

## Example

Here you can see some basic examples of how to use this plugin. Out of the box, the default configuration used is `main`.

```

<!-- URL: images/main/media/test.jpg?s=5ef7c430ebb5a3b0fbfce160ae6de275 -->
<img src="{{ 'media/test.jpg'|thumb() }}" />

<!-- URL: images/main/media/test.jpg?w=50&h=50&s=36b0575d9556f32e7e7a3bc2e551ccb2 -->
<img src="{{ 'media/test.jpg'|thumb({w: 50, h: 50}) }}" />

```

## Questions? Need help?

If you have any question about how to use this plugin, please don't hesitate to contact us at octobercms@vdlp.nl. 
We're happy to help you. You can also visit the support forum and drop your questions/issues there.
