ZF2 Boiler-App "Display" module
=====================

[![Build Status](https://travis-ci.org/zf2-boiler-app/app-display.png?branch=master)](https://travis-ci.org/zf2-boiler-app/app-display)
[![Latest Stable Version](https://poser.pugx.org/zf2-boiler-app/app-display/v/stable.png)](https://packagist.org/packages/zf2-boiler-app/app-display)
[![Total Downloads](https://poser.pugx.org/zf2-boiler-app/app-display/downloads.png)](https://packagist.org/packages/zf2-boiler-app/app-display)
![Code coverage](https://raw.github.com/zf2-boiler-app/app-test/master/ressources/100%25-code-coverage.png "100% code coverage")

NOTE : This module is in heavy development, it's not usable yet.
If you want to contribute don't hesitate, I'll review any PR.

Introduction
------------

__Boiler-App "Display" module__ is a Zend Framework 2 module that provides all part of the display management for ZF2 Boiler-App

Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (latest master)
* [AssetsBundle](https://github.com/neilime/zf2-assets-bundle) (latest master)
* [TwbBundle](https://github.com/neilime/zf2-twb-bundle) (latest master) 
* [TreeLayoutStack](https://github.com/neilime/zf2-tree-layout-stack) (latest master) 
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
    "repositories":[
        {
            "type": "package",
            "package": {
                "version": "dev-master",
                "name": "fortawesome/font-awesome",
                "source": {"url": "https://github.com/FortAwesome/Font-Awesome.git","type": "git","reference": "master"}
            }
        },
        {
            "type": "package",
            "package": {
                "version": "dev-master",
                "name": "fabiomcosta/mootools-meio-mask",
                "source": {"url": "https://github.com/fabiomcosta/mootools-meio-mask.git","type": "git","reference": "master"}
            }
        },
        {
            "type": "package",
            "package": {
                "version": "dev-master",
                "name": "arian/iFrameFormRequest",
                "source": {"url": "https://github.com/arian/iFrameFormRequest.git","type": "git","reference": "master"}
            }
        },
        {
            "type": "package",
            "package": {
                "version": "dev-master",
                "name": "nak5ive/Form.PasswordStrength",
                "source": {"url": "https://github.com/nak5ive/Form.PasswordStrength.git","type": "git","reference": "master"}
            }
        },
        {
	        "type": "vcs",
	        "url": "http://github.com/Nodge/lessphp"
	    }
    ],
    "require": {
        "zf2-boiler-app/app-display": "1.0.*"
    }
    ```

2. Now tell composer to download __ZF2 Boiler-App "Display" module__ by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Post installation

1. Enabling it in your `application.config.php` file.

    ```php
    return array(
        'modules' => array(
            // ...
	        'TwbBundle',
            'AssetsBundle',
	        'TreeLayoutStack',
	        'BoilerAppDisplay',
        ),
        // ...
    );
    ```

## Features

- Twitter bootstrap integration ([TwbBundle](https://github.com/neilime/zf2-twb-bundle))
- Assets management ([AssetsBundle](https://github.com/neilime/zf2-assets-bundle))
- Tree layout stack ([TreeLayoutStack](https://github.com/neilime/zf2-tree-layout-stack))
- Javascript facilities : 
    - Controller autoloading
    - Url & translate functions
    - Ajax loading (modal windows, forms)
    - Form validators
- Translator enhancement ([TranslatorTools](https://github.com/neilime/zf2-translator-tools))