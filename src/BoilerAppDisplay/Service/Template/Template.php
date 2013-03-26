<?php
namespace BoilerAppDisplay\Service\Template;
class Template{
	/**
	 * @var \BoilerAppDisplay\Service\Template\TemplateConfiguration
	 */
	protected $configuration;

	/**
	 * @var array
	 */
	protected $children;

	/**
	 * Constructor
	 */
	public function __construct(\BoilerAppDisplay\Service\Template\TemplateConfiguration $oConfiguration){
		$this->configuration = $oConfiguration;
	}

	/**
	 * @throws \LogicException
	 * @return \BoilerAppDisplay\Service\Template\TemplateConfiguration
	 */
	public function getConfiguration(){
		if($this->configuration instanceof \BoilerAppDisplay\Service\Template\TemplateConfiguration)return $this->configuration;
		throw new \LogicException('Configuration is undefined');
	}
	
	/**
	 * @throws \LogicException
	 * @return array
	 */
	public function getChildren(){
		if(!is_array($this->children)){
			$this->children = array();
			foreach($this->getConfiguration()->getChildren() as $sChildrenName => $oChildrenConfiguration){
				if(!is_string($sChildrenName))throw new \LogicException('Children Name expects string, '.gettype($sChildrenName).' given');
				if($oChildrenConfiguration instanceof \Traversable)$oChildrenConfiguration = \Zend\Stdlib\ArrayUtils::iteratorToArray($oChildrenConfiguration);

				if(is_array($oChildrenConfiguration))$oChildrenConfiguration = new \BoilerAppDisplay\Service\Template\TemplateConfiguration($oChildrenConfiguration);
				elseif(is_string($oChildrenConfiguration) || is_callable($oChildrenConfiguration))$oChildrenConfiguration = new \BoilerAppDisplay\Service\Template\TemplateConfiguration(array(
					'template' => $oChildrenConfiguration
				));
				if(!($oChildrenConfiguration instanceof \BoilerAppDisplay\Service\Template\TemplateConfiguration))throw new \LogicException(sprintf(
					'% expects an array, Traversable object, string or \BoilerAppDisplay\Service\Template\TemplateConfiguration object ; received "%s"',
					__METHOD__,
					(is_object($oChildrenConfiguration)?get_class($oChildrenConfiguration):gettype($oChildrenConfiguration))
				));
				$this->children[$sChildrenName] = new \BoilerAppDisplay\Service\Template\Template($oChildrenConfiguration);
			}
		}
		return $this->children;
	}
}