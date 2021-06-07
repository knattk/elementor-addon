<?php

namespace ELMTA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class PromotionCard extends Widget_Base{

  public function get_name(){
    return 'promotion-card';
  }

  public function get_title(){
    return 'Card';
  }

  public function get_icon(){
    return 'fa fa-square-o';
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

    /* Tab Title */
    $this->start_controls_section(
		'content_section',
		[
				'label' => __( 'Products', 'card-promotion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        
        $this->add_control(
            'product-button',
            [
                'label' => __( 'Button Label', 'card-promotion' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your title', 'plugin-name' ),
                'default' => 'คลิกจองโปร',
            ]
        );  
        $this->add_control(
            'product-link', 
            [
                'label' => __( 'Button Link', 'card-promotion' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '#buy',
            ]
        );
        $this->add_control(
            'product-class', 
            [
                'label' => __( 'Class', 'card-promotion' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
			'product_discount_tag',
			[
				'label' => __( 'Discount Tag', 'card-promotion-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'discount-tag',
                'default'   => 'discount-tag'
			]
        );

        $this->add_control(
			'product_star',
			[
				'label' => __( 'Rating', 'card-promotion-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'star-on',
                'default'   => 'star-on'
			]
		);
        $this->add_control(
			'product_notification',
			[
				'label' => __( 'Notification', 'card-promotion-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'noti',
                'default'   => 'noti'
			]
		);
        

        
        
    /* Repeater Setup */    

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
                'product-title',
                [
                    'label' => __( 'หัวข้อ', 'card-promotion' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'language' => 'html',
                    'rows' => 2,
                    'default' => 'หัวข้อ',
                ]
        );

        $repeater->add_control(
            'product-image',
            [
                'label' => __( 'ภาพสินค้า', 'card-promotion' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
            ]
        );


        $repeater->add_control(
                'product-list', [
                    'label' => __( 'รายการสินค้า', 'card-promotion' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'language' => 'html',
                    'rows' => 10,
                ]
        );
        $repeater->add_control(
            'product-discount',
            [
                'label' => __( 'Discount', 'card-promotion' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 50,
            ]
        );
        $repeater->add_control(
            'product-counter',
            [
                'label' => __( 'จองแล้ว', 'card-promotion' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999,
                'step' => 1,
                'default' => 2414,
            ]
        );
        $repeater->add_control(
            'product-price-sale',
            [
                'label' => __( 'Sale Price', 'card-promotion' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999,
                'step' => 1,
            ]
        );
        $repeater->add_control(
            'product-price-regular',
            [
                'label' => __( 'Regular Price', 'card-promotion' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999,
                'step' => 1,
            ]
        );
        $repeater->add_control(
			'product_featured',
			[
				'label' => __( 'Featured Item', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'featured',
			]
		);

         
    /* Add Repeater */
        
        $this->add_control(
                'list',
                [
                    'label' => __( 'Items', 'card-promotion' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => __( '', 'card-promotion' ),
                            'list_content' => __( '', 'card-promotion' ),
                        ]
                    ]
                ]
        );
        $this->add_control(
			'important_note',
			[
                'label' => __( 'Important Note', 'card-promotion' ),
                'show_label' => false,
				'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( 'Widget นี้ จะต้องมีฟอร์มรองรับ และมี field_1 เป็น Radio หรือ Dropdown เท่านั้น', 'plugin-name' ),
                'separator' => 'before',
			]
		);
    

    $this->end_controls_section();



    /* ---------- STYLE ---------- */


    // CARD -----------------------------------------
    $this->start_controls_section(
        'style_card',
        [
            'label' => __( 'Card', 'card-promotion' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
        $this->add_control(
            'card_background',
            [
                'label' 		=> __( 'Background', 'card-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors'		=> [
                    '{{WRAPPER}} .promotion-card' => 'background-color: {{VALUE}};'
                ]
            ]
        );   
        $this->add_responsive_control(
			'card-flex',
            [
				'label' => __( 'Flex (%)', 'card-promotion' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 25,
				'max' => 100,
				'step' => 1,
                'default' => 100,
                'selectors'		=> [
                    '{{WRAPPER}} .promotion-card' => 'flex: 1 1 {{SIZE}}%;'
                  ]
			]
        );
        $this->add_responsive_control(
			'card-width',
            [
				'label' => __( 'Max Width (%)', 'card-promotion' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 25,
				'max' => 100,
				'step' => 1,
                'default' => 100,
                'selectors'		=> [
                    '{{WRAPPER}} .promotion-card' => 'max-width:{{SIZE}}%;'
                  ]
			]
        );
        
        $this->add_responsive_control(
			'card-margin',
			[
				'label' => __( 'Margin', 'card-promotion' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '.75',
                    'left' => '0',
                    'unit' => 'rem',
                    'isLinked' => true,
                ],
				'selectors' => [
					'{{WRAPPER}} .promotion-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        $this->add_responsive_control(
            'card_radius',
            [
                'label' => __( 'Border Radius', 'card-promotion' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .promotion-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'card-promotion' ),
				'selector' => '{{WRAPPER}} .promotion-card',
			]
        );
        
    $this->end_controls_section();


    // CONTENT -----------------------------------------
    
    $this->start_controls_section(
        'style_content',
        [
            'label' => __( 'Content', 'card-promotion' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $this->add_responsive_control(
        'content-padding',
        [
            'label' => __( 'Padding', 'card-promotion' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem' ],
            'selectors' => [
                '{{WRAPPER}} .promotion-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    //TITLE

    
    $this->add_control(
        'style_content_title',
        [
            'label' => __( 'Title', 'card-promotion' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_title',
                'selector' => '{{WRAPPER}} .card-title',
                'separator'		=> 'after'
            ]
        );

        $this->add_control(
            'title-color',
            [
                'label' 		=> __( 'Color', 'card-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#000',
                'selectors'		=> [
                    '{{WRAPPER}} .card-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        // COUNTER
        $this->add_control(
            'style_content_counter',
            [
                'label' => __( 'Counter', 'card-promotion' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'card-counter',
                'selector' => '{{WRAPPER}} .card-info-left',
                'separator'		=> 'after'
            ]
        );
        $this->add_control(
            'counter_color',
            [
                'label' 		=> __( 'Color', 'card-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#000',
                'selectors'		=> [
                    '{{WRAPPER}} .card-info-left' => 'color: {{VALUE}};'
                ]
            ]
        );


    $this->add_control(
        'style_content_detail',
        [
            'label' => __( 'Product List', 'card-promotion' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'card-promotion',
                'selector' => ['{{WRAPPER}} .card-list',
                                '{{WRAPPER}} .card-footer-pricing span'],
                'separator'		=> 'after'
            ]
        );
        $this->add_control(
            'product_list_color',
            [
                'label' 		=> __( 'Color', 'card-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#5F5F5F',
                'selectors'		=> [
                    '{{WRAPPER}} .card-list' => 'color: {{VALUE}};',
                ]
            ]
        );
        



    $this->end_controls_section();

    // PRICE TAG
    $this->start_controls_section(
        'style_price_tag',
        [
            'label' => __( 'Price Tag', 'card-promotion' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    
        $this->add_control(
            'price_tag_background',
            [
                'label' 		=> __( 'Background', 'card-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' => '#9B0000',
                'selectors'		=> [
                    '{{WRAPPER}} .product-price-tag' => 'background-color: {{VALUE}};'
                ]
            ]
        ); 
        $this->add_control(
            'price_tag-color',
            [
                'label' 		=> __( 'Color', 'card-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#fff',
                'selectors'		=> [
                    '{{WRAPPER}} .product-price-tag' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_tag-text',
                'selector' => '{{WRAPPER}} .product-price-tag',
            ]
        );
        $this->add_responsive_control(
            'price_tag-padding',
            [
                'label' => __( 'Padding', 'card-promotion' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .product-price-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_tag_radius',
            [
                'label' => __( 'Border Radius', 'card-promotion' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .product-price-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'price_tag_shadow',
				'label' => __( 'Box Shadow', 'card-promotion' ),
				'selector' => '{{WRAPPER}} .product-price-tag',
			]
        );

        
    $this->end_controls_section();


    // BUTTON
    $this->start_controls_section(
        'style_button',
        [
            'label' => __( 'Button', 'card-promotion' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    
        $this->add_control(
            'button_background',
            [
                'label' 		=> __( 'Background', 'card-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' => '#CD0000',
                'selectors'		=> [
                    '{{WRAPPER}} .card-button' => 'background-color: {{VALUE}};'
                ]
            ]
        ); 
        $this->add_control(
            'button-color',
            [
                'label' 		=> __( 'Color', 'card-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#fff',
                'selectors'		=> [
                    '{{WRAPPER}} .card-button' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button-text',
                'selector' => '{{WRAPPER}} .card-button',
            ]
        );
        $this->add_responsive_control(
            'button-padding',
            [
                'label' => __( 'Padding', 'card-promotion' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .card-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button-border_radius',
            [
                'label' => __( 'Border Radius', 'card-promotion' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .card-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'style_button_hover',
            [
                'label' => __( 'Hover', 'card-promotion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
            $this->add_control(
                'button_background_hover',
                [
                    'label' 		=> __( 'Background', 'card-promotion' ),
                    'type' 			=> Controls_Manager::COLOR,
                    'default' => '#a00000',
                    'selectors'		=> [
                        '{{WRAPPER}} .promotion-card-button:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            ); 
            $this->add_control(
                'button-color_hover',
                [
                    'label' 		=> __( 'Color', 'card-promotion' ),
                    'type' 			=> Controls_Manager::COLOR,
                    'default'       => '#fff',
                    'selectors'		=> [
                        '{{WRAPPER}} .promotion-card-button:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

        
    $this->end_controls_section();


  }

// RENDER

protected function render() {
	
  $settings = $this->get_settings_for_display();

  if ( $settings['list'] ) {

    
    
    echo '<div class="promotion-card-container">';
    
    $card_id = 0;
        foreach (  $settings['list'] as $item ) {
        
             echo    '
                        <div class="promotion-card ' . $item['product_featured'] . ' ' .  $settings['product_discount_tag'] . ' ' .  $settings['product_notification'] . ' ' . $settings['product_star'] . '" id="promotion-item-' . $card_id . '">';
            
            

                echo    '<div class="promotion-card-image">
                            <figure class="image">
                            <img src=" ' . $item['product-image']['url'] . '" alt="' . $item['product-title'] . '" class="image">
                            </figure>';

                            if ( $settings['product_notification'] == 'noti') {
                                echo    '<div class="card-notification"><span class="stock-number">กำลังจะหมด</span></div>';
                            }

                echo    '</div>
                        <div class="promotion-card-content">
                            <div class="card-content">
                                <h3 class="card-title">' . $item['product-title'] . '</h3>

                                <div class="card-info">
                                    <div class="card-info-left">
                                        จองแล้ว <span class="count-number">' . number_format($item['product-counter']) . '</span> เซต
                                    </div>
                                    
                                    <div class="card-info-right">';

                                        if ( $settings['product_star'] == 'star-on') {
                                            echo    '<span class="promotion-star">★★★★★</span>';
                                        }
                                        
                                echo '</div>
                                </div>';

                                if ( $item['product-list'] ) {
                                    echo    '<div class="card-list">' . $item['product-list'] . '</div>';
                                }
                                
                                    
                                echo '

                                <div class="card-footer">
                                    <div class="card-footer-pricing">
                                        <span class="price-sale">'; if($item['product-price-sale']){echo number_format($item['product-price-sale']);} echo '</span>
                                        <span class="price-regular">'; if($item['product-price-regular']){echo number_format($item['product-price-regular']);} echo '</span> 
                                    </div>

                                    <div class="card-footer-button';
                                    
                                    if($settings['product-class']){
                                        echo ' ' . $settings['product-class'];
                                    }

                                    echo '"> 
                                        <a href="' . $settings['product-link'] . '" class="card-button" id="select-item-'. $card_id .'">' . $settings['product-button'] . '</a>
                                    </div>
                                </div>
                            </div>


                        </div></div>';
            


            $card_id = ($card_id + 1);

        }

    echo '</div>';
    
    }

} 

}