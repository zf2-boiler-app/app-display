<?php
return array(
	'translator' => array(
		'locale' => 'fr_FR'
	),
	'router' => array(
		'routes' => array(
			'Test' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array('route' => '/test'),
				'may_terminate' => true,
				'child_routes' => array(
					'Segment' => array(
						'type' => 'Zend\Mvc\Router\Http\Segment',
						'options' => array(
							'route' => '/segment[/:segment]',
							'defaults' => array(
								'controller' => 'Test\Controller\Test',
								'action' => 'segment'
							)
						)
					),
					'Literal' => array(
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array(
							'route' => '/literal',
							'defaults' => array(
								'controller' => 'Test\Controller\Test',
								'action' => 'literal'
							)
						)
					)
				)
			)
		)
	)
);