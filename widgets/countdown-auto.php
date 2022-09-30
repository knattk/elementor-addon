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
use Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CountdownAuto extends Widget_Base{

    public function get_name(){
        return 'countdown-auto';
    }

    public function get_title(){
        return 'Countdown Auto';
    }

    public function get_icon(){
        return 'eicon-countdown';
    }

    public function get_style_depends() {
        return ['elmta-style-css'];
    }
    public function get_script_depends() {
        return ['elmta-countdown-auto-js'];
    }

    public function get_categories(){
        return ['general'];
    }

    public function get_keywords() {
		return [ 'countdown', 'number', 'timer', 'time', 'date', 'evergreen' ];
	}

	/*
    *
    *
    * STYE
    * CONTROLLER
    *
    *
    */
    protected function _register_controls() {
        
		/* 
			Boxes 
		*/
		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Boxes', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'container_width',
			[
				'label' => __( 'Container Width', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .countdown-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_background_color',
			[
				'label' => __( 'Background Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .countdown-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'card-promotion' ),
				'selector' => '{{WRAPPER}} .countdown-item',
			]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .countdown-item',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_spacing',
			[
				'label' => __( 'Space Between', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .countdown-item:not(:first-of-type)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'body:not(.rtl) {{WRAPPER}} .countdown-item:not(:last-of-type)' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
					'body.rtl {{WRAPPER}} .countdown-item:not(:first-of-type)' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
					'body.rtl {{WRAPPER}} .countdown-item:not(:last-of-type)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/* 
			Content 
		*/
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_digits',
			[
				'label' => __( 'Digits', 'elementor-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'digits_color',
			[
				'label' => __( 'Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#BB0000',
				'selectors' => [
					'{{WRAPPER}} .countdown-digits' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'digits_typography',
				'selector' => '{{WRAPPER}} .countdown-digits',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_control(
			'heading_label',
			[
				'label' => __( 'Label', 'elementor-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => __( 'Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'defalut' => '#909090',
				'selectors' => [
					'{{WRAPPER}} .countdown-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .countdown-label',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
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

            echo '
                <div id="wrap-countdown" class="countdown-wrapper">
    
                    <div class="countdown-item"><span id="domHrs" class="countdown-digits countdown-hours">00</span><span class="countdown-label">ชั่วโมง</span></div>
                    <div class="countdown-item"><span id="domMin" class="countdown-digits countdown-minutes">00</span><span class="countdown-label">นาที</span></div>
                    <div class="countdown-item"><span id="domSec" class="countdown-digits countdown-seconds">00</span><span class="countdown-label">วินาที</span></div>
                
                </div>
            
            ';
    
    } 

}
