# Vdlp.Glide

Glide is a wonderfully easy on-demand image manipulation library written in PHP. Its straightforward API is exposed via HTTP, similar to cloud image processing services like Imgix and Cloudinary. Glide leverages powerful libraries like Intervention Image (for image handling and manipulation) and Flysystem (for file system abstraction).

## Requirements

* PHP 7.1 or higher
* October CMS build 420 or higher

## Installation

*CLI:*

`php artisan plugin:install Vdlp.Glide`

*October CMS:*

Go to Settings > Updates & Plugins > Install plugins and search for 'Glide'.

## Configuration

To configure this plugin execute the following command:

`php artisan vendor:publish --provider="Vdlp\Glide\ServiceProviders\GlideServiceProvider" --tag="config"`

This will create a `config/glide.php` file in your app where you can modify the configuration.

Modify the environment file by adding the following lines:

```
GLIDE_IMAGE_DRIVER=gd
GLIDE_SIGN_KEY=XQ6BbuDDE256vsmpMDqb1bYVvJLLRe49GNeEgT1cCvlR5bzgaqNRlAlKiztvyaX4jfOLrOGDwgu3DFFfBHv5IlB8S5GtDTUO3q5JmomTO3CEraQuCwTtfszb0dSsk2W3
```

Add an url to your disk in the `config/filesystem.php` to display the images properly, for example:

```
    ...
    
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root'   => storage_path('app'),
            'url' => 'storage/app/',
        ],
        
    ],
    
    ...
```

## Example

Here you can see some basic examples of how to use this plugin. Out of the box, the default configuration used is `main`.

```

<img src="{{ 'test.jpg'|thumb() }}" />
<img src="{{ 'test.jpg'|thumb({w: 50, h: 50}) }}" />

```

## Questions? Need help?

If you have any question about how to use this plugin, please don't hesitate to contact us at octobercms@vdlp.nl. We're happy to help you. You can also visit the support forum and drop your questions/issues there.
