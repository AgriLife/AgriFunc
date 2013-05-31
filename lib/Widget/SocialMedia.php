<?php
/**
 * Adds Social Media Widget
 *
 * Allows users to input usernames from various social media outlets
 */

class Widget_SocialMedia extends WP_Widget {

  /**
   * Register widget with WordPress
   */
  public function __construct() {
    parent::__construct(
      'social_media', // Base ID
      'Social Media', // Name
      array('description' => __('Add social media icons', 'text_domain'), ) // Args
    );

  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters( 'widget_title', $instance['title'] );

    echo $before_widget;
    if( ! empty( $title ) )
        echo $before_title . $title . $after_title;

    echo '<ul class="clearfix social-media-list">';
    foreach( $instance['s'] as $key => $value ) {
      if( ! empty( $value ) ) {
        echo '<li class="social-media-item">';
        echo '<a class="' . $key . '" href="' . $this->socialUrl( $key, $value ) . '" target="_blank">' . $key . '</a>';
        echo '</li>';
      }
    }
    echo '</ul>';

    echo $after_widget;

  }

  private function socialUrl( $key, $value ) {
    switch($key) {
      case 'facebook' :
        return $value;
        break;
      case 'googleplus' :
        return $value;
        break;
      case 'twitter' :
        return $value;
        break;
      case 'flickr' :
        return $value;
        break;
      case 'youtube' :
        return $value;
        break;
      case 'linkedin' :
        return $value;
        break;
      case 'instagram' :
        return $value;
        break;
      case 'pinterest' :
        return $value;
        break;
      case 'rss' :
        return $value;
        break;
    }
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance   Values just sent to be saved.
   * @param array $old_instance   Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['s']['facebook'] = strip_tags( $new_instance['facebook'] );
    $instance['s']['googleplus'] = strip_tags( $new_instance['googleplus'] );
    $instance['s']['twitter'] = strip_tags( $new_instance['twitter'] );
    $instance['s']['flickr'] = strip_tags( $new_instance['flickr'] );
    $instance['s']['youtube'] = strip_tags( $new_instance['youtube'] );
    $instance['s']['linkedin'] = strip_tags( $new_instance['linkedin'] );
    $instance['s']['instagram'] = strip_tags( $new_instance['instagram'] );
    $instance['s']['pinterest'] = strip_tags( $new_instance['pinterest'] );
    $instance['s']['rss'] = strip_tags( $new_instance['rss'] );

    return $instance;
  }

  /**
   * Back-end widget form
   *
   * @see WP_Widget::form()
   *
   * @param array $instance   Previously saved values from database
   */
  public function form( $instance ) {
    global $options;

    if ( isset( $instance['title'] ) ) {
      $title = $instance['title'];
    }
    else {
      $title = __( 'Social Media', 'text_domain' );
    }
    if ( isset( $instance['s']['facebook'] ) ) {
      $facebook = $instance['s']['facebook'];
    }
    if ( isset( $instance['s']['googleplus'] ) ) {
      $googleplus = $instance['s']['googleplus'];
    }
    if ( isset( $instance['s']['twitter'] ) ) {
      $twitter = $instance['s']['twitter'];
    }
    if ( isset( $instance['s']['flickr'] ) ) {
      $flickr = $instance['s']['flickr'];
    }
    if ( isset( $instance['s']['youtube'] ) ) {
      $youtube = $instance['s']['youtube'];
    }
    if ( isset( $instance['s']['linkedin'] ) ) {
      $linkedin = $instance['s']['linkedin'];
    }
    if ( isset( $instance['s']['instagram'] ) ) {
      $instagram = $instance['s']['instagram'];
    }
    if ( isset( $instance['s']['pinterest'] ) ) {
      $pinterest = $instance['s']['pinterest'];
    }
    if ( empty( $instance['s']['rss'] ) ) {
      $rss = $options['feedBurner'];
    }
    else {
      $rss = $instance['s']['rss'];
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <hr />
    <p class="description">Include 'http://' in all fields. Full profile URLs only.</p>
    <p>
      <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e( 'Google+:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" type="text" value="<?php echo esc_attr( $googleplus ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e( 'Flickr:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" type="text" value="<?php echo esc_attr( $flickr ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'LinkedIn:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e( 'Pinterest:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" type="text" value="<?php echo esc_attr( $pinterest ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e( 'RSS Feed URL:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" type="text" value="<?php echo esc_attr( $rss ); ?>" />
    </p>
    <?php
  }

} // class SocialMediaIcons

add_action('widgets_init', 'register_social_widget');
function register_social_widget() {
  register_widget('AgriLife_Social_Media');
}

