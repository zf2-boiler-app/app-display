<?php
namespace BoilerAppDisplay\Factory;
class TemplatingServiceFactory implements \Zend\ServiceManager\FactoryInterface{
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
        //Configure the Templating service
        $aConfiguration = $oServiceLocator->get('Config');
       	return \BoilerAppDisplay\Service\TemplatingService::factory(isset($aConfiguration['templating'])?$aConfiguration['templating']:array());
    }
}