<?php
namespace BoilerAppDisplay\Service;
class TemplatingConfiguration extends \Zend\Stdlib\AbstractOptions{
	const DEFAULT_TEMPLATE_MAP = 'default';

	/**
	 * @var array
	 */
	protected $templateMap;

	/**
	 * @param array $aTemplateMap
	 * @return \BoilerAppDisplay\Service\TemplatingConfiguration
	 */
	public function setTemplateMap(array $aTemplateMap){
		foreach($aTemplateMap as $sModule => $oTemplateConfiguration){
			$this->addTemplate($sModule, $oTemplateConfiguration);
		}
		return $this;
	}

	/**
	 * @param string $sModule
	 * @throws \InvalidArgumentException
	 * @return \BoilerAppDisplay\Service\Template\Template
	 */
	public function getTemplateMapForModule($sModule = self::DEFAULT_TEMPLATE_MAP){
		if(!is_string($sModule))throw new \Exception('Module expects string, '.gettype($sModule).' given');
		if(!$this->hasTemplateMapForModule($sModule))throw new \InvalidArgumentException('Template Map is undefined for "'.$sModule.'"');
		return $this->templateMap[$sModule];
	}

	/**
	 * @param string $sModule
	 * @throws \InvalidArgumentException
	 */
	public function hasTemplateMapForModule($sModule = self::DEFAULT_TEMPLATE_MAP){
		if(!is_string($sModule))throw new \InvalidArgumentException('Module expects string, '.gettype($sModule).' given');
		return isset($this->templateMap[$sModule]);
	}

	/**
	 * @param string $sModule
	 * @param \BoilerAppDisplay\Service\Template\TemplateConfiguration|\Traversable\array|string $aTemplateConfiguration
	 * @throws \InvalidArgumentException
	 * @return \BoilerAppDisplay\Service\TemplatingConfiguration
	 */
	protected function addTemplate($sModule, $oTemplateConfiguration){
		if(!is_string($sModule))throw new \InvalidArgumentException('Module expects string, '.gettype($sModule).' given');
		if($oTemplateConfiguration instanceof \Traversable)$oTemplateConfiguration = \Zend\Stdlib\ArrayUtils::iteratorToArray($oTemplateConfiguration);

		if(is_array($oTemplateConfiguration))$oTemplateConfiguration = new \BoilerAppDisplay\Service\Template\TemplateConfiguration($oTemplateConfiguration);
		elseif(is_string($oTemplateConfiguration) || is_callable($oTemplateConfiguration))$oTemplateConfiguration = new \BoilerAppDisplay\Service\Template\TemplateConfiguration(array(
			'template' => $oTemplateConfiguration
		));
		if(!($oTemplateConfiguration instanceof \BoilerAppDisplay\Service\Template\TemplateConfiguration))throw new \InvalidArgumentException(sprintf(
			'% expects an array, Traversable object, string or \Templating\Service\Template\TemplateConfiguration object ; received "%s"',
			__METHOD__,
			(is_object($oOptions)?get_class($oOptions):gettype($oOptions))
		));
		$this->templateMap[$sModule] = new \BoilerAppDisplay\Service\Template\Template($oTemplateConfiguration);
		return $this;
	}
}