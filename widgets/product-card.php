<?php

namespace ELMTA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class ProductCard extends Widget_Base{

  public function get_name(){
    return 'product-card';
  }

  public function get_title(){
    return 'Product Card (Deprecated)';
  }

  public function show_in_panel() {
        return false;
}

  public function get_icon(){
    return 'eicon-accordion';
  }

  public function get_style_depends() {
    return ['elmta-style-css'];
  }
  public function get_script_depends() {
    return ['elmta-product-card-js'];
  }

  public function get_categories(){
    return ['general'];
  }

  protected function _register_controls(){

    /*
    *
    *
    * REGISTER CONTROLS
    *
    *
    */

    $this->start_controls_section(
		'content_section',
		[
				'label' => __( 'Products', 'product-card' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        
        $this->add_control(
            'product_button_label',
            [
                'label' => __( 'Button Label', 'product-card' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your title', 'plugin-name' ),
                'default' => 'คลิกจองโปร',
            ]
        );  
        $this->add_control(
            'product_items_label',
            [
                'label' => __( 'Items Label', 'product-card' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your title', 'plugin-name' ),
                'default' => 'สิ่งที่ได้รับ',
            ]
        ); 
        $this->add_control(
            'product_unit_label',
            [
                'label' => __( 'Unit Label', 'product-card' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your title', 'plugin-name' ),
                'default' => ' คนสนใจ',
            ]
        ); 
        $this->add_control(
            'product_button_link', 
            [
				'label' => esc_html__( 'Button Link', 'product-card' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#buy',
					'is_external' => false,
					'nofollow' => false,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
			]
        );
        $this->add_control(
            'product_card_class', 
            [
                'label' => __( 'Class', 'product-card' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
			'product_switch_items',
			[
				'label' => __( 'Show items', 'product-card-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'visible',
                'default'   => 'visible'
			]
		);
        

        
        
    /* Repeater Setup */    

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
                'product_card_title',
                [
                    'label' => __( 'หัวข้อ', 'product-card' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'language' => 'html',
                    'rows' => 2,
                    'default' => 'หัวข้อ',
                ]
        );

        $repeater->add_control(
            'product_card_image',
            [
                'label' => __( 'ภาพสินค้า', 'product-card' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
            ]
        );


        $repeater->add_control(
                'product_card_items', [
                    'label' => __( 'รายการสินค้า', 'product-card' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'language' => 'html',
                    'rows' => 10,
                ]
        );
        $repeater->add_control(
            'product_card_discount',
            [
                'label' => __( 'Discount', 'product-card' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
            ]
        );
        $repeater->add_control(
            'product_card_counter',
            [
                'label' => __( 'ความสนใจ', 'product-card' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999,
                'step' => 1,
                'default' => 13632,
            ]
        );
        
        $repeater->add_control(
            'product_card_price_sale',
            [
                'label' => __( 'Sale Price', 'product-card' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999,
                'step' => 1,
            ]
        );
        $repeater->add_control(
            'product_card_price_regular',
            [
                'label' => __( 'Regular Price', 'product-card' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999,
                'step' => 1,
            ]
        );
        
        $repeater->add_control(
			'product_card_progress',
			[
				'label' => __( 'Progress bar', 'product-card' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'true',
			]
		);

        $repeater->add_control(
			'product_card_countdown',
			[
				'label' => __( 'Countdown', 'product-card' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'true',
			]
		);

         
    /* Add Repeater */
        
        $this->add_control(
                'product_list',
                [
                    'label' => __( 'Items', 'product-card' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => __( '', 'product-card' ),
                            'list_content' => __( '', 'product-card' ),
                        ]
                    ]
                ]
        );
        $this->add_control(
			'important_note',
			[
                'label' => __( 'Important Note', 'product-card' ),
                'show_label' => false,
				'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( 'การเปิดใช้ Countdown ในสินค้า จะต้องมี Widget Countdown อยู่แล้ว', 'plugin-name' ),
                'separator' => 'before',
			]
		);
    

    $this->end_controls_section();



    /*
    *
    *
    * STYE
    * CONTROLLER
    *
    *
    */

    /* 
     * Card tab
     * style_card
     */
    $this->start_controls_section(
        'style_card_tab',
        [
            'label' => __( 'Card', 'product-card' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
        $this->add_responsive_control(
            'style_card_flex',
            [
                'label' => __( 'Flex (%)', 'product-card' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 25,
                'max' => 100,
                'step' => 1,
                'default' => 100,
                'selectors'		=> [
                    '{{WRAPPER}} .product-wrapper' => 'flex: 1 1 {{SIZE}}%;'
                ]
            ]
        );
        $this->add_responsive_control(
            'style_card_width',
            [
                'label' => __( 'Max Width (%)', 'product-card' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 25,
                'max' => 100,
                'step' => 1,
                'default' => 100,
                'selectors'		=> [
                    '{{WRAPPER}} .product-card' => 'max-width:{{SIZE}}%;'
                ]
            ]
        );
        $this->add_control(
            'style_card_background',
            [
                'label' 		=> __( 'Background', 'product-card' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors'		=> [
                    '{{WRAPPER}} .product-card' => 'background-color: {{VALUE}};'
                ]
            ]
        );   
        
        
        $this->add_responsive_control(
			'style_card_margin',
			[
				'label' => __( 'Margin', 'product-card' ),
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
					'{{WRAPPER}} .product-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        $this->add_responsive_control(
            'style_card_radius',
            [
                'label' => __( 'Border Radius', 'product-card' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .product-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'style_card_box_shadow',
				'label' => __( 'Box Shadow', 'product-card' ),
				'selector' => '{{WRAPPER}} .product-card',
			]
        );
        
    $this->end_controls_section();


    /* 
     * Content tab
     */
    $this->start_controls_section(
        'style_content_tab',
        [
            'label' => __( 'Content', 'product-card' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $this->add_responsive_control(
        'style_content_padding',
        [
            'label' => __( 'Padding', 'product-card' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem' ],
            'selectors' => [
                '{{WRAPPER}} .product-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    /* Title */
    $this->add_control(
        'style_content_title_heading',
        [
            'label' => __( 'Title', 'product-card' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_content_title',
                'selector' => '{{WRAPPER}} .product-heading h3',
                'separator'		=> 'after'
            ]
        );

        $this->add_control(
            'style_content_title-color',
            [
                'label' 		=> __( 'Color', 'product-card' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#000',
                'selectors'		=> [
                    '{{WRAPPER}} .product-name' => 'color: {{VALUE}};'
                ]
            ]
        );

        /* Counter */
        $this->add_control(
            'style_content_counter',
            [
                'label' => __( 'Counter', 'product-card' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_content_counter_text',
                'selector' => '{{WRAPPER}} .product-short-detail span',
                'separator'		=> 'after'
            ]
        );
        $this->add_control(
            'style_content_color',
            [
                'label' 		=> __( 'Color', 'product-card' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#000',
                'selectors'		=> [
                    '{{WRAPPER}} .product-short-detail span' => 'color: {{VALUE}};'
                ]
            ]
        );


    $this->add_control(
        'style_content_detail',
        [
            'label' => __( 'Product List', 'product-card' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_content_item',
                'selector' => '{{WRAPPER}} .product-items',
                'separator'		=> 'after'
            ]
        );
        $this->add_control(
            'style_content_list_color',
            [
                'label' 		=> __( 'Color', 'product-card' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#5F5F5F',
                'selectors'		=> [
                    '{{WRAPPER}} .product-items' => 'color: {{VALUE}};',
                ]
            ]
        );
        



    $this->end_controls_section();

    /* 
     * Price tab
     */
    $this->start_controls_section(
        'style_price_tag',
        [
            'label' => __( 'Price', 'product-card' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
        /* Sale */
        $this->add_control(
            'style_sale_price_heading',
            [
                'label' => __( 'Sale price', 'product-card' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'style_sale_price_color',
            [
                'label' 		=> __( 'Color', 'product-card' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#BB0000',
                'selectors'		=> [
                    '{{WRAPPER}} span.sale-price' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_sale_price_text',
                'selector' => '{{WRAPPER}} span.sale-price',
            ]
        );

        /* Regular */
        $this->add_control(
            'style_regular_price_heading',
            [
                'label' => __( 'Regular rice', 'product-card' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'style_regular_price_color',
            [
                'label' 		=> __( 'Color', 'product-card' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors'		=> [
                    '{{WRAPPER}} span.regular-price' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_regular_price_text',
                'selector' => '{{WRAPPER}} span.regular-price',
            ]
        );
        
    $this->end_controls_section();


    /* 
     * Button tab
     */
    $this->start_controls_section(
        'style_button',
        [
            'label' => __( 'Button', 'product-card' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    
        $this->add_control(
            'style_button_background',
            [
                'label' 		=> __( 'Background', 'product-card' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' => '#CD0000',
                'selectors'		=> [
                    '{{WRAPPER}} .product-footer .button' => 'background-color: {{VALUE}};'
                ]
            ]
        ); 
        $this->add_control(
            'style_button_color',
            [
                'label' 		=> __( 'Color', 'product-card' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#fff',
                'selectors'		=> [
                    '{{WRAPPER}} .product-footer .button' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'style_button_text',
                'selector' => '{{WRAPPER}} .product-footer .button',
            ]
        );
        $this->add_responsive_control(
            'style_button_padding',
            [
                'label' => __( 'Padding', 'product-card' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .product-footer .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_button_border_radius',
            [
                'label' => __( 'Border Radius', 'product-card' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .product-footer .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'style_button_hover',
            [
                'label' => __( 'Hover', 'product-card' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
            $this->add_control(
                'button_background_hover',
                [
                    'label' 		=> __( 'Background', 'product-card' ),
                    'type' 			=> Controls_Manager::COLOR,
                    'default' => '#a00000',
                    'selectors'		=> [
                        '{{WRAPPER}} .product-footer .button:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            ); 
            $this->add_control(
                'button_color_hover',
                [
                    'label' 		=> __( 'Color', 'product-card' ),
                    'type' 			=> Controls_Manager::COLOR,
                    'default'       => '#fff',
                    'selectors'		=> [
                        '{{WRAPPER}} .product-footer .button:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

        
    $this->end_controls_section();


  }

    public function thousandsCurrencyFormat($num) {

        if($num>1000) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
            
            return $x_display;

        }
            
        return $num;

    }

    /*
    *
    *
    * RENDER
    * Editor mode
    *
    *
    */

    protected function render() {
        $settings = $this->get_settings_for_display();
    
        // Safely add link attributes
        if (!empty($settings['product_button_link']['url'])) {
            $this->add_link_attributes('product_button_link', $settings['product_button_link']);
        }
    
        if (!empty($settings['product_list']) && is_array($settings['product_list'])) {
            echo '<div class="product-wrapper">';
            $product_id = 1;
    
            foreach ($settings['product_list'] as $item) {
                // Start product card
                echo '<div class="product-card" product-id="' . esc_attr($product_id) . '">';
    
                // Product image
                if (!empty($item['product_card_image']['url'])) {
                    echo '<div class="product-image">
                            <img src="' . esc_url($item['product_card_image']['url']) . '" alt="' . esc_attr($item['product_card_title'] ?? '') . '">
                          </div>';
                }
    
                echo '<div class="product-content">
                        <div class="product-heading">';
    
                // Countdown
                if (!empty($item['product_card_countdown']) && $item['product_card_countdown'] === 'true') {
                    echo '<div class="product-countdown">
                            <span>หมดเวลาใน</span>
                            <div class="product-countdown-wrapper">
                                <span class="product-countdown-digits product-countdown-days">--</span> : 
                                <span class="productcountdown-digits product-countdown-hours">--</span> : 
                                <span class="product-countdown-digits product-countdown-minutes">--</span> : 
                                <span class="product-countdown-digits product-countdown-seconds">--</span>		
                            </div>
                          </div>';
                }
    
                // Progress Bar
                if (!empty($item['product_card_progress']) && $item['product_card_progress'] === 'true') {
                    $fire_img_url = esc_url(plugin_dir_url(__DIR__) . '/includes/image/fire.png');
                    echo '<span class="product-progress-bar">
                            <span class="progress" value="0" style="width:0%">
                                <span class="progress-text"></span>
                                <img src="' . $fire_img_url . '" alt="">
                            </span>
                          </span>';
                }
    
                echo '<h3 class="product-name">' . esc_html($item['product_card_title'] ?? '') . '</h3>';
    
                echo '<div class="product-detail">
                        <div class="product-short-detail">';
    
                // Toggle label and user counter
                if (!empty($item['product_card_items'])) {
                    echo '<span class="product-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                            </svg> 
                            ' . esc_html($settings['product_items_label'] ?? '') . '
                          </span>';
                }
    
                echo '<span class="users">
                        <span class="user-counter">' . esc_html($this->thousandsCurrencyFormat($item['product_card_counter'] ?? 0)) . '</span>' .
                        esc_html($settings['product_unit_label'] ?? '') . '
                      </span>
                    </div>';
    
                // Product items detail
                if (!empty($item['product_card_items'])) {
                    echo '<div class="product-items ' . esc_attr($settings['product_switch_items'] ?? '') . '">' .
                            wp_kses_post($item['product_card_items']) . 
                         '</div>';
                }
    
                echo '</div> <!-- /product-detail -->
                    </div> <!-- /product-heading -->
                    <div class="product-footer">
                        <div class="price-wrapper">';
    
                if (!empty($item['product_card_discount'])) {
                    echo '<span class="discount"> -' . esc_html($item['product_card_discount']) . '% </span>';
                }
    
                if (!empty($item['product_card_price_sale'])) {
                    echo '<div class="price-group">
                            <span class="sale-price">' . esc_html(number_format(floatval($item['product_card_price_sale']))) . '</span>
                            <span class="regular-price">' . esc_html(number_format(floatval($item['product_card_price_regular'] ?? 0))) . '</span>
                          </div>';
                }
    
                echo '</div>
                    <a class="button product-button" href="' . esc_url($settings['product_button_link']['url']) . '">' .
                        esc_html($settings['product_button_label'] ?? 'Buy Now') .
                    '</a>
                    </div>
                  </div>
                </div>';
    
                $product_id++;
            }
    
            echo '</div>';
        }
    }
    
    
}