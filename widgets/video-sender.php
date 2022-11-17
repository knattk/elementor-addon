<?php

namespace ELMTA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class VideoSender extends Widget_Base{

    public function get_name(){
        return 'video-sender';
    }

    public function get_title(){
        return 'Video Sender';
    }

    public function get_icon(){
        return 'eicon-video-camera';
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
                    'label' => __( 'Videos', 'video-sender' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
        
        
        
        /* Repeater Setup */    
        $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'content_type',
                [
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label' => esc_html__( 'Type', 'video-sender' ),
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
                'default' => 'tel:1577',
            ]
        );
        $this->add_control(
            'redirect_class', 
            [
                'label' => __( 'Class', 'video-sender' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'redirect-call',
            ]
        );
        $this->add_control(
            'redirect_description',
            [
                'label' => __( 'Warning text', 'video-sender' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'language' => 'html',
                'rows' => 3,
                'default' => 'กำลังเข้าสู่หน้าโทรออก',
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

            echo "<div class='product-wrapper'>
            
                    <script>
                        var localStorageGenerator = () => {
                            var contentPackageObj= {
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
                
                            if (window.localStorage.getItem('contentPackageObj')){
                                localStorage.removeItem('contentPackageObj');
                            }

                            window.localStorage.setItem('contentPackageObj', JSON.stringify(contentPackageObj));
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