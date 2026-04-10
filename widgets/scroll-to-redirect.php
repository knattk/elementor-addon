<?php

namespace ELMTA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
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
      'style_container_tab',
      [
          'label' => __( 'Container', 'scroll-to-redirect' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

      $this->add_control(
          'style_card_background',
          [
              'label' => __( 'Background', 'scroll-to-redirect' ),
              'type' => Controls_Manager::COLOR,
              'default' => '#ffffff',
              'selectors' => [
                  '{{WRAPPER}} .scroll-to-redirect' => 'background-color: {{VALUE}};'
              ]
          ]
      );

      $this->add_control(
        'container_text_color',
        [
            'label' => __( 'Text Color', 'scroll-to-redirect' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .scroll-to-redirect' => 'color: {{VALUE}};'
            ]
        ]
      );

      $this->add_responsive_control(
        'container_padding',
        [
          'label' => __( 'Padding', 'scroll-to-redirect' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em', 'rem' ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
          ]
        ]
      );

      $this->add_responsive_control(
        'container_border_radius',
        [
          'label' => __( 'Border Radius', 'scroll-to-redirect' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em', 'rem' ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
          ]
        ]
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        [
          'name' => 'container_border',
          'selector' => '{{WRAPPER}} .scroll-to-redirect',
        ]
      );

      $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
          'name' => 'container_box_shadow',
          'selector' => '{{WRAPPER}} .scroll-to-redirect',
        ]
      );

    $this->end_controls_section();

    $this->start_controls_section(
      'style_logo_tab',
      [
          'label' => __( 'Logo', 'scroll-to-redirect' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
          'condition' => [
            'image-switch' => 'true',
          ]
      ]
    );

      $this->add_responsive_control(
        'logo_width',
        [
          'label' => __( 'Width', 'scroll-to-redirect' ),
          'type' => Controls_Manager::SLIDER,
          'size_units' => [ 'px', '%', 'vw' ],
          'range' => [
            'px' => [
              'min' => 20,
              'max' => 320,
            ],
            '%' => [
              'min' => 10,
              'max' => 100,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .line-logo' => 'width: {{SIZE}}{{UNIT}};'
          ]
        ]
      );

      $this->add_responsive_control(
        'logo_margin',
        [
          'label' => __( 'Margin', 'scroll-to-redirect' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em', 'rem' ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .line-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
          ]
        ]
      );

    $this->end_controls_section();

    $this->start_controls_section(
      'style_heading_tab',
      [
          'label' => __( 'Heading', 'scroll-to-redirect' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

      $this->add_control(
        'heading_color',
        [
            'label' => __( 'Color', 'scroll-to-redirect' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .scroll-to-redirect .redirect-heading' => 'color: {{VALUE}};'
            ]
        ]
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
          'name' => 'heading_typography',
          'selector' => '{{WRAPPER}} .scroll-to-redirect .redirect-heading',
          'global' => [
            'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
          ],
        ]
      );

      $this->add_responsive_control(
        'heading_margin',
        [
          'label' => __( 'Margin', 'scroll-to-redirect' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em', 'rem' ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .redirect-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
          ]
        ]
      );

    $this->end_controls_section();

    $this->start_controls_section(
      'style_description_tab',
      [
          'label' => __( 'Description', 'scroll-to-redirect' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

      $this->add_control(
        'description_color',
        [
            'label' => __( 'Text Color', 'scroll-to-redirect' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .scroll-to-redirect .description' => 'color: {{VALUE}};'
            ]
        ]
      );

      $this->add_control(
        'description_highlight_color',
        [
            'label' => __( 'Highlight Color', 'scroll-to-redirect' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .scroll-to-redirect .description span' => 'color: {{VALUE}};'
            ]
        ]
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
          'name' => 'description_typography',
          'selector' => '{{WRAPPER}} .scroll-to-redirect .description',
          'global' => [
            'default' => Global_Typography::TYPOGRAPHY_TEXT,
          ],
        ]
      );

      $this->add_responsive_control(
        'description_max_width',
        [
          'label' => __( 'Max Width', 'scroll-to-redirect' ),
          'type' => Controls_Manager::SLIDER,
          'size_units' => [ '%', 'px' ],
          'range' => [
            '%' => [
              'min' => 10,
              'max' => 100,
            ],
            'px' => [
              'min' => 100,
              'max' => 1000,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .description' => 'max-width: {{SIZE}}{{UNIT}};'
          ]
        ]
      );

      $this->add_responsive_control(
        'description_margin',
        [
          'label' => __( 'Margin', 'scroll-to-redirect' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em', 'rem' ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
          ]
        ]
      );

    $this->end_controls_section();

    $this->start_controls_section(
      'style_loader_tab',
      [
          'label' => __( 'Loader', 'scroll-to-redirect' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

      $this->add_control(
        'color-icon',
        [
            'label' => __( 'Primary Dot', 'scroll-to-redirect' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#bcbcbc',
            'selectors' => [
                '{{WRAPPER}} .scroll-to-redirect .loader::after' => 'background-color: {{VALUE}};'
            ]
        ]
      );

      $this->add_control(
        'loader_secondary_color',
        [
            'label' => __( 'Secondary Dot', 'scroll-to-redirect' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#cecece',
            'selectors' => [
                '{{WRAPPER}} .scroll-to-redirect .loader::before' => 'background-color: {{VALUE}};'
            ]
        ]
      );

      $this->add_responsive_control(
        'loader_size',
        [
          'label' => __( 'Size', 'scroll-to-redirect' ),
          'type' => Controls_Manager::SLIDER,
          'size_units' => [ 'px' ],
          'range' => [
            'px' => [
              'min' => 12,
              'max' => 120,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .loader' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
          ]
        ]
      );

    $this->end_controls_section();

    $this->start_controls_section(
      'style_primary_button_tab',
      [
          'label' => __( 'Primary Button', 'scroll-to-redirect' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
          'name' => 'button_typography',
          'selector' => '{{WRAPPER}} .scroll-to-redirect .button-redirect',
          'global' => [
            'default' => Global_Typography::TYPOGRAPHY_TEXT,
          ],
        ]
      );

      $this->start_controls_tabs( 'primary_button_tabs' );

        $this->start_controls_tab(
          'primary_button_normal',
          [
            'label' => __( 'Normal', 'scroll-to-redirect' ),
          ]
        );

          $this->add_control(
            'primary_button_text_color',
            [
                'label' => __( 'Text Color', 'scroll-to-redirect' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scroll-to-redirect .button-redirect' => 'color: {{VALUE}};'
                ]
            ]
          );

          $this->add_control(
            'primary_button_background',
            [
                'label' => __( 'Background', 'scroll-to-redirect' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scroll-to-redirect .button-redirect' => 'background-color: {{VALUE}};'
                ]
            ]
          );

        $this->end_controls_tab();

        $this->start_controls_tab(
          'primary_button_hover',
          [
            'label' => __( 'Hover', 'scroll-to-redirect' ),
          ]
        );

          $this->add_control(
            'primary_button_text_color_hover',
            [
                'label' => __( 'Text Color', 'scroll-to-redirect' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scroll-to-redirect .button-redirect:hover' => 'color: {{VALUE}};'
                ]
            ]
          );

          $this->add_control(
            'primary_button_background_hover',
            [
                'label' => __( 'Background', 'scroll-to-redirect' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scroll-to-redirect .button-redirect:hover' => 'background-color: {{VALUE}};'
                ]
            ]
          );

        $this->end_controls_tab();

      $this->end_controls_tabs();

      $this->add_responsive_control(
        'primary_button_padding',
        [
          'label' => __( 'Padding', 'scroll-to-redirect' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em', 'rem' ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .button-redirect' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
          ]
        ]
      );

      $this->add_responsive_control(
        'primary_button_border_radius',
        [
          'label' => __( 'Border Radius', 'scroll-to-redirect' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em', 'rem' ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .button-redirect' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
          ]
        ]
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        [
          'name' => 'primary_button_border',
          'selector' => '{{WRAPPER}} .scroll-to-redirect .button-redirect',
        ]
      );

    $this->end_controls_section();

    $this->start_controls_section(
      'style_cancel_button_tab',
      [
          'label' => __( 'Cancel Button', 'scroll-to-redirect' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
          'condition' => [
            'close-switch' => 'true',
          ]
      ]
    );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
          'name' => 'cancel_button_typography',
          'selector' => '{{WRAPPER}} .scroll-to-redirect .button-cancel',
          'global' => [
            'default' => Global_Typography::TYPOGRAPHY_TEXT,
          ],
        ]
      );

      $this->add_control(
        'cancel_button_text_color',
        [
            'label' => __( 'Text Color', 'scroll-to-redirect' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .scroll-to-redirect .button-cancel' => 'color: {{VALUE}};'
            ]
        ]
      );

      $this->add_control(
        'cancel_button_background',
        [
            'label' => __( 'Background', 'scroll-to-redirect' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .scroll-to-redirect .button-cancel' => 'background-color: {{VALUE}};'
            ]
        ]
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        [
          'name' => 'cancel_button_border',
          'selector' => '{{WRAPPER}} .scroll-to-redirect .button-cancel',
        ]
      );

      $this->add_responsive_control(
        'cancel_button_padding',
        [
          'label' => __( 'Padding', 'scroll-to-redirect' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em', 'rem' ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .button-cancel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
          ]
        ]
      );

      $this->add_responsive_control(
        'cancel_button_border_radius',
        [
          'label' => __( 'Border Radius', 'scroll-to-redirect' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em', 'rem' ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .button-cancel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
          ]
        ]
      );

      $this->add_responsive_control(
        'cancel_button_icon_size',
        [
          'label' => __( 'Icon Size', 'scroll-to-redirect' ),
          'type' => Controls_Manager::SLIDER,
          'size_units' => [ 'px' ],
          'range' => [
            'px' => [
              'min' => 8,
              'max' => 48,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .scroll-to-redirect .button-cancel svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
          ]
        ]
      );

    $this->end_controls_section();

    $this->start_controls_section(
      'style_popup_tab',
      [
          'label' => __( 'Popup Layout', 'scroll-to-redirect' ),
          'tab' => \Elementor\Controls_Manager::TAB_STYLE,
          'condition' => [
            'type-switch' => 'true',
          ]
      ]
    );

      $this->add_responsive_control(
        'popup_max_width',
        [
          'label' => __( 'Max Width', 'scroll-to-redirect' ),
          'type' => Controls_Manager::SLIDER,
          'size_units' => [ 'px', '%', 'vw' ],
          'range' => [
            'px' => [
              'min' => 240,
              'max' => 1200,
            ],
            '%' => [
              'min' => 30,
              'max' => 100,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .auto-redirect-popup' => 'max-width: {{SIZE}}{{UNIT}};'
          ]
        ]
      );

      $this->add_responsive_control(
        'popup_bottom_offset',
        [
          'label' => __( 'Bottom Offset', 'scroll-to-redirect' ),
          'type' => Controls_Manager::SLIDER,
          'size_units' => [ 'px', 'vh' ],
          'range' => [
            'px' => [
              'min' => 0,
              'max' => 200,
            ],
            'vh' => [
              'min' => 0,
              'max' => 30,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .auto-redirect-popup.show-popup' => 'bottom: {{SIZE}}{{UNIT}};'
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