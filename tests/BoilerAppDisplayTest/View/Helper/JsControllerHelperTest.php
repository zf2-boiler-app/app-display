<?php
namespace BoilerAppDisplayTest\View\Helper;
class JsControllerHelperTest extends \PHPUnit_Framework_TestCase{
	private $configuration = array(
		'view_manager' => array(
			'doctype' => 'HTML5'
		)

	);

	/**
	 * @var \BoilerAppDisplay\View\Helper\JsControllerHelper
	 */
	protected $jsControllerHelper;

	public function setUp(){
		$oServiceManager = \TwbBundleTest\Bootstrap::getServiceManager();

		$this->configuration = \Zend\Stdlib\ArrayUtils::merge($oServiceManager->get('Config'),$this->configuration);
		$bAllowOverride = $oServiceManager->getAllowOverride();
		if(!$bAllowOverride)$oServiceManager->setAllowOverride(true);
		$oServiceManager->setService('Config',$this->configuration)->setAllowOverride($bAllowOverride);


		/* @var $oViewHelperPluginManager \Zend\View\HelperPluginManager */
		$oViewHelperPluginManager = $oServiceManager->get('view_helper_manager');

		$oRenderer = new \Zend\View\Renderer\PhpRenderer();
		$this->jsControllerHelper = $oViewHelperPluginManager->get('jsController')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
	}

	/**
	 * @throws \LogicException
	 * @return \Zend\ServiceManager\ServiceLocatorInterface
	 */
	public function testGetServiceLocator(){
		$this->assertInstanceOf($this->jsControllerHelper->getServiceLocator(),'\Zend\ServiceManager\ServiceLocatorInterface');

	}

	/**
	 * Invoke helper
	 * @return
	 */
	public function testInvoke(){

		$this->assertEquals($this->jsControllerHelper->__invoke(),'');
	}
}