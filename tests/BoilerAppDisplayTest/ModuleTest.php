<?php
namespace BoilerAppDisplayTest;
class ModuleTest extends \PHPUnit_Framework_TestCase{
	/**
	 * @var \BoilerAppDisplay\Module
	 */
	protected $module;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		$this->module = new \BoilerAppDisplay\Module();
		$this->event = new \Zend\Mvc\MvcEvent();

		$oServiceManager = \BoilerAppDisplayTest\Bootstrap::getServiceManager();

		$oRouteMatch = new \Zend\Mvc\Router\RouteMatch(array('controller' => 'index','action' => 'index'));
		$aConfiguration = $oServiceManager->get('Config');
		$this->event
			->setViewModel(new \Zend\View\Model\ViewModel())
			->setApplication($oServiceManager->get('Application'))
			->setRouter(\Zend\Mvc\Router\Http\TreeRouteStack::factory(isset($aConfiguration['router'])?$aConfiguration['router']:array()))
			->setRouteMatch($oRouteMatch);
	}

	public function testOnBootstrap(){
		$this->module->onBootstrap($this->event->setName(\Zend\Mvc\MvcEvent::EVENT_BOOTSTRAP));
	}

	public function testOnRender(){
		$this->module->onRender($this->event->setName(\Zend\Mvc\MvcEvent::EVENT_RENDER));
	}

	public function testOnError(){
		$this->module->onError($this->event
			->setName(\Zend\Mvc\MvcEvent::EVENT_RENDER_ERROR)
			->setResult(new \Zend\View\Model\ViewModel())
		);
	}

    public function testGetConfig(){
        $this->assertTrue(is_array($this->module->getConfig()));
    }
}