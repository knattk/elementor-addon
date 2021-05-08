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
                'default' => 'จองโปรนี้',
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
			'product_price_tag',
			[
				'label' => __( 'Price Tag', 'card-promotion-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'price-tag'
			]
		);
        $this->add_control(
			'product_star',
			[
				'label' => __( 'Star', 'card-promotion-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'star-on',
                'default'   => 'star-on'
			]
		);
        
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
            ]
        );

        $repeater->add_control(
                'product-list', [
                    'label' => __( 'รายการสินค้า', 'card-promotion' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'language' => 'html',
                    'rows' => 10,
                    'default' => 'รายการสินค้า',
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

    // Style
    $this->start_controls_section( //Card
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
                    '{{WRAPPER}} .flex-card' => 'background-color: {{VALUE}};'
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
                    '{{WRAPPER}} .flex-card-group' => 'flex: 1 1 {{SIZE}}%;'
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
                    '{{WRAPPER}} .flex-card-group' => 'max-width:{{SIZE}}%;'
                  ]
			]
        );
        $this->add_responsive_control(
			'card-padding',
			[
				'label' => __( 'Padding', 'card-promotion' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
				'selectors' => [
					'{{WRAPPER}} .flex-card-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'card-promotion' ),
				'selector' => '{{WRAPPER}} .flex-card',
			]
        );
    $this->end_controls_section();

    $this->start_controls_section( //Content
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
                '{{WRAPPER}} .flex-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    
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
                'selector' => '{{WRAPPER}} .flex-card-heading',
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
                    '{{WRAPPER}} .flex-card-heading' => 'color: {{VALUE}};'
                ]
            ]
        );

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
                'selector' => '{{WRAPPER}} .product-counter',
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
                    '{{WRAPPER}} .product-counter' => 'color: {{VALUE}};'
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
                'selector' => '{{WRAPPER}} .flex-card-content p',
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
                    '{{WRAPPER}} .flex-card-content p' => 'color: {{VALUE}};'
                ]
            ]
        );

    $this->end_controls_section();

    $this->start_controls_section( //Price tag
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

    $this->start_controls_section( //Button
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
                'default' => '#9B0000',
                'selectors'		=> [
                    '{{WRAPPER}} .flex-card-button' => 'background-color: {{VALUE}};'
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
                    '{{WRAPPER}} .flex-card-button' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button-text',
                'selector' => '{{WRAPPER}} .flex-card-button',
            ]
        );

        $this->add_responsive_control(
            'button-padding',
            [
                'label' => __( 'Padding', 'card-promotion' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .flex-card-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .flex-card-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'default' => '#9B0000',
                    'selectors'		=> [
                        '{{WRAPPER}} .flex-card-button:hover' => 'background-color: {{VALUE}};'
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
                        '{{WRAPPER}} .flex-card-button:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );
        
    $this->end_controls_section();

  }

protected function render() {
	
  $settings = $this->get_settings_for_display();

  if ( $settings['list'] ) {
    echo '<div class="flex-card-container">';
    $card_id = 0;
        foreach (  $settings['list'] as $item ) {
        
             echo    '<div class="flex-card-group" ><div class="flex-card ' . $item['product_featured'] . ' ' .  $settings['product_discount_tag'] . ' ' . $settings['product_star'] . '" id="promotion-item-' . $card_id . '">';
            
            

                echo    '<div class="flex-card-image">
                            <img src=" ' . $item['product-image']['url'] . '" alt="' . $item['product-title'] . '">
                            <div class="discount">-' . $item['product-discount'] . '%</div>';

                            if ( $settings['product_price_tag'] == 'price-tag') {
                                    echo    '<div class="product-price-tag">
                                                <div class="product-price-regular">' . number_format($item['product-price-sale']) . '.-</div>
                                                <div class="product-price-sale">จากราคาปกติ ' . number_format($item['product-price-regular']) . '.-</div>
                                            </div>';
                            }

                            
                echo    '</div>

                        <div class="flex-card-content">
                            <h3 class="flex-card-heading">' . $item['product-title'] . '</h3>
                            <div class="product-counter">จองแล้ว <span class="count-number">' . number_format($item['product-counter']) . '</span> เซต<span class="product-star">★★★★★</span></div>
                            
                            <p>' . $item['product-list'] . '</p>
                            <div class="' . $settings['product-class'] . '">
                                <a href="' . $settings['product-link'] . '" class="flex-card-button" id="select-item-'. $card_id .'">' . $settings['product-button'] . '</a>
                            </div>
                        </div>';
            

            echo    '</div></div>';

            $card_id = ($card_id + 1);

        }

    echo '</div>';
    
    }

} 

}