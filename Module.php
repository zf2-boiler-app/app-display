<?php
namespace BoilerAppDisplay;
class Module{

	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 */
	public function onBootstrap(\Zend\Mvc\MvcEvent $oEvent){
		$oServiceManager = $oEvent->getApplication()->getServiceManager();

		//Add translation for validators
		\Zend\Validator\AbstractValidator::setDefaultTranslator($oServiceManager->get('translator'),'validator');

		$oEventManager = $oEvent->getApplication()->getEventManager();

		//Process for render MVC event
		if($oServiceManager->has('ViewRenderer') && $oServiceManager->get('ViewRenderer') instanceof \Zend\View\Renderer\PhpRenderer)$oEventManager->attach(
			\Zend\Mvc\MvcEvent::EVENT_RENDER,
			array($this, 'onRender')
		);

		//Process for error MVC event
		if($oServiceManager->has('ViewRenderer') && $oServiceManager->get('ViewRenderer') instanceof \Zend\View\Renderer\PhpRenderer)$oEventManager->attach(
			array(\Zend\Mvc\MvcEvent::EVENT_DISPATCH_ERROR,\Zend\Mvc\MvcEvent::EVENT_RENDER_ERROR),
			array($this, 'onError')
		);
	}

	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 */
	public function onRender(\Zend\Mvc\MvcEvent $oEvent){
		$oRequest = $oEvent->getRequest();

		if(!($oRequest instanceof \Zend\Http\Request) || $oRequest->isXmlHttpRequest()){
			if(($oView = $oEvent->getResult()) instanceof \Zend\View\Model\ModelInterface)$oEvent->setResult($oView->setTerminal(true));
		}
		elseif(
			($oView = $oEvent->getResult()) instanceof \Zend\View\Model\ModelInterface
			&& !$oView->terminate()
		){
			//Set matchedRouteName var to layout
			$oRouteMatch = $oEvent->getRouteMatch();
			if($oRouteMatch instanceof \Zend\Mvc\Router\RouteMatch)$oEvent->getViewModel()->setVariable('matchedRouteName',$oRouteMatch->getMatchedRouteName());
		}
	}

	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 */
	public function onError(\Zend\Mvc\MvcEvent $oEvent){
		if(!($oException = $oEvent->getParam('exception')) instanceof \Exception)$oException = new \RuntimeException($oEvent->getError());

		//Try to log the error
		$oServiceManager = $oEvent->getApplication()->getServiceManager();
		if($oServiceManager->has('Logger'))$oServiceManager->get('Logger')->err($oException);

		//Disable layout rendering if request is not Http
		if(
			(!(($oRequest = $oEvent->getRequest()) instanceof \Zend\Http\Request) || $oRequest->isXmlHttpRequest())
			&& ($oResult = $oEvent->getResult()) instanceof \Zend\View\Model\ModelInterface
		)$oResult->setTerminal(true);
	}

	/**
     * @return array
     */
    public function getConfig(){
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
     * @return array
     */
    public function getAutoloaderConfig(){
         return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            )
        );
    }
}