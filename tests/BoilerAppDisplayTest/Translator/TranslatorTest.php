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

	public function testGetMessages(){
		$this->assertEquals($this->translator->getMessages(),array(
			'404_error' => 'Une erreur 404 s\'est produite',
			'additional_information' => 'Informations complémentaires',
			'application_description' => 'Description de l\'application',
			'application_name' => 'Nom de l\'application',
			'close_modal' => 'Fermer la fenêtre',
			'error_occurred' => 'Une erreur s\'est produite',
			'file' => 'Fichier',
			'message' => 'Message',
			'stack_trace' => 'Trace de la pile',
			'previous_exceptions' => 'Exception précédente'
		));
	}
}