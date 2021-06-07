<?php

namespace ELMTA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class PromotionForm extends Widget_Base{

  public function get_name(){
    return 'promotion-form';
  }

  public function get_title(){
    return 'Form Pro';
  }

  public function get_icon(){
    return 'eicon-form-horizontal';
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
				'label' => __( 'Promotions', 'form-promotion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        
    /* Repeater Setup */    

        $repeater = new \Elementor\Repeater();



        $repeater->add_control(
            'form-pro-title', [
                'label' => __( 'รายละเอียด', 'form-promotion' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'language' => 'html',
                'rows' => 10,
            ]
        );
        
        $repeater->add_control(
            'form-pro-price-regular',
            [
                'label' => __( 'Regular Price', 'form-promotion' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999,
                'step' => 1,
                'default' => 0,
            ]
        );
        $repeater->add_control(
            'form-pro-price-sale',
            [
                'label' => __( 'Sale Price', 'form-promotion' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999,
                'step' => 1,
                'default' => 0,
            ]
        );
        $repeater->add_control(
            'form-pro-badge',
            [
                'label' => __( 'ป้ายสินค้า', 'form-promotion' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'language' => 'html',
                'rows' => 1,
            ]
    );

         
    /* Add Repeater */
        
        $this->add_control(
                'list',
                [
                    'label' => __( 'Promotions', 'form-promotion' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => __( '', 'form-promotion' ),
                            'list_content' => __( '', 'form-promotion' ),
                        ]
                    ]
                ]
        );
        $this->add_control(
			'important_note',
			[
                'label' => __( 'Important Note', 'form-promotion' ),
                'show_label' => false,
				'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( 'Widget นี้ จะต้องมีฟอร์มรองรับ และมี field_1 เป็น textarea', 'plugin-name' ),
                'separator' => 'before',
			]
		);
    

    $this->end_controls_section();



    /* ---------- STYLE ---------- */


    // CARD -----------------------------------------
    $this->start_controls_section(
        'form-pro-card-style',
        [
            'label' => __( 'Card', 'form-promotion' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

        $this->add_control(
            'form-pro-card-background',
            [
                'label' 		=> __( 'Background', 'form-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors'		=> [
                    '{{WRAPPER}} .em-promotion' => 'background-color: {{VALUE}};'
                ]
            ]
        );   
        $this->add_responsive_control(
			'form-pro-card-margin',
			[
				'label' => __( 'Margin', 'form-promotion' ),
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
					'{{WRAPPER}} .em-promotion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        $this->add_responsive_control(
            'form-pro-card-radius',
            [
                'label' => __( 'Border Radius', 'form-promotion' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .em-promotion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form-pro-card-shadow',
				'label' => __( 'Box Shadow', 'form-promotion' ),
				'selector' => '{{WRAPPER}} .em-promotion',
			]
        );
        
    $this->end_controls_section();


    // CONTENT -----------------------------------------
    
    $this->start_controls_section(
        'style_content',
        [
            'label' => __( 'Content', 'form-promotion' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    //TITLE

    
    $this->add_control(
        'style_content_title',
        [
            'label' => __( 'Title', 'form-promotion' ),
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
                'label' 		=> __( 'Color', 'form-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#454545',
                'selectors'		=> [
                    '{{WRAPPER}} .pro' => 'color: {{VALUE}};'
                ]
            ]
        );

        // Regular price
        $this->add_control(
            'style_content_counter',
            [
                'label' => __( 'Regular price', 'form-promotion' ),
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
                'label' 		=> __( 'Color', 'form-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#757575',
                'selectors'		=> [
                    '{{WRAPPER}} .price-regular' => 'color: {{VALUE}};'
                ]
            ]
        );

        // Sale price
        $this->add_control(
            'style_content_detail',
            [
                'label' => __( 'Sale price', 'form-promotion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'form-promotion',
                'selector' => '{{WRAPPER}} .price-sale',
                'separator'		=> 'after'
            ]
        );
        $this->add_control(
            'product_list_color',
            [
                'label' 		=> __( 'Color', 'form-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#BB0000',
                'selectors'		=> [
                    '{{WRAPPER}} .price-sale' => 'color: {{VALUE}};',
                ]
            ]
        );
        



    $this->end_controls_section();

    // BADGE
    $this->start_controls_section(
        'form-pro-badge',
        [
            'label' => __( 'Tag', 'form-promotion' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    
        $this->add_control(
            'form-pro-badge-background',
            [
                'label' 		=> __( 'Background', 'form-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors'		=> [
                    '{{WRAPPER}} .badge' => 'background-color: {{VALUE}};'
                ]
            ]
        ); 
        $this->add_control(
            'form-pro-badge-color',
            [
                'label' 		=> __( 'Color', 'form-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default'       => '#BB0000',
                'selectors'		=> [
                    '{{WRAPPER}} .badge' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_tag-text',
                'selector' => '{{WRAPPER}} .badge',
            ]
        );
        $this->add_responsive_control(
            'form-pro-badge-padding',
            [
                'label' => __( 'Padding', 'form-promotion' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'form-pro-badge_radius',
            [
                'label' => __( 'Border Radius', 'form-promotion' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form-promotion-badge-border',
				'label' => __( 'Border', 'form-promotion' ),
				'selector' => '{{WRAPPER}} .badge',
			]
		);

        
    $this->end_controls_section();


  }

// RENDER

protected function render() {
	
  $settings = $this->get_settings_for_display();

  if ( $settings['list'] ) {

    
    
    echo '<div id="em-promotions">';
    
    $pro_id = 0;

        foreach (  $settings['list'] as $item ) {
            
                echo   '<div class="em-promotion" id="em-promotion-' . $pro_id . '">
                            <div class="columns name">
                                <div class="column pro">'. $item['form-pro-title'] .'</div>
                                <div class="column icon"><img src="https://www.collakenko.com/wp-content/uploads/2021/06/checked.png"></div>
                            </div>
                            <div class="columns info">
                                <div class="column"><span class="price-tag"><span class="price-regular">' . number_format($item['form-pro-price-regular']) . '</span><span class="price-sale">' . number_format($item['form-pro-price-sale']) . '</span></span></div>
                                <div class="column">'; if($item['form-pro-badge']){echo '<span class="badge">' . $item['form-pro-badge'] . '</span>';} echo '</div>
                            </div>
                        </div>';

            $pro_id = ($pro_id + 1);

        }

    echo '</div>';
    
    }

} 

}