<?php
return array(
	'cachePath' => '@zfRootPath/public/assets/cache',
	'assetsPath' => '@zfRootPath/public/assets',
	'cacheUrl' => '@zfBaseUrl/assets/cache/',
	'assets' => array(
		'less' => array(
			'@zfRootPath/vendor/twbs/bootstrap/less/bootstrap.less',
			'@zfRootPath/vendor/fortawesome/font-awesome/less/font-awesome.less',
			__DIR__ . '/../assets/less/bootstrap-custom.less',
			__DIR__ . '/../assets/less/global.less'
		),
		'js' => array(
			__DIR__ . '/../assets/js/mootools/mootools-core-1.4.5.js',
			__DIR__ . '/../assets/js/mootools/mootools-more-1.4.0.1.js',
			__DIR__ . '/../assets/js/mootools/mootools-bootstrap.js',
			__DIR__ . '/../assets/js/mootools',
			__DIR__ . '/../assets/js/modernizr.min.js',
			'@zfRootPath/vendor/fabiomcosta/mootools-meio-mask/Source/Meio.Mask.js',
			'@zfRootPath/vendor/fabiomcosta/mootools-meio-mask/Source',
			__DIR__ . '/../assets/js/MeioMask/behavior.js',
			'@zfRootPath/vendor/arian/iFrameFormRequest/Source/iFrameFormRequest.js',
			__DIR__ . '/../assets/js/controller.js',
			__DIR__ . '/../assets/js/Modal',
			__DIR__ . '/../assets/js/Validator/common.js'
		),
		'media' => array(
			'@zfRootPath/vendor/fortawesome/font-awesome/font',
			__DIR__ . '/../assets/images'
		)
	)
);