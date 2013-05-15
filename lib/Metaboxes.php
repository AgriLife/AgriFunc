<?php

/**
 * Creates the metaboxes throughout the plugin
 */
class Metaboxes {

	public function __construct() {

		add_filter( 'cmb_meta_boxes', array( $this, 'metaboxes' ) );

	}

	/**
	 * Defines a set of metaboxes
	 *
	 * @see https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	 * @param  array  $metaboxes Existing metaboxes
	 * @return array             More metaboxes!
	 */
	public function metaboxes( array $metaboxes ) {

		$prefix = 'agrifunc';

		$metaboxes[] = array(
			'id'         => 'test_metabox',
			'title'      => 'Test Metabox',
			'pages'      => array(), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => 'Test Text',
					'desc' => 'field description (optional)',
					'id'   => $prefix . 'test_text',
					'type' => 'text',
				),
				array(
					'name' => 'Test Text Small',
					'desc' => 'field description (optional)',
					'id'   => $prefix . 'test_textsmall',
					'type' => 'text_small',
				),
			),
		);

		return $metaboxes;

	}

}