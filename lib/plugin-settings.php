<?php

/**
 * @see https://github.com/gilbitron/WordPress-Settings-Framework
 */

global $wpsf_settings;

$wpsf_settings[] = array(
	'section_id' => 'general',
	'section_title' => 'Page Title',
	'section_description' => 'The page description',
	'section_order' => 10,
	'fields' => array(
		array(
			'id' => 'text',
			'title' => 'Text',
			'desc' => 'This is a description',
			'type' => 'text',
			'std' => 'This is the default'
		),
	),
);