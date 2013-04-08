<?php
namespace BoilerAppDisplayTest\View\Helper;
class EscapeJsonHelperTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppDisplay\View\Helper\EscapeJsonHelper
	 */
	protected $escapeJsonHelper;

	public function setUp(){
		$oViewHelperPluginManager = $this->getServiceManager()->get('view_helper_manager');

		$oRenderer = new \Zend\View\Renderer\PhpRenderer();
		$this->escapeJsonHelper = $oViewHelperPluginManager->get('escapeJson')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
	}

	public function testInvoke(){
		$this->assertEquals($this->escapeJsonHelper->__invoke(array('test' => 'é"é')),'{"test":"\u00e9\u0022\u00e9"}');
	}
}