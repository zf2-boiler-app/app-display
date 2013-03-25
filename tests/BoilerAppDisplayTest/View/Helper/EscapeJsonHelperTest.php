<?php
namespace BoilerAppDisplayTest\View\Helper;
class EscapeJsonHelperTest  extends \PHPUnit_Framework_TestCase{
	private $configuration = array(
		'view_manager' => array(
			'doctype' => 'HTML5'
		)
	);

	/**
	 * @var \BoilerAppDisplay\View\Helper\EscapeJsonHelper
	*/
	protected $escapeJsonHelper;

	public function setUp(){
		/* @var $oViewHelperPluginManager \Zend\View\HelperPluginManager */
		$oViewHelperPluginManager = \BoilerAppDisplayTest\Bootstrap::getServiceManager()->get('view_helper_manager');

		$oRenderer = new \Zend\View\Renderer\PhpRenderer();
		$this->escapeJsonHelper = $oViewHelperPluginManager->get('escapeJson')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
	}

	public function testInvoke(){
		$this->assertEquals($this->escapeJsonHelper->__invoke(array('test' => 'é"é')),'{"test":"\u00e9\u0022\u00e9"}');
	}
}