<?php

class CPTGenerator {

	private $defaults = array(
		'singular_name' => null,
		'plural_name' => null,
		'slug' => null,
		'description' => '',
		'public' => true,
		'exclude_from_search' => false,
		'show_in_nav_menus' => true,
		'menu_position' => 26,
		'menu_icon' => null,
		'capability_type' => 'post',
		'supports' => array( 'title', 'editor' ),
		'has_archive' => true,

	);

	private $args;

	public $verified;

	public function __construct( $arguments ) {

		$args = wp_parse_args( $arguments, $this->defaults );

		foreach ( $args as $key => $value ) {
			$this->verified[$key] = $this->is_empty( $value );
		}

		add_action( 'admin_notices', array( $this, 'admin_notice' ) );

		$args['slug'] = $this->sanitize_slug( $args['slug'] );

		$this->arguments = $args;

		$this->setup_labels();

		$this->setup_args();

		$this->register_cpt();

	}

	private function is_empty( $value ) {

		if ( is_null( $value ) ) {
			return true;
		}
		return false;

	}

	public function admin_notice() {

		foreach ( $this->verified as $key => $value ) {
			if ( $value && $key != 'menu_icon' ) {
				ob_start();
				require AF_DIR . '/views/cpt-notice.php';
				$return = ob_get_contents();
				ob_clean();
				echo $return;
			}
		}

	}

	private function sanitize_slug( $slug ) {

		return sanitize_title( $slug );

	}

	private function setup_labels() {

		$args = $this->arguments;

		$this->labels = array(
			'name' => $args['plural_name'],
			'singular_name' => $args['singular_name'],
			'add_new' => 'Add New',
			'add_new_item' => 'Add New ' . $args['singular_name'],
			'edit_item' => 'Edit ' . $args['singular_name'],
			'new_item' => 'New ' . $args['singular_name'],
			'all_items' => 'All ' . $args['plural_name'],
			'view_item' => 'View ' . $args['singular_name'],
			'search_items' => 'Search ' . $args['plural_name'],
			'not_found' => 'No ' . $args['plural_name'] . ' found',
			'not_found_in_trash' => 'No ' . $args['plural_name'] . ' found in trash',
			'parent_item_colon' => '',
			'menu_name' => $args['plural_name'],
		);

	}

	private function setup_args() {

		$args = $this->arguments;

		$this->args = array(
			'labels' => $this->labels,
			'public' => $args['public'],
			'exclude_from_search' => $args['exclude_from_search'],
			'show_in_nav_menus' => $args['show_in_nav_menus'],
			'menu_position' => $args['menu_position'],
			'menu_icon' => $args['menu_icon'],
			'capability_type' => $args['capability_type'],
			'supports' => $args['supports'],
			'has_archive' => $args['has_archive'],
		);

	}

	private function register_cpt() {

		register_post_type( $this->arguments['slug'], $this->args );

	}


}