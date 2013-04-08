<?php
namespace BoilerAppDisplayTest\Translator;
class Translator extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppDisplay\Translator\Translator
	 */
	protected $translator;

	public function setUp(){
		$this->translator = $this->getServiceManager()->get('translator');
	}
	/**
	 * Retrieve available messages
	 * @param string $sLocale
	 * @param string $sTextDomain
	 * @return array
	 */
	public function testGetMessages(){
		$this->assertEquals($this->translator->getMessages(),array(
			'404_error' => 'Une erreur 404 s\'est produite',
			'close_modal' => 'Fermer la fenêtre',
			'error_occurred' => 'Une erreur s\'est produite'
		));
	}
}