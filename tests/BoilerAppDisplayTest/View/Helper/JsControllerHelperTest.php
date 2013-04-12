<?php
namespace BoilerAppDisplayTest\View\Helper;
class JsControllerHelperTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppDisplay\View\Helper\JsControllerHelper
	 */
	protected $jsControllerHelper;

	public function setUp(){
		$aConfiguration = $this->getServiceManager()->get('Config');

		$oViewHelperPluginManager = $this->getServiceManager()->get('view_helper_manager');

		$oRenderer = new \Zend\View\Renderer\PhpRenderer();
		$this->jsControllerHelper = $oViewHelperPluginManager->get('jsController')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
		$this->jsControllerHelper->setRouter(\Zend\Mvc\Router\Http\TreeRouteStack::factory(array(
			'routes' => isset($aConfiguration['router']['routes'])?$aConfiguration['router']['routes']:array()
		)));
	}

	public function testGetRoutes(){
		$this->assertEquals(
			array(
				'Test' => '/test',
				'Test/Literal' => '/test/literal',
				'Test/Segment' => '/test/segment',
				'jscustom' => '/jscustom'
			),
			$this->jsControllerHelper->getRoutes()
		);
	}

	public function testGetServiceLocator(){
		$this->assertInstanceOf('\Zend\ServiceManager\ServiceLocatorInterface',$this->jsControllerHelper->getServiceLocator());
	}

	public function testInvoke(){
		$this->assertInstanceOf('Zend\View\Helper\InlineScript',$this->jsControllerHelper->__invoke());
	}
}