<?php
namespace BoilerAppDisplayTest\Controller;
class SampleControllerTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractHttpControllerTestCase{

	public function testError(){
		$this->dispatch('/error');
		$this->assertResponseStatusCode(\Zend\Http\Response::STATUS_CODE_500);
	}

	public function testNotFound(){
		$this->dispatch('/notfound');
		$this->assertResponseStatusCode(\Zend\Http\Response::STATUS_CODE_404);
	}
}