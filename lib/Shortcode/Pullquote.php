<?php

if ( ! class_exists( 'Shortcode_Pullquote' ) ) {
	class Shortcode_Pullquote{
		
		public function __construct(){

			add_shortcode( 'pullquote', array( $this, 'do_shortcode' ) );
			
		}
		
		public function do_shortcode( $attrs, $content ){
			
			$content = wpautop(trim($content));
      return '<div class="pullquote">'. do_shortcode($content) .'</div>';
      
		}

	}
}