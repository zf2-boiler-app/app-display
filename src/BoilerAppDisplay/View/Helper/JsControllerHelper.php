<?php
namespace BoilerAppDisplay\View\Helper;
class JsControllerHelper extends \Zend\View\Helper\AbstractHelper implements \Zend\ServiceManager\ServiceLocatorAwareInterface{

	/**
	 * @var \Zend\Mvc\Router\Http\RouteMatch
	 */
	private $routeMatch;

	/**
	 * @var array
	 */
	private $routes = array();

	/**
	 * @var \Zend\ServiceManager\ServiceLocatorInterface
	 */
	private $serviceLocator;

	/**
	 * @var array
	 */
	private $translationMessages;

	/**
	 * @param \Zend\Mvc\Router\Http\RouteMatch $oRouteMatch
	 * @return \BoilerAppDisplay\View\Helper\JsControllerHelper
	 */
	public function setRouteMatch(\Zend\Mvc\Router\Http\RouteMatch $oRouteMatch){
		$this->routeMatch = $oRouteMatch;
		return $this;
	}

	/**
	 * @param array $aRoutesConfig
	 * @param string $sRoutePrefix
	 * @return \BoilerAppDisplay\View\Helper\JsController
	 */
	public function setRoutes(array $aRoutesConfig,$sRouteParent = null){
		$oRouter = $this->getServiceLocator()->get('router');
		foreach($aRoutesConfig as $sRouteName => $aInfosRoute){
			if($aInfosRoute['type'] !== 'Zend\Mvc\Router\Http\Literal')continue;
			$this->routes[$sRouteName = empty($sRouteParent)?$sRouteName:$sRouteParent.'/'.$sRouteName] = $oRouter->assemble(array(), array('name' => $sRouteName));
			if(isset($aInfosRoute['child_routes']))$this->setRoutes($aInfosRoute['child_routes'],$sRouteName);
		}
		return $this;
	}

	/**
	 * @throws \LogicException
	 * @return array
	 */
	public function getRoutes(){
		if(is_array($this->routes))return $this->routes;
		throw new \LogicException('Routes are undefined');
	}

	/**
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
	 * @return \BoilerAppDisplay\View\Helper\JsController
	 */
	public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		$this->serviceLocator = $oServiceLocator;
		return $this;
	}

	/**
	 * @throws \LogicException
	 * @return \Zend\ServiceManager\ServiceLocatorInterface
	 */
	public function getServiceLocator(){
		if($this->serviceLocator instanceof \Zend\ServiceManager\ServiceLocatorInterface)return $this->serviceLocator;
		throw new \LogicException('Service Locator is undefined');
	}

	/**
	 * Retrieve translation messages
	 * @return array
	 */
	protected function getTranslationMessages(){
		if(is_array($this->translationMessages))return $this->translationMessages;
		else{
			$oTranslator = $this->getServiceLocator()->getServiceLocator()->get('translator');
			return $this->translationMessages = array_merge(
				$oTranslator->getMessages(),
				$oTranslator->getMessages(null,'validator')
			);
		}
	}

	/**
	 * Invoke helper
	 * @return
	 */
	public function __invoke(){
		if($this->routeMatch){
			$sControllerName = str_ireplace('\\','',$this->routeMatch->getParam('controller'));
			$sControllerActionName = $sControllerName.ucfirst($this->routeMatch->getParam('action'));
		}
		else $sControllerName = $sControllerActionName = 'NoController';

		return $this->getServiceLocator()->get('inlineScript')->__invoke(\Zend\View\Helper\HeadScript::SCRIPT)->appendScript('
			var oControllerOptions = {
				\'locale\':'.$this->getServiceLocator()->get('escapeJson')->__invoke(str_ireplace('_','-',$this->getServiceLocator()->getServiceLocator()->get('translator')->getLocale())).',
	            \'texts\':'.$this->getServiceLocator()->get('escapeJson')->__invoke($this->getTranslationMessages()).',
				\'routes\':'.$this->getServiceLocator()->get('escapeJson')->__invoke($this->getRoutes()).',
			};
			var oController;
			if(\'undefined\' !== typeof '.$sControllerActionName.')oController = new '.$sControllerActionName.'(oControllerOptions);
			else if(\'undefined\' !== typeof '.$sControllerName.')oController = new '.$sControllerName.'(oControllerOptions);
			else oController = new Controller(oControllerOptions);
		');
	}
}