<?php

namespace ELMTA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class ScrollToRedirect extends Widget_Base{

  public function get_name(){
    return 'scroll-to-redirect';
  }

  public function get_title(){
    return 'Scroll to redirect';
  }

  public function get_icon(){
    return 'eicon-accordion';
  }

  public function get_style_depends() {
    return ['elmta-style-css'];
  }
  public function get_script_depends() {
    return ['elmta-scroll-to-redirect-js'];
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
				'label' => __( 'Products', 'scroll-to-redirect' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			  'image-switch',
          [
            'label' => __( 'Show logo', 'scroll-to-redirect' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
                    'return_value' => 'true',
                    'default'   => 'true',
                    'show_label' => true,
          ]
        );
        
        $this->add_control(
          'close-switch',
            [
              'label' => __( 'Close Icon', 'scroll-to-redirect' ),
              'type' => \Elementor\Controls_Manager::SWITCHER,
                      'return_value' => 'true',
                      'default'   => 'true',
                      'show_label' => true,
            ]
          );

          $this->add_control(
            'type-switch',
              [
                'label' => __( 'Popup?', 'scroll-to-redirect' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                        'return_value' => 'true',
                        'default'   => 'true',
                        'show_label' => true,
              ]
            );

            $this->add_control(
              'redirect-popup-scroll-percent',
              [
                'label' => esc_html__( 'Scroll %', 'scroll-to-redirect' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 90,
                'condition' => [
                  'type-switch' => 'true',
                ],
              ]
            );

    $this->add_control(
      'redirect-url', 
      [
        'label' => esc_html__( 'Redirect URL', 'scroll-to-redirect' ),
        'type' => \Elementor\Controls_Manager::URL,
        'options' => [ 'url', 'is_external'],
        'default' => [
          'url' => 'https://line.me',
          'is_external' => true,
        ],
        'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
      ]
    );
    $this->add_control(
      'button-url', 
      [
        'label' => esc_html__( 'Button URL', 'scroll-to-redirect' ),
        'type' => \Elementor\Controls_Manager::URL,
        'options' => [ 'url', 'is_external'],
        'default' => [
          'url' => 'https://line.me',
          'is_external' => true,
        ],
        'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
      ]
    );
    $this->add_control(
      'redirect-icon',
      [
				'label' => esc_html__( 'Icon', 'scroll-to-redirect' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle-notch',
					'library' => 'fa-solid',
				]
			]
    );
    $this->add_control(
			'redirect-class',
			[
				'label' => esc_html__( 'Custom Class', 'scroll-to-redirect' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'redirect-line', 'scroll-to-redirect' ),
				'placeholder' => esc_html__( 'Custom CSS Class', 'scroll-to-redirect' ),
			]
		);

    $this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'scroll-to-redirect' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'เข้าสู่หน้าเพิ่มเพื่อน LINE เพื่อรับโปรโมชั่นพิเศษ', 'scroll-to-redirect' ),
			]
		);

    $this->add_control(
			'button-text',
			[
				'label' => esc_html__( 'Button', 'scroll-to-redirect' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'กดรับโปรโมชั่น', 'scroll-to-redirect' ),
			]
		);

    $this->end_controls_section();

    /*
    *
    *
    * STYLE
    *
    *
    */
    $this->start_controls_section(
      'style_card_tab',
      [
          'label' => __( 'Redirect', 'scroll-to-redirect' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );
     
      
      $this->add_control(
          'style_card_background',
          [
              'label' 		=> __( 'Background', 'scroll-to-redirect' ),
              'type' 			=> Controls_Manager::COLOR,
              'default' => '#ffffff',
              'selectors'		=> [
                  '{{WRAPPER}} .scroll-to-redirect' => 'background-color: {{VALUE}};'
              ]
          ]
      );  
      $this->add_control(
        'color-icon',
        [
            'label' 		=> __( 'Icon', 'scroll-to-redirect' ),
            'type' 			=> Controls_Manager::COLOR,
            'default' => '#3bce04',
            'selectors'		=> [
                '{{WRAPPER}} i' => 'color: {{VALUE}};'
            ]
        ]
    ); 
      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
          'name' => 'description_typography',
          'selector' => '{{WRAPPER}} :is(p,span)',
          'global' => [
            'default' => Global_Typography::TYPOGRAPHY_TEXT,
          ],
        ]
      );
      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
          'name' => 'button_typography',
          'selector' => '{{WRAPPER}} a',
          'global' => [
            'default' => Global_Typography::TYPOGRAPHY_TEXT,
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
  
      // Main wrapper classes
      $classes = ['scroll-to-redirect', 'redirect-start'];
  
      if (!empty($settings['redirect-class'])) {
          $classes[] = sanitize_html_class($settings['redirect-class']);
      }
  
      if (!empty($settings['type-switch'])) {
          $classes[] = 'auto-redirect-popup';
      }
  
      // Redirect target and scroll percent
      $redirect_url = !empty($settings['redirect-url']['url']) ? esc_url($settings['redirect-url']['url']) : '#';
      $button_url = !empty($settings['button-url']['url']) ? esc_url($settings['button-url']['url']) : '#';
      $scroll_percent = isset($settings['redirect-popup-scroll-percent']) ? max(0, min(100, floatval($settings['redirect-popup-scroll-percent']))) : 0;
      $button_text = !empty($settings['button-text']) ? sanitize_text_field($settings['button-text']) : __('กดรับโปรโมชั่น', 'scroll-to-redirect');
      $widget_mode = !empty($settings['type-switch']) ? 'popup' : 'inline';
  
      // Build final class string
      $class_attr = implode(' ', $classes);
      ?>
  
      <div class="<?php echo esc_attr($class_attr); ?>" data-to="<?php echo esc_url($redirect_url); ?>" data-percent="<?php echo esc_attr($scroll_percent); ?>" data-mode="<?php echo esc_attr($widget_mode); ?>">
  
          <?php if (!empty($settings['image-switch']) && $settings['image-switch'] === 'true') : ?>
              <img 
                  src="<?php echo esc_url(plugin_dir_url(__DIR__) . 'includes/image/line-logo-new.png'); ?>" 
                    alt="<?php esc_attr_e('Line Logo', 'scroll-to-redirect'); ?>" 
                  class="line-logo" 
              />
          <?php endif; ?>
          
          <h4 class="redirect-heading">เพิ่มเพื่อนรับโปร</h4>
          <?php if (!empty($settings['description'])) : ?>
              <p class="description"><?php echo wp_kses_post($settings['description']); ?></p>
          <?php endif; ?>
  
          <?php if (!empty($settings['redirect-icon'])) : ?>
              <!-- <div class="icon">
                  <?php \Elementor\Icons_Manager::render_icon($settings['redirect-icon'], ['aria-hidden' => 'true']); ?>
              </div> -->
              <span class="loader"></span>
          <?php endif; ?>
  
          <div class="redirect-footer">
              <a class="button button-line button-redirect" href="<?php echo $button_url ?: $redirect_url; ?>">
                <?php echo esc_html($button_text); ?>
              </a>
  
              <?php if (!empty($settings['close-switch']) && $settings['close-switch'] === 'true') : ?>
                <button class="button button-cancel" aria-label="<?php esc_attr_e('ปิดปุ่ม', 'scroll-to-redirect'); ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" role="img" aria-hidden="true">
                          <rect width="256" height="256" fill="none" />
                          <line x1="200" y1="56" x2="56" y2="200" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                          <line x1="200" y1="200" x2="56" y2="56" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                      </svg>
                  <?php esc_html_e('ยกเลิก', 'scroll-to-redirect'); ?> <span class="cancel-countdown"></span>
                  </button>
              <?php endif; ?>
          </div>
  
      </div>
  
      <?php
  }
  
  

}