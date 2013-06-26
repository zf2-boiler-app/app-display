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

	public function testInvoke(){
		$this->assertInstanceOf('\BoilerAppDisplay\Form\View\Helper\FormHelper',$this->formHelper->__invoke());
	}

    public function testRender(){
    	$this->assertStringEqualsFile(
    		getcwd().'/tests/_files/expected/form.html',
    		$this->formHelper->render($this->form)
		);

    	$this->assertStringEqualsFile(
    		getcwd().'/tests/_files/expected/ajax-form.html',
    		$this->formHelper->render($this->form,\TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,true)
    	);

    	$this->assertStringEqualsFile(
    		getcwd().'/tests/_files/expected/ajax-form-multipart.html',
    		$this->formHelper->render($this->form->setAttribute('enctype','multipart/form-data'),\TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,true)
    	);
	}

	/**
	 * @expectedException LogicException
	 */
	public function testGetRequestUnset(){
		$oReflectionClass = new \ReflectionClass('\BoilerAppDisplay\Form\View\Helper\FormHelper');
		$oRequest = $oReflectionClass->getProperty('request');
		$oRequest->setAccessible(true);
		$oRequest->setValue($this->formHelper, null);

		$oGetRequest = $oReflectionClass->getMethod('getRequest');
		$oGetRequest->setAccessible(true);
		$oGetRequest->invokeArgs($this->formHelper,array());
	}

	public function testGetRequestFromService(){
		$oReflectionClass = new \ReflectionClass('\BoilerAppDisplay\Form\View\Helper\FormHelper');
		$oRequest = $oReflectionClass->getProperty('request');
		$oRequest->setAccessible(true);
		$oRequest->setValue($this->formHelper, null);

		$this->getServiceManager()->setAllowOverride(true)->setService('Request',new \Zend\Http\Request())->setAllowOverride(false);

		$oGetRequest = $oReflectionClass->getMethod('getRequest');
		$oGetRequest->setAccessible(true);
		$this->assertInstanceOf('Zend\Http\Request', $oGetRequest->invokeArgs($this->formHelper,array()));
	}
}