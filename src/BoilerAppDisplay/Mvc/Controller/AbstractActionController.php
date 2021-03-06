<?php
namespace BoilerAppDisplay\Mvc\Controller;
abstract class AbstractActionController extends \AssetsBundle\Mvc\Controller\AbstractActionController{
	/**
	 * @var array
	 */
	protected $acceptCriteria = array(
		'Zend\View\Model\ViewModel' => array('text/html','application/xhtml+xml'),
		'Zend\View\Model\JsonModel' => array('application/json'),
		'Zend\View\Model\FeedModel' => array('application/rss+xml')
	);

	/**
	 * @var \Zend\View\Model\ViewModel
	 */
	protected $view;

	/**
	 * @see \AssetsBundle\Mvc\Controller\AbstractActionController::onDispatch()
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @return mixed
	 */
	public function onDispatch(\Zend\Mvc\MvcEvent $oEvent){
		$this->view = $this->acceptableViewModelSelector($this->acceptCriteria);

		$oRequest = $oEvent->getRequest();
		if(!($oRequest instanceof \Zend\Http\Request) || $oRequest->isXmlHttpRequest())$this->view->setTerminal(true);
		return parent::onDispatch($oEvent);
	}
}