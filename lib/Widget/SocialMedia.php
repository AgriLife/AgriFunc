<?php
/**
 * Adds Social Media Widget
 *
 * Allows users to input usernames from various social media outlets
 */

class Widget_SocialMedia extends WP_Widget {

  private $accounts_array = array(
    'facebook' => 'Facebook',
    'googleplus' => 'Google+',
    'twitter' => 'Twitter',
    'flickr' => 'Flickr',
    'youtube' => 'Youtube',
    'linkedin' => 'LinkedIn',
    'instagram' => 'Instagram',
    'pinterest' => 'Pinterest',
    'rss' => 'RSS Feed URL',
  );

  private $facebook;

  private $googleplus;

  private $twitter;

  private $flickr;

  private $youtube;

  private $linkedin;

  private $instagram;

  private $pinterest;

  private $rss;

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
      $this->facebook = $instance['s']['facebook'];
    }
    if ( isset( $instance['s']['googleplus'] ) ) {
      $this->googleplus = $instance['s']['googleplus'];
    }
    if ( isset( $instance['s']['twitter'] ) ) {
      $this->twitter = $instance['s']['twitter'];
    }
    if ( isset( $instance['s']['flickr'] ) ) {
      $this->flickr = $instance['s']['flickr'];
    }
    if ( isset( $instance['s']['youtube'] ) ) {
      $this->youtube = $instance['s']['youtube'];
    }
    if ( isset( $instance['s']['linkedin'] ) ) {
      $this->linkedin = $instance['s']['linkedin'];
    }
    if ( isset( $instance['s']['instagram'] ) ) {
      $this->instagram = $instance['s']['instagram'];
    }
    if ( isset( $instance['s']['pinterest'] ) ) {
      $this->pinterest = $instance['s']['pinterest'];
    }
    if ( empty( $instance['s']['rss'] ) ) {
      $this->rss = $options['feedBurner'];
    }
    else {
      $this->rss = $instance['s']['rss'];
    }

    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <hr />
    <p class="description">Include 'http://' in all fields. Full profile URLs only.</p>

    <?php
    $this->render_fields( $this->accounts_array );

  }

  private function render_fields( $accounts_array ) {

    foreach ($accounts_array as $key => $value) : ?>
      <p>
        <label for="<?php echo $this->get_field_id( $key ); ?>"><?php _e( $value . ':'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo esc_attr( $this->$key ); ?>" />
      </p>
    <?php
    endforeach;

  }

}
