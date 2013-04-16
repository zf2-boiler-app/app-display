<?php
namespace BoilerAppDisplayTest\Mvc\Controller;
class AbstractActionControllerTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractHttpControllerTestCase{

	/**
	 * @var \BoilerAppDisplay\Mvc\Controller\AbstractActionController
	 */
	protected $controller;

	/**
	 * @var \Zend\Mvc\MvcEvent
	 */
	protected $event;

	public function setUp(){
		parent::setUp();
		$this->controller = $this->getMockForAbstractClass('BoilerAppDisplay\Mvc\Controller\AbstractActionController');

		$this->event = new \Zend\Mvc\MvcEvent();
		$this->event
		->setViewModel(new \Zend\View\Model\ViewModel())
		->setApplication($this->getApplicationServiceLocator()->get('Application'))
		->setRouter(\Zend\Mvc\Router\Http\TreeRouteStack::factory(isset($aConfiguration['router'])?$aConfiguration['router']:array()))
		->setRouteMatch(new \Zend\Mvc\Router\RouteMatch(array('controller' => 'index','action' => 'index')))
		->setRequest(new \Zend\Http\Request());

		$this->controller->setEvent($this->event);
	}

	public function testOnDispatch(){
		$this->assertInstanceOf('\Zend\View\Model\ViewModel',$this->controller->onDispatch($this->event));
	}
}