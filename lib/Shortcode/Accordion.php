<?php
/**
 * Original code by Patrick Forringer (http://patrick.forringer.com)
 */

class Shortcode_Accordion{
	
	public function __construct(){

		add_shortcode( 'accordion', array( $this, 'do_shortcode' ) );
		
	}
	
	public function do_shortcode( $attrs, $content ){
		
		$attrs = shortcode_atts(array(
				'title' => 'Expand Content',
				'group' => get_the_ID()
			), $attrs );
			
		$op = (object) apply_filters( 'accordion_attributes', $attrs );

		ob_start();
		require AF_DIR . '/views/accordion.php';
		$accordion = ob_get_contents();
		ob_clean();

		return $accordion;
	}

}
