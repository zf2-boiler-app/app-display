ZF2 Boiler-App Display module
=====================

Created by Neilime

NOTE : This module is in heavy development, it's not usable yet.
If you want to contribute don't hesitate, I'll review any PR.

Introduction
------------

__Boiler-App Display module__ is a Zend Framework 2 module for ZF2 Boiler-App that allows you to manage all part of the display

Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (latest master)
* [AssetsBundle](https://github.com/neilime/zf2-assets-bundle) (latest master)
* [TwbBundle](https://github.com/neilime/zf2-twb-bundle) (latest master) 
* [Font Awesome](https://github.com/fortawesome/font-awesome) (latest master)
* [MeioMask](https://github.com/fabiomcosta/mootools-meio-mask) (latest master)
* [iFrameFormRequest](https://github.com/arian/iFrameFormRequest) (latest master)
* [Form.PasswordStrength](https://github.com/nak5ive/Form.PasswordStrength) (latest master)
* [TranslatorTools](https://github.com/neilime/zf2-translator-tools) (latest master) 

Installation
------------

### Main Setup

#### By cloning project

1. Clone this project into your `./vendor/` directory.

#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "zf2-boiler-app/app-display": "dev-master"
    }
    ```

2. Now tell composer to download __ZF2 Boiler-App Display module__ by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Post installation

1. Enabling it in your `application.config.php` file.

    ```php
    return array(
        'modules' => array(
            // ...
            'BoilerAppDisplay',
        ),
        // ...
    );
    ```

## Features

- Complex templating
- Assets management ([AssetsBundle](https://github.com/neilime/zf2-assets-bundle))
- Twitter bootstrap integration ([TwbBundle](https://github.com/neilime/zf2-twb-bundle))
- Javascript facilities : 
    - Controller autoload
    - Url & translate functions
    - Ajax loading (modal windows, forms)
- Translators enhancement ([TranslatorTools](https://github.com/neilime/zf2-translator-tools))
