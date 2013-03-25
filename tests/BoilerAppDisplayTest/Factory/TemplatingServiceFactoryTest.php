<?php
namespace BoilerAppDisplayTest\Factory;
class TemplatingServiceFactoryTest extends \PHPUnit_Framework_TestCase{
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
        //Configure the Templating service
        $aConfiguration = $oServiceLocator->get('Config');
       	return \BoilerAppDisplay\Service\TemplatingService::factory(isset($aConfiguration['templating'])?$aConfiguration['templating']:array());
    }

    /**
     * @var \BoilerAppDisplay\Factory\TemplatingServiceFactory
     */
    protected $templatingServiceFactory;

    public function setUp(){
    	$this->translatorServiceFactory = new \BoilerAppDisplay\Factory\TemplatingServiceFactory();
    }

    public function testCreateService(){
    	$this->assertInstanceOf('BoilerAppDisplay\Translator\Translator',$this->translatorServiceFactory->createService(\BoilerAppDisplayTest\Bootstrap::getServiceManager()));
    }
}