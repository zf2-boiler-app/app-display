<?php
namespace BoilerAppDisplayTest\Form;
class AbstractFormTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{

	/**
	 * @var \BoilerAppDisplay\Form\AbstractForm
	 */
	protected $form;

	protected function setUp(){
		$this->form = $this->getMockForAbstractClass('BoilerAppDisplay\Form\AbstractForm');
	}

	public function testForm(){
		$this->assertEquals('post',$this->form->getAttribute('method'));
		$this->assertEquals('FormValidator Meio.Mask',$this->form->getAttribute('data-behavior'));
	}
}