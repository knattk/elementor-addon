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

class UserReview extends Widget_Base{

    public function get_name(){
        return 'user-review';
    }

    public function get_title(){
        return 'Review (Deprecated)';
    }

    public function show_in_panel() {
        return false;
    }

    public function get_icon(){
        return 'eicon-star-o';
    }

    public function get_style_depends() {
        return ['elqu-style-css'];
    }

    public function get_categories(){
        return ['general'];
    }


    /*
    *
    *
    * REGISTER CONTROLS
    *
    *
    */

    protected function _register_controls(){

        /*
        *
        *
        * DATA
        * CONTROLLER
        *
        *
        */

        /* Tab Title */
        $this->start_controls_section(
            'content_section',
            [
                    'label' => __( 'Products', 'user-review' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
            


            /* Repeater Setup */    
            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'user-image',
                [
                    'label' => esc_html__( 'Image', 'user-review' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'user-name',
                [
                    'label' => esc_html__( 'Name', 'user-review' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Name', 'user-review' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'user-rating',
                [
                    'label' => esc_html__( 'Rating', 'user-review' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 5,
                    'step' => 1,
                    'default' => 5,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'user-review',
                [
                    'label' => __( 'Review', 'user-review' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'language' => 'html',
                    'rows' => 4,
                    'default' => 'Review',
                ]
            );



            
            /* Add Repeater */
                
            $this->add_control(
                    'list',
                    [
                        'label' => __( 'Products', 'user-review' ),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                            [
                                'list_title' => __( '', 'user-review' ),
                                'list_content' => __( '', 'user-review' ),
                            ]
                        ]
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

        /* Product Container */
        $this->start_controls_section(
            'style_container',
            [
                'label' => __( 'Container', 'user-review' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'card-flex',
                [
                    'label' => __( 'Gap', 'user-review' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'default' => 10,
                    'selectors'		=> [
                        '{{WRAPPER}} .user-review-container' => 'gap:{{SIZE}}px;'
                        ]
                ]
            );
            
            $this->add_responsive_control(
                'card-margin',
                [
                    'label' => __( 'Margin', 'user-review' ),
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
                        '{{WRAPPER}} .user-review-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();



        /* Card */
        $this->start_controls_section(
            'style_card',
            [
                'label' => __( 'Card', 'user-review' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'card_background',
                [
                    'label' 		=> __( 'Background', 'user-review' ),
                    'type' 			=> Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors'		=> [
                        '{{WRAPPER}} .user-review-card' => 'background-color: {{VALUE}};'
                    ]
                ]
            );   
            $this->add_responsive_control(
                'card-width',
                [
                    'label' => __( 'Max Width (%)', 'user-review' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 25,
                    'max' => 100,
                    'step' => 1,
                    'default' => 100,
                    'selectors'		=> [
                        '{{WRAPPER}} .user-review-card' => 'width:{{SIZE}}%;'
                    ]
                ]
            );
            $this->add_responsive_control(
                'card-max-width',
                [
                    'label' => __( 'Max Width (%)', 'user-review' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 25,
                    'max' => 100,
                    'step' => 1,
                    'default' => 100,
                    'selectors'		=> [
                        '{{WRAPPER}} .user-review-card' => 'max-width:{{SIZE}}%;'
                    ]
                ]
            );
            $this->add_responsive_control(
                'card-padding',
                [
                    'label' => __( 'Padding', 'user-review' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .user-review-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'card_radius',
                [
                    'label' => __( 'Border Radius', 'user-review' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .user-review-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'label' => __( 'Box Shadow', 'user-review-card' ),
                    'selector' => '{{WRAPPER}} .user-review-card',
                ]
            );
            
        $this->end_controls_section();


        /* Content */
        $this->start_controls_section(
            'style_content',
            [
                'label' => __( 'Content', 'user-review' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
            // Product name
            $this->add_control(
                'style_content_title',
                [
                    'label' => __( 'Reviewer name', 'user-review' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );


            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'text_name',
                    'selector' => '{{WRAPPER}} .review-name',
                    'separator'		=> 'after'
                ]
            );

            $this->add_control(
                'title-color',
                [
                    'label' 		=> __( 'Color', 'user-review' ),
                    'type' 			=> Controls_Manager::COLOR,
                    'default'       => '#000',
                    'selectors'		=> [
                        '{{WRAPPER}} .review-name' => 'color: {{VALUE}};'
                    ]
                ]
            );

            
            // Star
            $this->add_control(
                'style_content_star',
                [
                    'label' => __( 'Reviewer name', 'user-review' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );


            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'text_star',
                    'selector' => '{{WRAPPER}} .review-rating',
                    'separator'		=> 'after'
                ]
            );

            $this->add_control(
                'style_content_star_color',
                [
                    'label' 		=> __( 'Color', 'user-review' ),
                    'type' 			=> Controls_Manager::COLOR,
                    'default'       => '#000',
                    'selectors'		=> [
                        '{{WRAPPER}} .review-rating' => 'color: {{VALUE}};'
                    ]
                ]
            );

            // Star
            $this->add_control(
                'style_content_review',
                [
                    'label' => __( 'Reviewer name', 'user-review' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );


            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'text_review',
                    'selector' => '{{WRAPPER}} .review-content',
                    'separator'		=> 'after'
                ]
            );

            $this->add_control(
                'style_content_review_color',
                [
                    'label' 		=> __( 'Color', 'user-review' ),
                    'type' 			=> Controls_Manager::COLOR,
                    'default'       => '#000',
                    'selectors'		=> [
                        '{{WRAPPER}} .review-content' => 'color: {{VALUE}};'
                    ]
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
        
            if (!empty($settings['list']) && is_array($settings['list'])) {
                echo '<div class="user-review-container">';
        
                foreach ($settings['list'] as $item) {
                    // Sanitize fields
                    $name        = isset($item['user-name']) ? sanitize_text_field($item['user-name']) : 'ผู้ใช้ไม่ระบุชื่อ';
                    $masked_name = mb_substr($name, 0, max(0, mb_strlen($name) - 5)) . '*****';
                    $stars       = isset($item['user-rating']) ? absint($item['user-rating']) : 0;
                    $stars       = min($stars, 5); // Max 5 stars
                    $star_display = str_repeat('★', $stars);
        
                    $image_url   = isset($item['user-image']['url']) ? esc_url($item['user-image']['url']) : '';
                    $review      = isset($item['user-review']) ? wp_kses_post($item['user-review']) : '';
        
                    echo '<div class="user-review-card">';
                        echo '<div class="user-image">';
                            echo '<figure class="image">';
                                echo '<img src="' . $image_url . '" alt="' . esc_attr($name) . '">';
                            echo '</figure>';
                        echo '</div>';
        
                        echo '<div class="user-review">';
                            echo '<h4 class="review-name">' . esc_html($masked_name) . '</h4>';
                            echo '<div class="review-rating" data-rating="' . esc_attr($stars) . '">' . esc_html($star_display) . '</div>';
                            echo '<div class="review-content">' . $review . '</div>';
                        echo '</div>';
                    echo '</div>';
                }
        
                echo '</div>';
            }
        }
    
    

}