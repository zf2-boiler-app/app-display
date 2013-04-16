<?php
namespace BoilerAppDisplayTest\Form\View\Helper;
class FormElementErrorsTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppDisplay\Form\View\Helper\FormElementErrors
	 */
	protected $formElementErrorsHelper;

	public function setUp(){
		$oViewHelperPluginManager = $this->getServiceManager()->get('view_helper_manager');

		$oRenderer = new \Zend\View\Renderer\PhpRenderer();
		$this->formElementErrorsHelper = $oViewHelperPluginManager->get('formElementErrors')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
	}

	public function testRender(){
		$oElement = new \Zend\Form\Element\Text('test-element');
		$oElement->setMessages(array('Error #1'));

		$this->assertEquals('<ul class="test-class advice"><li>Error #1</li></ul>',$this->formElementErrorsHelper->render($oElement,array('class' => 'test-class')));

		$this->assertEquals('<ul class="advice"><li>Error #1</li></ul>',$this->formElementErrorsHelper->render($oElement));
    }
}