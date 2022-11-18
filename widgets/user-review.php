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
return 'Review';
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

       


        if ( $settings['list'] ) {

                echo '<div class="user-review-container">';
                    
                foreach (  $settings['list'] as $item ) {
     
                    $stars = $item['user-rating'];
                    $name = $item['user-name'];

                    echo '
                    <div class="user-review-card"><div class="user-image">
                            <figure class="image">
                                <img src="' . $item['user-image']['url'] . '" alt="' . $item['user-name'] . '">
                            </figure>
                        </div>

                        <div class="user-review">
                            <h4 class="review-name">' . substr_replace($name,"*****",-5) . '</h4>
                            <div class="review-rating" data-rating="' . $item['user-rating'] .'">'. str_repeat("★", $stars) . '</div>


                            <div class="review-content">' . $item['user-review'] . '</div>
                        </div></div>';
            
                }
                
            echo '</div>';

            
            }

    } 

}