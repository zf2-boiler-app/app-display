<?php
return array(
	'asset_bundle' => include 'module.config.assets.php',
	'translator' => include 'module.config.translations.php',
	'tree_layout_stack' => array(
		'layout_tree' => array(
			'default' => array(
				'template' => 'layout/layout'
			)
		)
	),
	'service_manager' => array(
		'factories' => array(
			'Translator' => 'BoilerAppDisplay\Factory\TranslatorFactory',
			'MvcTranslator' => 'BoilerAppDisplay\Factory\TranslatorFactory'
		)
	),
	'view_helpers' => array(
		'factories' => array(
			'Social' => function(\Zend\ServiceManager\ServiceManager $oServiceManager){
				return $oServiceManager->getServiceLocator()->get('social');
			},
			'jsController' => 'BoilerAppDisplay\Factory\JsControllerHelperFactory'
		),
		'invokables' => array(
			'form' => 'BoilerAppDisplay\Form\View\Helper\FormHelper',
			'formElementErrors' => 'BoilerAppDisplay\Form\View\Helper\FormElementErrors',
			'escapeJson' => 'BoilerAppDisplay\View\Helper\EscapeJsonHelper',
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
			'error/index' => __DIR__ . '/../view/error/index.phtml',
			'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
		),
		'template_path_stack' => array(__DIR__ . '/../view'),
		'strategies' => array('ViewJsonStrategy')
	)
);