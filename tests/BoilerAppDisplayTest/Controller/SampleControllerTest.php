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

	public function tearDown(){
		//Empty cache directory except .gitignore
		foreach(new \RecursiveIteratorIterator(
				new \RecursiveDirectoryIterator(getcwd().'/tests/_files/cache', \RecursiveDirectoryIterator::SKIP_DOTS),
				\RecursiveIteratorIterator::CHILD_FIRST
		) as $oFileinfo){
			if($oFileinfo->isDir())rmdir($oFileinfo->getRealPath());
			elseif($oFileinfo->getBasename() !== '.gitignore')unlink($oFileinfo->getRealPath());
		}
	}
}