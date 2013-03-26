<?php
namespace BoilerAppDisplay\Factory;
use BoilerAppDisplay\View\Helper\JsControllerHelper;
class JsControllerHelperFactory implements \Zend\ServiceManager\FactoryInterface{
	/**
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
	 * @return \BoilerAppDisplay\View\Helper\JsControllerHelper
	 */
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		//Instanciate helper
		$oJsControllerHelper = new JsControllerHelper();

		//Retrieve route match
		$oServiceManager = $oServiceLocator->getServiceLocator();
		if(
			$oServiceManager->has('Application')
			&& ($oMvcEvent = $oServiceManager->get('Application')->getMvcEvent())
			&& $oMvcEvent instanceof \Zend\Mvc\MvcEvent
		)$oJsControllerHelper->setRouteMatch($oMvcEvent->getRouteMatch());
		elseif($oServiceManager->has('router') && $oServiceManager->has('request')){
			$oRouter = $oServiceManager->get('router');
			$oRequest = $oServiceManager->get('request');
			if($oRouteMatch = $oRouter->match($oRequest))$oJsControllerHelper->setRouteMatch($oRouteMatch);
		}

		//Retrieve routes config
		$aConfiguration = $oServiceManager->get('Config');
		if(isset($aConfiguration['router']['routes']))$oJsControllerHelper->setRoutes($aConfiguration);

		return $oJsControllerHelper->setServiceLocator($oServiceLocator);
    }
}