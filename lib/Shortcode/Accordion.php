<?php
/**
 * Original code by Patrick Forringer (http://patrick.forringer.com)
 */

class Shortcode_Accordion{
	
	public function __construct(){

		add_action( 'wp_enqueue_scripts', array( &$this , 'enqueue_scripts' ) );
		
		add_shortcode( 'shortcode', array( $this, 'do_shortcode' ) );
		
		// register scripts
		wp_register_script(
			'af-accordion-script',
			AF_URL . 'js/accordion.js',
			array( 'jquery' ), '0.1',
		);		

	}
	
	public function enqueue_scripts(){

		if( !is_admin() ) {
			wp_enqueue_script( 'af-accordion-script' );
		}

	}
	
	function do_shortcode( $attrs, $content ){
		
		$attrs = shortcode_atts(array(
				'title' => 'Expand Content',
				'group' => get_the_ID()
			), $attrs );
			
		$op = (object) apply_filters( 'accordion_attributes', $attrs );
	
		return "<a href=\"#\" data-accordion-group=\"{$op->group}\" class=\"accordion-title\">{$op->title}</a><div class=\"accordion-content\">{$content}</div>";
		
	}

}
