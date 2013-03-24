<?php
return array(
	'asset_bundle' => include 'module.config.assets.php',
	'service_manager' => array(
		'factories' => array(
			//Services
			'TemplatingService' => '\BoilerAppDisplay\Factory\TemplatingServiceFactory',
			'translator' => 'BoilerAppDisplay\Translator\TranslatorServiceFactory',
		)
	),
	'view_helpers' => array(
		'factories' => array(
			'social' => function(\Zend\ServiceManager\ServiceManager $oServiceManager){
				return $oServiceManager->getServiceLocator()->get('social');
			}
		),
		'invokables' => array(
			'form' => 'Application\Form\View\Helper\FormHelper',
			'formElementErrors' => 'Application\Form\View\Helper\FormElementErrors',
			'escapeJson' => 'Application\View\Helper\EscapeJsonHelper',
			'jsController' => 'Application\View\Helper\JsControllerHelper',
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