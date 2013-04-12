<?php
namespace BoilerAppDisplayTest\Factory;
class JsControllerHelperFactoryTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppDisplay\Factory\JsControllerHelperFactory
	 */
	protected $jsControllerHelperFactory;

	public function setUp(){
		$this->jsControllerHelperFactory = new \BoilerAppDisplay\Factory\JsControllerHelperFactory();
	}

	public function testCreateService(){
		$this->assertInstanceOf(
			'BoilerAppDisplay\View\Helper\JsControllerHelper',
			$this->jsControllerHelperFactory->createService(\BoilerAppDisplayTest\Bootstrap::getServiceManager()->get('Zend\Mvc\Controller\PluginManager'))
		);
	}
}