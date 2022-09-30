<?php
/**
* Plugin Name: Elementor Addon
* Plugin URI: https://khwaan.com
* Description: Elementor Addon
* Version: 2.1.1
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

    require_once(__DIR__ . '/widgets/promotion-card.php');
    require_once(__DIR__ . '/widgets/promotion-field.php');
    require_once(__DIR__ . '/widgets/product-card.php');
    require_once(__DIR__ . '/widgets/countdown-auto.php');
    require_once(__DIR__ . '/widgets/user-review.php');


  }

  public function register_widgets(){

    $this->include_widgets_files();

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PromotionCard());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PromotionField());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ProductCard());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\CountdownAuto());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\UserReview());


  }

  public function widget_styles() {

    wp_register_style( 'elmta-style-css', plugins_url( '/includes/style.css', __FILE__ ) );

  }
  public function widget_scripts() {

    wp_register_script( 'elmta-promotion-card-js', plugins_url( '/includes/promotion-card.js', __FILE__ ) );
    wp_register_script( 'elmta-promotion-field-js', plugins_url( '/includes/promotion-field.js', __FILE__ ) );
    wp_register_script( 'elmta-product-card-js', plugins_url( '/includes/product-card.js', __FILE__ ) );
    wp_register_script( 'elmta-countdown-auto-js', plugins_url( '/includes/countdown-auto.js', __FILE__ ) );
    wp_register_script( 'elmta-user-review-js', plugins_url( '/includes/user-review.js', __FILE__ ) );

	
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

