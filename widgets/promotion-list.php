<?php

namespace ELMTA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class PromotionList extends Widget_Base{

  public function get_name(){
    return 'itemlist';
  }

  public function get_title(){
    return 'Item List';
  }

  public function get_icon(){
    return 'fa fa-list-ol';
  }

  public function get_style_depends() {
    return ['style-css'];
  }
  public function get_script_depends() {
    return ['scripts-js'];
  }
  public function get_categories(){
    return ['general'];
  }

  protected function _register_controls(){

    $this->start_controls_section(
		'content_section',
		[
				'label' => __( 'Content', 'promotion-list' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    
        $this->add_control(
            'due_date',
            [
                'label' => __( 'Due Date', 'promotion-list' ),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
            ]
        );

        
        
        $repeater = new \Elementor\Repeater();


        

        $repeater->add_control(
                'list_price_reg',
                [
                    'label' => __( 'Regular Price', 'promotion-list' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 10,
                    'max' => 99999,
                    'step' => 1,
                ]
        );

        $repeater->add_control(
        'list_price_sale',
                [
                    'label' => __( 'Sale Price', 'promotion-list' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 10,
                    'max' => 99999,
                    'step' => 1,
                ]
        );

            $repeater->add_control(
                'list_promotion', [
                    'label' => __( 'Content', 'promotion-list' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'language' => 'html',
                    'rows' => 10
                ]
        );
        
        $this->add_control(
                'list',
                [
                    'label' => __( 'Promotion List', 'promotion-list' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => __( '', 'promotion-list' ),
                            'list_content' => __( '', 'promotion-list' ),
                        ]
                    ]
                ]
        );
    

    $this->end_controls_section();
  }



// RENDER

protected function render() {

  $settings = $this->get_settings_for_display();
  
  $due_date = strtotime( $this->get_settings( 'due_date' ) );
  $due_date_format =  date("d-m-Y", $due_date);

    if ( $settings['list'] ) {
        $new_id = 1;
    

        echo '<div class="promotion-group">';
        echo 'DUE DATE : <span id="promotion-date">' . sprintf( __( '%s', 'plugin-name' ), $due_date_format ) . '</span>';

        foreach (  $settings['list'] as $item ) {
        echo '<div class="promotion-item" '. 'id="promo-' . ($new_id) . '">' . '<h3>ITEM #' . $new_id .'</h3>
                <div class="product-list">' . $item['list_promotion'] . '
                </div><ul class="promotion-price"><li>ราคาปกติ<span class="product-price-reg">' .  $item['list_price_reg'] . '</span></li><li>ราคาที่ลดแล้ว<span class="product-price-sale">' . $item['list_price_sale'] . '</span></li></ul></div>';

        $new_id = ($new_id + 1);
        }
        echo '</div>';
        }

    } 

}