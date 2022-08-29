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
                'default' => 'Item 1<br>Item 2'
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
            'promotion-field-price-tag-switch',
            [
                'label' => __( 'Price Tag', 'promotion-field' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'price-tag-active',
                'default'   => 'price-tag-active'
            ]
        );
        $this->add_control(
            'promotion-field-item-list-switch',
            [
                'label' => __( 'Item list', 'promotion-field' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'item-list-active',
                'default'   => 'item-list-active'
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


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_title',
                'selector' => '{{WRAPPER}} .pro',
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
                    '{{WRAPPER}} .pro' => 'color: {{VALUE}};'
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
                'selector' => '{{WRAPPER}} .price-regular',
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
                    '{{WRAPPER}} .price-regular' => 'color: {{VALUE}};'
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
                'selector' => '{{WRAPPER}} .price-sale',
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
                    '{{WRAPPER}} .price-sale' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tag' => 'background-color: {{VALUE}};'
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
                    '{{WRAPPER}} .tag' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_tag-text',
                'selector' => '{{WRAPPER}} .tag',
            ]
        );
        $this->add_responsive_control(
            'promotion-field-tag-padding',
            [
                'label' => __( 'Padding', 'promotion-field' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'promotion-field-tag-border',
				'label' => __( 'Border', 'promotion-field' ),
				'selector' => '{{WRAPPER}} .tag',
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

            $promotion_id = 0;

            echo '<div id="promotion-fields">';
            
                foreach (  $settings['list'] as $item ) {
                    
                    
                        echo   '<div class="promotion-field';
                        if ( $settings['promotion-field-item-list-switch'] == 'item-list-active') {
                            echo ' item-list-active';
                        }
                        echo '" id="promotion-field-' . $promotion_id . '">
                                    <div class="columns promotion-title">
                                        <div class="column pro">'. $item['promotion-field-title'] .'</div>
                                        <div class="column icon"><svg viewBox="0 0 512 512" width="26px" height="26px"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/></svg></div>
                                    </div>
                                    <div class="columns promotion-item">
                                        <div class="column">'. $item['promotion-field-item'] .'</div>
                                    </div>';

                                if ( $settings['promotion-field-price-tag-switch'] == 'price-tag-active') {
                                    echo    '<div class="columns promotion-pricing">
                                                <div class="column">
                                                    <span class="price-tag">
                                                        <span class="price-regular">';
                                                            if($item['promotion-field-price-regular']){
                                                                echo number_format($item['promotion-field-price-regular']);
                                                            } 
                                                        echo '</span>
                                                        <span class="price-sale">';
                                                            if($item['promotion-field-price-sale']){
                                                                echo number_format($item['promotion-field-price-sale']);
                                                            } 
                                                        echo '</span>
                                                    </span>
                                                </div>
                                                <div class="column">'; 
                                                    if($item['promotion-field-hashtag']){
                                                        echo '<span class="tag">' . $item['promotion-field-hashtag'] . '</span>';
                                                    } 
                                                echo '</div>
                                            </div>';
                                }
                        echo '</div>';

                    $promotion_id = ($promotion_id + 1);

                }

            echo '</div>';
            
            }

    }   

}