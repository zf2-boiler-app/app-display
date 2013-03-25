<?php
namespace BoilerAppDisplayTest\Translator;
class Translator extends \PHPUnit_Framework_TestCase{
	/**
	 * @var \BoilerAppDisplay\Translator\Translator
	 */
	protected $translator;

	public function setUp(){
		$this->translator = \BoilerAppDisplayTest\Bootstrap::getServiceManager()->get('translator');
	}
	/**
	 * Retrieve available messages
	 * @param string $sLocale
	 * @param string $sTextDomain
	 * @return array
	 */
	public function testGetMessages(){
		$this->assertEquals($this->translator->getMessages(),array(
			'Translation 1' => 'Traduction 1',
			'Translation 2' => 'Traduction 2'
		));
	}
}