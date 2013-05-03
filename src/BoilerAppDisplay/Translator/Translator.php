<?php
namespace BoilerAppDisplay\Translator;
class Translator extends \Zend\I18n\Translator\Translator implements \Zend\Validator\Translator\TranslatorInterface{

	/**
	 * Retrieve available messages
	 * @param string $sLocale
	 * @param string $sTextDomain
	 * @return array
	 */
	public function getMessages($sLocale = null,$sTextDomain = 'default'){
		$sLocale = $sLocale?:$this->getLocale();
		if(!isset($this->messages[$sTextDomain][$sLocale]))$this->loadMessages($sTextDomain, $sLocale);
		if(isset($this->messages[$sTextDomain][$sLocale]) && $this->messages[$sTextDomain][$sLocale] instanceof \Zend\I18n\Translator\TextDomain)return $this->messages[$sTextDomain][$sLocale]->getArrayCopy();
		if(null !== ($sFallbackLocale = $this->getFallbackLocale()) && $sLocale !== $sFallbackLocale)$this->loadMessages($sTextDomain, $sFallbackLocale);
		return isset($this->messages[$sTextDomain][$sFallbackLocale]) && $this->messages[$sTextDomain][$sFallbackLocale] instanceof \Zend\I18n\Translator\TextDomain?$this->messages[$sTextDomain][$sFallbackLocale]->getArrayCopy():array();
	}
}