<?php
namespace BoilerAppDisplayTest\View\Helper;
class JsControllerHelperTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppDisplay\View\Helper\JsControllerHelper
	 */
	protected $jsControllerHelper;

	public function setUp(){
		$oViewHelperPluginManager = $this->getServiceManager()->get('view_helper_manager');

		$oRenderer = new \Zend\View\Renderer\PhpRenderer();
		$this->jsControllerHelper = $oViewHelperPluginManager->get('jsController')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
	}

	public function testGetServiceLocator(){
		$this->assertInstanceOf('\Zend\ServiceManager\ServiceLocatorInterface',$this->jsControllerHelper->getServiceLocator());
	}

	public function testInvoke(){
		$this->assertInstanceOf('Zend\View\Helper\InlineScript',$this->jsControllerHelper->__invoke());
	}
}