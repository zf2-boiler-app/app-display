<?php
namespace BoilerAppDisplayTest\Factory;
class TranslatorServiceFactoryTest extends \PHPUnit_Framework_TestCase{
	/**
	 * @var \BoilerAppDisplay\Factory\TranslatorServiceFactory
	 */
	protected $translatorServiceFactory;

	public function setUp(){
		$this->translatorServiceFactory = new \BoilerAppDisplay\Translator\TranslatorServiceFactory();
	}

	public function testCreateService(){
		$this->assertInstanceOf('BoilerAppDisplay\Translator\Translator',$this->translatorServiceFactory->createService(\BoilerAppDisplayTest\Bootstrap::getServiceManager()));
    }
}