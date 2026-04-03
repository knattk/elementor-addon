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
            return 'Promotion Field (Deprecated)';
    }

    public function show_in_panel() {
        return false;
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
        
            if (empty($settings['list']) || !is_array($settings['list'])) {
                return;
            }
        
            $promotion_id = 1;
            $wrapper_classes = esc_attr($settings['promotion-field-item-list-switch'] ?? '');
        
            echo '<div class="promotion-field-wrapper ' . $wrapper_classes . '">';
        
            foreach ($settings['list'] as $item) {
                $title       = !empty($item['promotion-field-title']) ? esc_html($item['promotion-field-title']) : '';
                $item_content= !empty($item['promotion-field-item']) ? wp_kses_post($item['promotion-field-item']) : '';
                $price_sale  = isset($item['promotion-field-price-sale']) ? floatval($item['promotion-field-price-sale']) : null;
                $price_regular = isset($item['promotion-field-price-regular']) ? floatval($item['promotion-field-price-regular']) : null;
                $hashtag     = !empty($item['promotion-field-hashtag']) ? esc_html($item['promotion-field-hashtag']) : '';
        
                echo '<div class="promotion-field" promotion-id="' . esc_attr($promotion_id) . '">';
                echo '<div class="promotion-field-content">';
                echo '<div class="promotion-field-heading">';
        
                if ($title) {
                    echo '<h3 class="promotion-title">' . $title . '</h3>';
                }
        
                if ($item_content) {
                    echo '<div class="promotion-items">' . $item_content . '</div>';
                }
        
                echo '<span class="icon"><svg viewBox="0 0 512 512" width="26px" height="26px"><path d="..."/></svg></span>';
                echo '</div>'; // .promotion-field-heading
        
                echo '<div class="promotion-field-footer">';
        
                if ($price_sale !== null && $price_regular !== null) {
                    echo '<div class="pricing-wrapper">
                            <span class="sale-price">' . number_format($price_sale) . '</span>
                            <span class="regular-price">' . number_format($price_regular) . '</span>
                        </div>';
                }
        
                if ($hashtag) {
                    echo '<div class="tag-wrapper">
                            <span class="tag">' . $hashtag . '</span>
                        </div>';
                }
        
                echo '</div>'; // .promotion-field-footer
        
                // Notification box for savings
                if ($price_sale !== null && $price_regular !== null && $price_regular > $price_sale) {
                    $price_saved = $price_regular - $price_sale;
        
                    echo '<div class="promotion-field-notification">
                            <div class="notification-content">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="..."/></svg>
                                <span> คุณประหยัด ' . number_format($price_saved) . ' บาท จากโปรนี้</span>
                            </div>
                        </div>';
                }
        
                echo '</div>'; // .promotion-field-content
                echo '</div>'; // .promotion-field
        
                $promotion_id++;
            }
        
            echo '</div>'; // .promotion-field-wrapper
        }
    

}