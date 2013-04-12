<?php
namespace BoilerAppDisplay\Factory;
class JsControllerHelperFactory implements \Zend\ServiceManager\FactoryInterface{
	/**
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
	 * @return \BoilerAppDisplay\View\Helper\JsControllerHelper
	 */
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		//Instanciate helper
		$oJsControllerHelper = new \BoilerAppDisplay\View\Helper\JsControllerHelper();

		//Retrieve and set Service locator
		$oJsControllerHelper->setServiceLocator($oServiceLocator);

		//Attempt to retrieve and set route match
		$oServiceManager = $oServiceLocator->getServiceLocator();
		if(
			$oServiceManager->has('Application')
			&& ($oMvcEvent = $oServiceManager->get('Application')->getMvcEvent())
			&& $oMvcEvent instanceof \Zend\Mvc\MvcEvent
			&& ($oRouteMatch = $oMvcEvent->getRouteMatch()) instanceof \Zend\Mvc\Router\Http\RouteMatch
		)$oJsControllerHelper->setRouteMatch($oRouteMatch);

		//Attempt to retrieve and set translator
		if($oServiceManager->has('translator'))$oJsControllerHelper->setTranslator($oServiceManager->get('translator'));

		//Attempt to retrieve and set router
		if($oServiceManager->has('router'))$oJsControllerHelper->setRouter($oServiceManager->get('router'));
		return $oJsControllerHelper;
    }
}