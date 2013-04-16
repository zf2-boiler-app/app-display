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


	/**
	 * @expectedException LogicException
	 */
	public function testGetRoutesUnset(){
		$oReflectionClass = new \ReflectionClass('BoilerAppDisplay\View\Helper\JsControllerHelper');
		$oRoutes = $oReflectionClass->getProperty('routes');
		$oRoutes->setAccessible(true);
		$oRoutes->setValue($this->jsControllerHelper, null);
		$this->jsControllerHelper->getRoutes();
	}

	public function testGetServiceLocator(){
		$this->assertInstanceOf('Zend\ServiceManager\ServiceLocatorInterface',$this->jsControllerHelper->getServiceLocator());
	}

	public function testInvoke(){

		//Invoke without route match
		$this->assertInstanceOf('Zend\View\Helper\InlineScript',$this->jsControllerHelper->__invoke());

		//Invoke with route match
		$this->jsControllerHelper->setRouteMatch(new \Zend\Mvc\Router\Http\RouteMatch(array()));
		$this->assertInstanceOf('Zend\View\Helper\InlineScript',$this->jsControllerHelper->__invoke());
	}

	public function testGetRouter(){
		$this->assertInstanceOf('Zend\Mvc\Router\RouteInterface', $this->jsControllerHelper->getRouter());
	}

	/**
	 * @expectedException LogicException
	 */
	public function testGetRouterUnset(){
		$oReflectionClass = new \ReflectionClass('BoilerAppDisplay\View\Helper\JsControllerHelper');
		$oRouter = $oReflectionClass->getProperty('router');
		$oRouter->setAccessible(true);
		$oRouter->setValue($this->jsControllerHelper, null);
		$this->jsControllerHelper->getRouter();
	}

	public function testSetRouteMatch(){
		$this->assertInstanceOf('BoilerAppDisplay\View\Helper\JsControllerHelper',$this->jsControllerHelper->setRouteMatch(
			new \Zend\Mvc\Router\Http\RouteMatch(array())
		));
	}
}