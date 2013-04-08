<?php
namespace BoilerAppDisplayTest\Factory;
class TranslatorFactoryTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppDisplay\Factory\TranslatorServiceFactory
	 */
	protected $translatorServiceFactory;

	public function setUp(){
		$this->translatorServiceFactory = new \BoilerAppDisplay\Factory\TranslatorFactory();
	}

	public function testCreateService(){
		$this->assertInstanceOf('BoilerAppDisplay\Translator\Translator',$this->translatorServiceFactory->createService(\BoilerAppDisplayTest\Bootstrap::getServiceManager()));
    }
}