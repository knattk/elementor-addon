<?php
/**
* Plugin Name: Elementor Addon
* Plugin URI: https://khwaan.com
* Description: Elementor Addon
* Version: 2.4.0
* Author: Nattakan C.
* Author URI: https://khwaan.com
**/

namespace ELMTA;

// use Elementor Plugin;
class Widget_Loader{

  private static $_instance = null;

  public static function instance(){
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

	
  private function include_widgets_files(){

    require_once(__DIR__ . '/widgets/promotion-field.php');
    require_once(__DIR__ . '/widgets/product-card.php');
    require_once(__DIR__ . '/widgets/countdown-auto.php');
    require_once(__DIR__ . '/widgets/user-review.php');
    require_once(__DIR__ . '/widgets/video-sender.php');
    require_once(__DIR__ . '/widgets/video-receiver.php');
    require_once(__DIR__ . '/widgets/scroll-to-redirect.php');

  }

  public function register_widgets(){

    $this->include_widgets_files();

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PromotionField());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ProductCard());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\CountdownAuto());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\UserReview());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\VideoSender());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\VideoReceiver());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ScrollToRedirect());

  }

  private function get_plugin_version() {

    $plugin_data = get_file_data( __FILE__, [ 'Version' => 'Version' ], 'plugin' );

    return ! empty( $plugin_data['Version'] ) ? $plugin_data['Version'] : false;

  }

  public function widget_styles() {

    $version = $this->get_plugin_version();

    wp_register_style( 'elmta-style-css', plugins_url( '/includes/style.css', __FILE__ ), [], $version );
    wp_register_style( 'elmta-video-css', plugins_url( '/includes/video.css', __FILE__ ), [], $version );


  }
  public function widget_scripts() {

    $version = $this->get_plugin_version();

    wp_register_script( 'elmta-promotion-field-js', plugins_url( '/includes/promotion-field.js', __FILE__ ), [], $version );
    wp_register_script( 'elmta-product-card-js', plugins_url( '/includes/product-card.js', __FILE__ ), [], $version );
    wp_register_script( 'elmta-countdown-auto-js', plugins_url( '/includes/countdown-auto.js', __FILE__ ), [], $version );
    wp_register_script( 'elmta-user-review-js', plugins_url( '/includes/user-review.js', __FILE__ ), [], $version );
    wp_register_script( 'elmta-video-receiver-js', plugins_url( '/includes/video-receiver.js', __FILE__ ), [], $version );
    wp_register_script( 'elmta-scroll-to-redirect-js', plugins_url( '/includes/scroll-to-redirect.js', __FILE__ ), [], $version );
    
  }


  public function __construct(){

    // Register Widget Scripts
    add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
    
    // Register Widget Styles
    add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

    // Register Widgets
    add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
	
  }
}


// Instantiate Plugin Class
Widget_Loader::instance();

