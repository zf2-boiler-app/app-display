<?php
namespace BoilerAppDisplayTest\Factory;
class TemplatingServiceFactoryTest extends \PHPUnit_Framework_TestCase{
    /**
     * @var \BoilerAppDisplay\Factory\TemplatingServiceFactory
     */
    protected $templatingServiceFactory;

    public function setUp(){
    	$this->templatingServiceFactory = new \BoilerAppDisplay\Factory\TemplatingServiceFactory();
    }

    public function testCreateService(){
    	$this->assertInstanceOf('BoilerAppDisplay\Service\TemplatingService',$this->templatingServiceFactory->createService(\BoilerAppDisplayTest\Bootstrap::getServiceManager()));
    }
}