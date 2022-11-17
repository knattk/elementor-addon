<?php

namespace ELMTA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class VideoReceiver extends Widget_Base{

    public function get_name(){
        return 'video-receiver';
    }

    public function get_title(){
        return 'Video Receiver';
    }

    public function get_icon(){
        return 'eicon-video-camera';
    }

    public function get_style_depends() {
        return ['elmta-video-css'];
    }

    public function get_script_depends() {
        return ['elmta-video-receiver-js'];
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
                'label' => __( 'Fallback Content', 'video-sender' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    
    
        $this->add_control(
            'content_role',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Type', 'video-sender' ),
                'options' => [
                    'render' => esc_html__( 'Render only', 'video-sender' ),
                    'receiver' => esc_html__( 'Receiver and render', 'video-sender' ),
                ],
                'default' => 'receiver',
            ]
        );
    /* Repeater Setup */    
    $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'content_type',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Role', 'video-sender' ),
                'options' => [
                    'video' => esc_html__( 'video', 'video-sender' ),
                    'image' => esc_html__( 'image', 'video-sender' ),
                ],
                'default' => 'video',
            ]
        );
        
        $repeater->add_control(
                'video_src',
                [
                    'label' => __( 'Video', 'video-sender' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'media_types' => ['video'],
                    'condition' => [
                        'content_type' => 'video',
                    ],
                ]
        );

        $repeater->add_control(
            'video_poster',
            [
                'label' => __( 'Poster', 'video-sender' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'content_type' => 'video',
                ],
            ]
        );
        $repeater->add_control(
            'content_image',
            [
                'label' => __( 'Image', 'video-sender' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'content_type' => 'image',
                ],
            ]
        );

    /* Add Repeater */
    $this->add_control(
            'video_list',
            [
                'label' => __( 'Videos', 'video-sender' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __( '', 'video-sender' ),
                        'list_content' => __( '', 'video-sender' ),
                    ]
                ]
            ]
    );

    $this->add_control(
        'redirect_url', 
        [
            'label' => __( 'Redirect link', 'video-sender' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#',
        ]
    );
    $this->add_control(
        'redirect_class', 
        [
            'label' => __( 'Class', 'video-sender' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'redirect-start',
        ]
    );
    $this->add_control(
        'redirect_description',
        [
            'label' => __( 'Warning text', 'video-sender' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'language' => 'html',
            'rows' => 3,
            'default' => 'กำลังเปลี่ยนหน้า',
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

        if ( $settings['video_list'] ) {

            echo "
            
                 <div id='video-container'>
                    <!-- videoSwiper -->
                    <div class='swiper videoSwiper'>
                            <div class='swiper-wrapper' id='swiper-video'>
                            </div>
                    </div>
                    <!-- Swiper pagination -->
                    <div class='swiper-pagination'></div>
                </div>
                
                <!-- Unmute button -->
                <a class='audiocontrol muted'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512' wifth='32px' height='32px'><path d='M301.1 34.8C312.6 40 320 51.4 320 64V448c0 12.6-7.4 24-18.9 29.2s-25 3.1-34.4-5.3L131.8 352H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h67.8L266.7 40.1c9.4-8.4 22.9-10.4 34.4-5.3zM425 167l55 55 55-55c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-55 55 55 55c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-55-55-55 55c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l55-55-55-55c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0z'></path></svg>
                </a>

                <!-- Arrow -->
                <img src='https://www.minus20thailand.com/wp-content/uploads/2022/11/arrow-down.png' id='circleText'>

                <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css'>
                <script src='https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js'></script>

                    <script>
                        var localStorageGenerator = () => {
                            var contentFallbackObj = {
                                                        role:'" . $settings['content_role'] . "',
                                                        content: [";
                                        
                                                        $vid_id = 1;
                                                        foreach (  $settings['video_list'] as $video ) {

                                                            $type = $video['content_type'];

                                                                if ($type == "video"){
                                                                    echo "
                                                                    {   
                                                                        id: 'video-" . $vid_id ."',
                                                                        type: '" . strval($video['content_type']) . "',
                                                                        src: '" . esc_url( $video['video_src']['url']) ."',
                                                                        poster: '" . esc_url( $video['video_poster']['url'] ) ."'
                                                                    },
                                                            
                                                                    ";
                                                                } elseif ($type == "image") {
                                                                    echo "
                                                                    {   
                                                                        id: 'video-" . $vid_id ."',
                                                                        type: '" . strval($video['content_type']) . "',
                                                                        src: '" . esc_url( $video['content_image']['url']) ."',
                                                                        
                                                                    },
                                                            
                                                                    ";
                                                                }

                                                            $vid_id = ($vid_id + 1);
                                                        }

                                                        echo "],

                                                        target: {   
                                                                    description: '" . $settings['redirect_description'] ."',
                                                                    class:'" . $settings['redirect_class'] . "',
                                                                    url:'" . $settings['redirect_url'] . "',
                                                                }
                                                    }    
                
                            if (window.localStorage.getItem('contentFallbackObj')){
                                localStorage.removeItem('contentFallbackObj');
                            }

                            window.localStorage.setItem('contentFallbackObj', JSON.stringify(contentFallbackObj));
                        }

                        window.addEventListener('DOMContentLoaded', (e) => {
                            try {
                                localStorageGenerator();
                            } catch (error) {
                                console.log(error);
                            }
                        })
                    </script>";
            
        }

        
    } 
}