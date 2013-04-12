<?php
namespace BoilerAppDisplay\View\Helper;
class JsControllerHelper extends \Zend\View\Helper\AbstractHelper implements \Zend\ServiceManager\ServiceLocatorAwareInterface, \Zend\I18n\Translator\TranslatorAwareInterface{
	use \Zend\ServiceManager\ServiceLocatorAwareTrait, \Zend\I18n\Translator\TranslatorAwareTrait;

	/**
	 * @var \Zend\Mvc\Router\RouteInterface
	 */
	private $router;

	/**
	 * @var \Zend\Mvc\Router\Http\RouteMatch
	 */
	private $routeMatch;

	/**
	 * @var array
	 */
	private $routes = array();

	/**
	 * @var array
	 */
	private $translationMessages;

	/**
	 * @param \Zend\Mvc\Router\RouteInterface $oRouter
	 * @return \BoilerAppDisplay\View\Helper\JsControllerHelper
	 */
	public function setRouter(\Zend\Mvc\Router\RouteInterface $oRouter){
		$this->router = $oRouter;
		if($this->router instanceof \Zend\Mvc\Router\RouteStackInterface)$this->setRoutes($this->router->getRoutes());
		return $this;
	}

	/**
	 * @throws \LogicException
	 * @return \Zend\Mvc\Router\RouteInterface
	 */
	public function getRouter(){
		if($this->router instanceof \Zend\Mvc\Router\RouteInterface)return $this->router;
		throw new \LogicException('Router is undefined');
	}

	/**
	 * @param \Zend\Mvc\Router\Http\RouteMatch $oRouteMatch
	 * @return \BoilerAppDisplay\View\Helper\JsControllerHelper
	 */
	public function setRouteMatch(\Zend\Mvc\Router\Http\RouteMatch $oRouteMatch){
		$this->routeMatch = $oRouteMatch;
		return $this;
	}

	/**
	 * @return \Zend\Mvc\Router\Http\RouteMatch|null
	 */
	public function getRouteMatch(){
		if(isset($this->routeMatch))return $this->routeMatch;
	}

	/**
	 * @param \Zend\Mvc\Router\PriorityList $oRoutes
	 * @param string $sRouteParent
	 * @return \BoilerAppDisplay\View\Helper\JsController
	 */
	public function setRoutes(\Zend\Mvc\Router\PriorityList $oRoutes,$sParentRouteName = null){
		$oRouter = $this->getRouter();
		foreach($oRoutes as $sRouteName => $oRoute){
			if(!($oRoute instanceof \Zend\Mvc\Router\Http\RouteInterface))continue;
			if(!empty($sParentRouteName))$sRouteName = $sParentRouteName.'/'.$sRouteName;
			try{
				$this->routes[$sRouteName] = $oRouter->assemble($oRoute->getAssembledParams(), array('name' => $sRouteName));
			}
			catch(\Exception $oExcpetion){}
			if($oRoute instanceof \Zend\Mvc\Router\Http\Part)$this->setRoutes($oRoute->getRoutes(),$sRouteName);
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
	 * Retrieve translation messages
	 * @return array
	 */
	protected function getTranslationMessages(){
		if(is_array($this->translationMessages))return $this->translationMessages;
		else{
			$oTranslator = $this->getTranslator();
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
		if(($oRouteMatch = $this->getRouteMatch()) instanceof \Zend\Mvc\Router\Http\RouteMatch){
			$sControllerName = str_ireplace('\\','',$oRouteMatch->getParam('controller'));
			$sControllerActionName = $sControllerName.ucfirst($oRouteMatch->getParam('action'));
		}
		else $sControllerName = $sControllerActionName = 'NoController';

		$oEscapeJson = $this->getServiceLocator()->get('escapeJson');

		return $this->getServiceLocator()->get('inlineScript')->__invoke(\Zend\View\Helper\HeadScript::SCRIPT)->appendScript('
			var oControllerOptions = {
				\'locale\':'.$oEscapeJson(str_ireplace('_','-',$this->getTranslator()->getLocale())).',
	            \'texts\':'.$oEscapeJson($this->getTranslationMessages()).',
				\'routes\':'.$oEscapeJson($this->getRoutes()).',
			};
			var oController;
			if(\'undefined\' !== typeof '.$sControllerActionName.')oController = new '.$sControllerActionName.'(oControllerOptions);
			else if(\'undefined\' !== typeof '.$sControllerName.')oController = new '.$sControllerName.'(oControllerOptions);
			else oController = new Controller(oControllerOptions);
		');
	}
}