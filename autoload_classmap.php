<?php
return array(
	//Factories
	'BoilerAppDisplay\Factory\TemplatingServiceFactory' => __DIR__.'/src/BoilerAppDisplay/Factory/TemplatingServiceFactory.php',

	//Form
	'BoilerAppDisplay\Form\AbstractForm'                   => __DIR__ . '/src/BoilerAppDisplay/Form/AbstractForm.php',
	'BoilerAppDisplay\Form\View\Helper\FormHelper'         => __DIR__ . '/src/BoilerAppDisplay/Form/View/Helper/FormHelper.php',
	'BoilerAppDisplay\Form\View\Helper\FormElementErrors'  => __DIR__ . '/src/BoilerAppDisplay/Form/View/Helper/FormElementErrors.php',

	//MVC
	'BoilerAppDisplay\Mvc\Controller\AbstractActionController' => __DIR__.'/src/BoilerAppDisplay/Mvc/Controller/AbstractActionController.php',

	//Services
	'BoilerAppDisplay\Service\TemplatingService' => __DIR__.'/src/BoilerAppDisplay/Service/TemplatingService.php',
	'BoilerAppDisplay\Service\TemplatingConfiguration' => __DIR__.'/src/BoilerAppDisplay/Service/TemplatingConfiguration.php',
	'BoilerAppDisplay\Service\Template\Template' => __DIR__.'/src/BoilerAppDisplay/Service/Template/Template.php',
	'BoilerAppDisplay\Service\Template\TemplateConfiguration' => __DIR__.'/src/BoilerAppDisplay/Service/Template/TemplateConfiguration.php',

	//Translator
	'BoilerAppDisplay\Translator\Translator'               => __DIR__ . '/src/BoilerAppDisplay/Translator/Translator.php',
	'BoilerAppDisplay\Translator\TranslatorServiceFactory' => __DIR__ . '/src/BoilerAppDisplay/Translator/TranslatorServiceFactory.php',

	//View helper
	'BoilerAppDisplay\View\Helper\EscapeJsonHelper'        => __DIR__ . '/src/BoilerAppDisplay/View/Helper/EscapeJsonHelper.php',
	'BoilerAppDisplay\View\Helper\JsControllerHelper'      => __DIR__ . '/src/BoilerAppDisplay/View/Helper/JsControllerHelper.php'
);