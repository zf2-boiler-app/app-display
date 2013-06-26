<?php
namespace BoilerAppDisplayTest;
class ModuleTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractModuleTestCase{

	/**
	 * @var \Zend\Mvc\MvcEvent
	 */
	protected $event;

	/**
	 * @see \BoilerAppTest\PHPUnit\TestCase\AbstractModuleTestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$aConfiguration = $this->getServiceManager()->get('Config');
		$this->event = new \Zend\Mvc\MvcEvent();
		$this->event
			->setViewModel(new \Zend\View\Model\ViewModel())
			->setApplication($this->getServiceManager()->get('Application'))
			->setRouter(\Zend\Mvc\Router\Http\TreeRouteStack::factory(isset($aConfiguration['router'])?$aConfiguration['router']:array()))
			->setRouteMatch(new \Zend\Mvc\Router\RouteMatch(array('controller' => 'index','action' => 'index')));
	}

	public function testOnBootstrap(){
		$this->module->onBootstrap($this->event->setName(\Zend\Mvc\MvcEvent::EVENT_BOOTSTRAP));
	}

	public function testOnRender(){
		$this->module->onRender($this->event
			->setRequest(\Zend\Http\Request::fromString('GET /test HTTP/1.1\r\n\r\nSome Content'))
			->setResult(new \Zend\View\Model\ViewModel())
			->setName(\Zend\Mvc\MvcEvent::EVENT_RENDER)
		);
	}

	public function testOnRenderNoHttpRequest(){
		$this->module->onRender($this->event
			->setResult(new \Zend\View\Model\ViewModel())
			->setName(\Zend\Mvc\MvcEvent::EVENT_RENDER)
		);
	}

	public function testOnError(){
		$this->module->onError($this->event
			->setParam('exception',new \Exception())
			->setName(\Zend\Mvc\MvcEvent::EVENT_RENDER_ERROR)
			->setResult(new \Zend\View\Model\ViewModel())
		);
	}
}