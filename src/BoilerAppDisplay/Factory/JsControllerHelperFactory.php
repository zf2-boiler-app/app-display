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

		//Try to retrieve and set route match
		$oServiceManager = $oServiceLocator->getServiceLocator();
		if(
			$oServiceManager->has('Application')
			&& ($oMvcEvent = $oServiceManager->get('Application')->getMvcEvent())
			&& $oMvcEvent instanceof \Zend\Mvc\MvcEvent
			&& ($oRouteMatch = $oMvcEvent->getRouteMatch()) instanceof \Zend\Mvc\Router\Http\RouteMatch
		)$oJsControllerHelper->setRouteMatch($oRouteMatch);
		elseif(
			$oServiceManager->has('router') && $oServiceManager->has('request')
			&& ($oRouteMatch = $oServiceManager->get('router')->match($oServiceManager->get('request'))) instanceof \Zend\Mvc\Router\Http\RouteMatch
		)$oJsControllerHelper->setRouteMatch($oRouteMatch);

		//Try to retrieve and set routes config
		$aConfiguration = $oServiceManager->get('Config');
		if(isset($aConfiguration['router']['routes']))$oJsControllerHelper->setRoutes($aConfiguration['router']['routes']);

		return $oJsControllerHelper;
    }
}