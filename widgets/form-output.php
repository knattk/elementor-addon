<?php

namespace ELMTA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class FormOutput extends Widget_Base{

  public function get_name(){
    return 'form-output';
  }

  public function get_title(){
    return 'Form Output';
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
				'label' => __( 'Promotions', 'form-output' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        
        $this->add_control(
			'form_output_price_prefix',
			[
				'label' => __( 'discount prefix', 'form-output' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'ส่วนลด', 'form-output' ),
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
  

 

    //
    // STYLE
    //

    

    $this->start_controls_section(
      'style',
      [
          'label' => __( 'Heading', 'em-output' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
          'name' => 'em-output-heading',
          'selector' => '{{WRAPPER}} .em-output h3',
          'separator'		=> 'after'
      ]
  );
  $this->add_responsive_control(
    'heading-margin',
    [
      'label' => __( 'Margin', 'em-output' ),
      'type' => Controls_Manager::DIMENSIONS,
              'size_units' => [ 'px', '%', 'em', 'rem' ],
              'default' => [
                  'top' => '0',
                  'right' => '0',
                  'bottom' => '.75',
                  'left' => '0',
                  'unit' => 'rem',
              ],
      'selectors' => [
        '{{WRAPPER}} .em-output h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
      ],
    ]
      );


    $this->end_controls_section();
  

  $this->start_controls_section(
    'style',
    [
        'label' => __( 'Text', 'em-output' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
  );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
          'name' => 'em-output-text',
          'selector' => '{{WRAPPER}} .em-output',
          'separator'		=> 'after'
      ]
  );
  


    $this->end_controls_section();
  }

    //
    // RENDER
    //

    protected function render() {
        
        $settings = $this->get_settings_for_display();
        $plugin_dir = ABSPATH . 'wp-content/plugins/elementor-addon/';

        // promotion

        echo '<div class="columns em-output -promotion">
                <div class="column pro" id="em-output-pro"></div>
                <div class="column discount" id="em-output-discount"></div>
              </div>';

        // user
        echo '<div class="columns em-output -info">
                <div class="column" >
                  <div class="heading">
                    <img src="' . plugin_dir_url( __DIR__ ) . 'includes/image/user.png">
                    <h3>ข้อมูลลงทะเบียน</h3>  
                  </div>
                  <ul>
                    <li id="em-output-name"></li>
                    <li id="em-output-phone"></li>
                  </ul>
                </div>
              </div>';

        // share button
        echo '<div class="columns em-output -share">
                  <div class="column">
                    <div class="heading">
                      <img src="' . plugin_dir_url( __DIR__ ) . 'includes/image/share.png">
                      <h3>แชร์โปรนี้ให้เพื่อน</h3>  
                    </div>
                    <ul>
                      <li>
                        <a class="share-facebook" id="share-facebook" href="#" onclick="window.open(this.href, "facebook-share","width=500,height=300");return false;">แชร์ใน facebook</a>
                      </li>
                      <li>
                        <a class="share-line" id="share-line" href="#" onclick="window.open(this.href, "line-share","width=500,height=300");return false;">แชร์ใน Line</a>
                      </li>
                    </ul>
                  </div>
              </div>';
    } 

}