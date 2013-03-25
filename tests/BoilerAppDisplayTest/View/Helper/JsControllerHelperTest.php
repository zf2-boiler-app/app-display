<?php
namespace BoilerAppDisplayTest\View\Helper;
class JsControllerHelperTest extends \PHPUnit_Framework_TestCase{
	/**
	 * @var \BoilerAppDisplay\View\Helper\JsControllerHelper
	 */
	protected $jsControllerHelper;

	public function setUp(){
		/* @var $oViewHelperPluginManager \Zend\View\HelperPluginManager */
		$oViewHelperPluginManager = \BoilerAppDisplayTest\Bootstrap::getServiceManager()->get('view_helper_manager');

		$oRenderer = new \Zend\View\Renderer\PhpRenderer();
		$this->jsControllerHelper = $oViewHelperPluginManager->get('jsController')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
	}

	/**
	 * @throws \LogicException
	 * @return \Zend\ServiceManager\ServiceLocatorInterface
	 */
	public function testGetServiceLocator(){
		$this->assertInstanceOf('\Zend\ServiceManager\ServiceLocatorInterface',$this->jsControllerHelper->getServiceLocator());
	}

	/**
	 * Invoke helper
	 * @return
	 */
	public function testInvoke(){
		$this->assertInstanceOf('Zend\View\Helper\InlineScript',$this->jsControllerHelper->__invoke());
	}
}