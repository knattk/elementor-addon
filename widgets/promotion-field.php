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
    return 'eicon-form-horizontal';
  }

  public function get_style_depends() {
    return ['style-css'];
  }
  public function get_script_depends() {
    return ['promotion-field-js'];
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
                'label' => __( 'Promotion', 'form-promotion' ),
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
            'form-pro-tag',
            [
                'label' => __( 'Tag', 'form-promotion' ),
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
                    '{{WRAPPER}} .promotion-field' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .promotion-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .promotion-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form-pro-card-shadow',
				'label' => __( 'Box Shadow', 'form-promotion' ),
				'selector' => '{{WRAPPER}} .promotion-field',
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
                'default'       => '#909090',
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
                'default'       => '#909090',
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

    // tag
    $this->start_controls_section(
        'form-pro-tag',
        [
            'label' => __( 'Tag', 'form-promotion' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    
        $this->add_control(
            'form-pro-tag-background',
            [
                'label' 		=> __( 'Background', 'form-promotion' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' => '#FBEEEE',
                'selectors'		=> [
                    '{{WRAPPER}} .tag' => 'background-color: {{VALUE}};'
                ]
            ]
        ); 
        $this->add_control(
            'form-pro-tag-color',
            [
                'label' 		=> __( 'Color', 'form-promotion' ),
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
            'form-pro-tag-padding',
            [
                'label' => __( 'Padding', 'form-promotion' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'form-pro-tag_radius',
            [
                'label' => __( 'Border Radius', 'form-promotion' ),
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
				'name' => 'form-promotion-tag-border',
				'label' => __( 'Border', 'form-promotion' ),
				'selector' => '{{WRAPPER}} .tag',
			]
		);

        
    $this->end_controls_section();


  }

// RENDER

protected function render() {
	
  $settings = $this->get_settings_for_display();

  if ( $settings['list'] ) {

    
    
    echo '<div id="promotion-fields">';
    
    $pro_id = 0;

        foreach (  $settings['list'] as $item ) {
            
                echo   '<div class="promotion-field" id="promotion-field-' . $pro_id . '">
                            <div class="columns title">
                                <div class="column pro">'. $item['form-pro-title'] .'</div>
                                <div class="column icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/></svg></div>
                            </div>
                            <div class="columns pricing">
                                <div class="column"><span class="price-tag"><span class="price-regular">' . number_format($item['form-pro-price-regular']) . '</span><span class="price-sale">' . number_format($item['form-pro-price-sale']) . '</span></span></div>
                                <div class="column">'; if($item['form-pro-tag']){echo '<span class="tag">' . $item['form-pro-tag'] . '</span>';} echo '</div>
                            </div>
                        </div>';

            $pro_id = ($pro_id + 1);

        }

    echo '</div>';
    
    }

} 

}