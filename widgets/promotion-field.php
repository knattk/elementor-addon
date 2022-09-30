<?php

namespace ELMTA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class PromotionField extends Widget_Base{

  public function get_name(){
    return 'promotion-field';
  }

  public function get_title(){
    return 'Promotion Field';
  }

  public function get_icon(){
    return 'eicon-select';
  }

  public function get_style_depends() {
    return ['elmta-style-css'];
  }
  public function get_script_depends() {
    return ['elmta-promotion-field-js'];
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

    /* Tab Title */
    $this->start_controls_section(
		'content_section',
		[
				'label' => __( 'Promotions', 'promotion-field' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        
    /* Repeater Setup */    

        $repeater = new \Elementor\Repeater();



        $repeater->add_control(
            'promotion-field-title', [
                'label' => __( 'Promotion', 'promotion-field' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'language' => 'html',
                'rows' => 2,
                'placeholder' => esc_html__( 'Promotion', 'promotion-field' ),
                'default' => 'Promotion name'
            ]
        );

        $repeater->add_control(
            'promotion-field-item', [
                'label' => __( 'Items', 'promotion-field' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'language' => 'html',
                'rows' => 5,
                'default' => 'Item 1<br>'
            ]
        );
        $repeater->add_control(
            'promotion-field-price-sale',
            [
                'label' => __( 'Sale Price', 'promotion-field' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999,
                'step' => 1,
                'default' => 0,
            ]
        );
        $repeater->add_control(
            'promotion-field-price-regular',
            [
                'label' => __( 'Regular Price', 'promotion-field' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999,
                'step' => 1,
                'default' => 0,
            ]
        );
        
        $repeater->add_control(
            'promotion-field-hashtag',
            [
                'label' => __( 'Tag', 'promotion-field' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'language' => 'html',
                'rows' => 1,
            ]
    );
    /* End Repeater Setup */
         
        $this->add_control(
            'promotion-field-item-list-switch',
            [
                'label' => __( 'Show items', 'promotion-field' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'items-visible',
                'default'   => 'items-visible'
            ]
        );

    /* Add Repeater */
        
        $this->add_control(
                'list',
                [
                    'label' => __( 'Promotions', 'promotion-field' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => __( '', 'promotion-field' ),
                            'list_content' => __( '', 'promotion-field' ),
                        ]
                    ]
                ]
        );

        

        $this->add_control(
			'important_note',
			[
                'label' => __( 'Important Note', 'promotion-field' ),
                'show_label' => false,
				'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( 'Widget นี้ จะต้องมีฟอร์มรองรับ และมี field_1 เป็น textarea', 'plugin-name' ),
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


    
    $this->start_controls_section(
        'promotion-field-card-style',
        [
            'label' => __( 'Card', 'promotion-field' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

        $this->add_control(
            'promotion-field-card-background',
            [
                'label' 		=> __( 'Background', 'promotion-field' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors'		=> [
                    '{{WRAPPER}} .promotion-field' => 'background-color: {{VALUE}};'
                ]
            ]
        );   
        $this->add_responsive_control(
			'promotion-field-card-margin',
			[
				'label' => __( 'Margin', 'promotion-field' ),
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
					'{{WRAPPER}} .promotion-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        $this->add_responsive_control(
            'promotion-field-card-radius',
            [
                'label' => __( 'Border Radius', 'promotion-field' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .promotion-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'promotion-field-card-shadow',
				'label' => __( 'Box Shadow', 'promotion-field' ),
				'selector' => '{{WRAPPER}} .promotion-field',
			]
        );
        
    $this->end_controls_section();


    /* Content */
    
    $this->start_controls_section(
        'style_content',
        [
            'label' => __( 'Content', 'promotion-field' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    /* Title */
    $this->add_control(
        'style_content_title',
        [
            'label' => __( 'Title', 'promotion-field' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

        /* Title */
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_title',
                'selector' => '{{WRAPPER}} .promotion-title',
                'separator'		=> 'after'
            ]
        );

        $this->add_control(
            'title-color',
            [
                'label' 		=> __( 'Color', 'promotion-field' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#191919',
                'selectors'		=> [
                    '{{WRAPPER}} .promotion-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        /* Items */
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_items',
                'selector' => '{{WRAPPER}} .promotion-items',
                'separator'		=> 'after'
            ]
        );

        $this->add_control(
            'items-color',
            [
                'label' 		=> __( 'Color', 'promotion-field' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#191919',
                'selectors'		=> [
                    '{{WRAPPER}} .promotion-items' => 'color: {{VALUE}};'
                ]
            ]
        );


        /* Regular price */
        $this->add_control(
            'style_content_counter',
            [
                'label' => __( 'Regular price', 'promotion-field' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'card-counter',
                'selector' => '{{WRAPPER}} .regular-price',
                'separator'		=> 'after'
            ]
        );
        $this->add_control(
            'counter_color',
            [
                'label' 		=> __( 'Color', 'promotion-field' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#909090',
                'selectors'		=> [
                    '{{WRAPPER}} .regular-price' => 'color: {{VALUE}};'
                ]
            ]
        );

        /* Sale price */
        $this->add_control(
            'style_content_detail',
            [
                'label' => __( 'Sale price', 'promotion-field' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'promotion-field',
                'selector' => '{{WRAPPER}} .sale-price',
                'separator'		=> 'after'
            ]
        );
        $this->add_control(
            'product_list_color',
            [
                'label' 		=> __( 'Color', 'promotion-field' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#BB0000',
                'selectors'		=> [
                    '{{WRAPPER}} .sale-price' => 'color: {{VALUE}};',
                ]
            ]
        );
        



    $this->end_controls_section();

    /* Tag */
    $this->start_controls_section(
        'promotion-field-tag',
        [
            'label' => __( 'Tag', 'promotion-field' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    
        $this->add_control(
            'promotion-field-tag-background',
            [
                'label' 		=> __( 'Background', 'promotion-field' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' => '#FBEEEE',
                'selectors'		=> [
                    '{{WRAPPER}} .promotion-field .tag' => 'background-color: {{VALUE}};'
                ]
            ]
        ); 
        $this->add_control(
            'promotion-field-tag-color',
            [
                'label' 		=> __( 'Color', 'promotion-field' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#BB0000',
                'selectors'		=> [
                    '{{WRAPPER}} .promotion-field .tag' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_tag-text',
                'selector' => '{{WRAPPER}} .promotion-field .tag',
            ]
        );
        $this->add_responsive_control(
            'promotion-field-tag-padding',
            [
                'label' => __( 'Padding', 'promotion-field' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .promotion-field .tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'promotion-field-tag_radius',
            [
                'label' => __( 'Border Radius', 'promotion-field' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .promotion-field .tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'promotion-field-tag-border',
				'label' => __( 'Border', 'promotion-field' ),
				'selector' => '{{WRAPPER}} .promotion-field .tag',
			]
		);

        
    $this->end_controls_section();

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

        if ( $settings['list'] ) {

            $promotion_id = 1;

            echo '<div class="promotion-field-wrapper ' . $settings['promotion-field-item-list-switch']. '">';
            
                foreach (  $settings['list'] as $item ) {

                    echo '<div class="promotion-field" promotion-id="' . $promotion_id . '">
                            <div class="promotion-field-content">
                                <div class="promotion-field-heading">';
                                    if($item['promotion-field-title']){
                                        echo    '<h3 class="promotion-title">' . $item['promotion-field-title'] . '</h3>';
                                    };
                                    if($item['promotion-field-item']){
                                        echo    '<div class="promotion-items">' . $item['promotion-field-item'] . '</div>';
                                    };

                                    echo '<span class="icon"><svg viewBox="0 0 512 512" width="26px" height="26px"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/></svg></span>
                                </div>
                                <div class="promotion-field-footer">';
                                
                                    if($item['promotion-field-price-sale']){
                                        echo    '<div class="pricing-wrapper">
                                                    <span class="sale-price">' . number_format($item['promotion-field-price-sale']) . '</span>
                                                    <span class="regular-price">' . number_format($item['promotion-field-price-regular']) . '</span>
                                                </div>';
                                    }

                                    if($item['promotion-field-hashtag']){
                                        echo    '<div class="tag-wrapper">
                                                    <span class="tag">' . $item['promotion-field-hashtag'] . '</span>
                                                </div>';
                                    } 

                            echo '</div>';
                            if($item['promotion-field-price-sale'] && $item['promotion-field-price-regular']){

                                $price_regular =$item['promotion-field-price-regular'];
                                $price_sale = $item['promotion-field-price-sale'];
                                $price_total = $price_regular - $price_sale;

                                echo    '<div class="promotion-field-notification">
                                            <div class="notification-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 352C293.2 352 319.2 334.5 334.4 318.1C343.3 308.4 358.5 307.7 368.3 316.7C378 325.7 378.6 340.9 369.6 350.6C347.7 374.5 309.7 400 256 400C202.3 400 164.3 374.5 142.4 350.6C133.4 340.9 133.1 325.7 143.7 316.7C153.5 307.7 168.7 308.4 177.6 318.1C192.8 334.5 218.8 352 256 352zM208.4 208C208.4 225.7 194 240 176.4 240C158.7 240 144.4 225.7 144.4 208C144.4 190.3 158.7 176 176.4 176C194 176 208.4 190.3 208.4 208zM304.4 208C304.4 190.3 318.7 176 336.4 176C354 176 368.4 190.3 368.4 208C368.4 225.7 354 240 336.4 240C318.7 240 304.4 225.7 304.4 208zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                                                <span> คุณประหยัด  '. number_format($price_total) .' บาท จากโปรนี้</span>    
                                            </div>
                                        </div>';
                            }
                        echo '</div>
                    </div>';

                    $promotion_id = ($promotion_id + 1);

                }

            echo '</div>';
            
            }

    }   

}