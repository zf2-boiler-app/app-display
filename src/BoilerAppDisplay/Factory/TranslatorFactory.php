<?php
namespace BoilerAppDisplay\Factory;
class TranslatorFactory implements \Zend\ServiceManager\FactoryInterface{
	/**
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
	 * @return \BoilerAppDisplay\Translator\Translator
	 */
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
        $aConfig = $oServiceLocator->get('Config');
        return \BoilerAppDisplay\Translator\Translator::factory(isset($aConfig['translator'])?$aConfig['translator']:array());
    }
}