<?php
namespace BoilerAppDisplayTest\Form\View\Helper;
class FormHelperTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{

	/**
	 * @var \BoilerAppDisplay\Form\View\Helper\FormHelper
	 */
	protected $formHelper;

	/**
	 * @var \Zend\Form\Form
	 */
	protected $form;

	public function setUp(){
		$oViewHelperPluginManager = $this->getServiceManager()->get('view_helper_manager');

		$oRenderer = new \Zend\View\Renderer\PhpRenderer();
		$this->formHelper = $oViewHelperPluginManager->get('form')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
		$this->formHelper->setRequest(new \Zend\Http\Request());

		$this->form = new \Zend\Form\Form();
		$this->form->add(array(
			'name' => 'input-text',
			'attributes' => array(
				'placeholder' => 'Type something...'
			),
			'options' => array(
				'label' => 'Label name',
			)
		));
	}

    public function testRender(){
    	$this->assertEquals(
    		file_get_contents(getcwd().'/tests/_files/expected/form.html'),
    		$this->formHelper->render($this->form)
    	);

    	$this->assertEquals(
    		file_get_contents(getcwd().'/tests/_files/expected/ajax-form.html'),
    		$this->formHelper->render($this->form,\TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,true)
    	);
	}
}