<?php
namespace BoilerAppDisplayTest;
error_reporting(E_ALL | E_STRICT);
chdir(dirname(__DIR__));
if(is_readable($sBoilerAppTestBootstrapPath = __DIR__.'/../vendor/zf2-boiler-app/app-test/src/BoilerAppTest/AbstractBootstrap.php'))include $sBoilerAppTestBootstrapPath;
if(!class_exists('BoilerAppTest\AbstractBootstrap'))throw new \RuntimeException('Unable to load BoilerAppTest Bootstrap. Install required libraries through `composer`');
class Bootstrap extends \BoilerAppTest\AbstractBootstrap{}
Bootstrap::init();