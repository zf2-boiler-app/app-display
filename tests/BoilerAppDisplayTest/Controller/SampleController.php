<?php
namespace BoilerAppDisplayTest\Controller;
class SampleController extends \Zend\Mvc\Controller\AbstractActionController{

	public function errorAction(){
		try{
			throw new \Exception('Previous');
		}
		catch(\Exception $oException){
			throw new \Exception('Test',$oException->getCode(),$oException);
		}
	}
}