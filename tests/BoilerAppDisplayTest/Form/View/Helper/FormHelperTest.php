<?php
namespace BoilerAppDisplayTest\Form\View\Helper;
class FormHelperTest extends \PHPUnit_Framework_TestCase{

	/**
	 * @var \BoilerAppDisplay\Form\View\Helper\FormHelper
	 */
	protected $formHelper;

	protected $form;

	public function setUp(){
		$oViewHelperPluginManager = \BoilerAppDisplayTest\Bootstrap::getServiceManager()->get('view_helper_manager');

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
    	file_put_contents(getcwd().'/_files/expected/form.html', $this->formHelper->render($this->form));
    	$this->assertEquals(
    		file_get_contents(getcwd().'/_files/expected/form.html'),
    		$this->formHelper->render($this->form)
    	);
    	file_put_contents(getcwd().'/_files/expected/ajax-form.html', $this->formHelper->render($this->form,\TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,true));
    	$this->assertEquals(
    		file_get_contents(getcwd().'/_files/expected/ajax-form.html'),
    		$this->formHelper->render($this->form,\TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,true)
    	);
	}
}