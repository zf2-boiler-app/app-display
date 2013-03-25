<?php
return array(
	'view_manager' => array(
		'doctype' => 'HTML5'
	),
	'translator' => array(
		'locale' => 'fr_FR',
		'translation_file_patterns' => array(
			array(
				'type' => 'phparray',
				'base_dir' => __DIR__.'/_files/translations/',
				'pattern'  => '%s.php'
			)
		)
	)
);