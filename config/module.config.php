<?php
return array(
	'asset_bundle' => include 'module.config.assets.php',
	'service_manager' => array(
		'factories' => array(
			//Services
			'TemplatingService' => 'BoilerAppDisplay\Factory\TemplatingServiceFactory',
			'Translator' => 'BoilerAppDisplay\Factory\TranslatorFactory',
		)
	),
	'view_helpers' => array(
		'factories' => array(
			'Social' => function(\Zend\ServiceManager\ServiceManager $oServiceManager){
				return $oServiceManager->getServiceLocator()->get('social');
			}
		),
		'invokables' => array(
			'form' => 'BoilerAppDisplay\Form\View\Helper\FormHelper',
			'formElementErrors' => 'BoilerAppDisplay\Form\View\Helper\FormElementErrors',
			'escapeJson' => 'BoilerAppDisplay\View\Helper\EscapeJsonHelper',
			'jsController' => 'BoilerAppDisplay\View\Helper\JsControllerHelper',
		)
	),
	'view_manager' => array(
		'display_not_found_reason' => true,
		'display_exceptions' => true,
		'doctype' => 'HTML5',
		'not_found_template' => 'error/404',
		'exception_template' => 'error/index',
		'template_map' => array(
			'error/404' => __DIR__ . '/../view/error/404.phtml',
			'error/index' => __DIR__ . '/../view/error/index.phtml'
		),
		'template_path_stack' => array(__DIR__ . '/../view'),
		'strategies' => array('ViewJsonStrategy')
	)
);