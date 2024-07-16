<?php
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Accordion_Pro_Widget extends Widget_Base {

    public function get_name() {
        return 'accordion_pro';
    }

    public function get_title() {
        return __( 'Accordion Pro', 'accordion-pro' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        $repeater = new Repeater();

        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'accordion-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Accordion Title' , 'accordion-pro' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content', [
                'label' => __( 'Content', 'accordion-pro' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Accordion Content' , 'accordion-pro' ),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'accordion-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-title-{{ID}}' => 'color: {{VALUE}};',
                ],
                'render_type' => 'template',
            ]
        );

        $repeater->add_control(
            'title_bg_color',
            [
                'label' => __( 'Title Background Color', 'accordion-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-title-{{ID}}' => 'background-color: {{VALUE}};',
                ],
                'render_type' => 'template',
            ]
        );

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'accordion-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'accordion_items',
            [
                'label' => __( 'Accordion Items', 'accordion-pro' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Accordion Title #1', 'accordion-pro' ),
                        'content' => __( 'Accordion Content #1', 'accordion-pro' ),
                    ],
                    [
                        'title' => __( 'Accordion Title #2', 'accordion-pro' ),
                        'content' => __( 'Accordion Content #2', 'accordion-pro' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Start Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Accordion Style', 'accordion-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'global_title_color',
            [
                'label' => __( 'Global Title Color', 'accordion-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'global_title_bg_color',
            [
                'label' => __( 'Global Title Background Color', 'accordion-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-title' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'global_content_color',
            [
                'label' => __( 'Global Content Color', 'accordion-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'global_content_bg_color',
            [
                'label' => __( 'Global Content Background Color', 'accordion-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'global_padding',
            [
                'label' => __( 'Global Padding', 'accordion-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
                'render_type' => 'template',
            ]
        );

        $this->add_responsive_control(
            'global_margin',
            [
                'label' => __( 'Global Margin', 'accordion-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'render_type' => 'template',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( ! empty( $settings['accordion_items'] ) ) {
            echo '<div class="accordion-pro">';
            foreach ( $settings['accordion_items'] as $index => $item ) {
                $title_id = 'accordion-title-' . $index;
                echo '<div class="accordion-item">';
                echo '<div class="accordion-title ' . esc_attr( $title_id ) . '" style="background-color: ' . esc_attr( $item['title_bg_color'] ) . '; color: ' . esc_attr( $item['title_color'] ) . '; padding: ' . esc_attr( $settings['global_padding']['top'] . $settings['global_padding']['unit'] ) . ' ' . esc_attr( $settings['global_padding']['right'] . $settings['global_padding']['unit'] ) . ' ' . esc_attr( $settings['global_padding']['bottom'] . $settings['global_padding']['unit'] ) . ' ' . esc_attr( $settings['global_padding']['left'] . $settings['global_padding']['unit'] ) . ';">' . esc_html( $item['title'] ) . '</div>';
                echo '<div class="accordion-content" style="padding: ' . esc_attr( $settings['global_padding']['top'] . $settings['global_padding']['unit'] ) . ' ' . esc_attr( $settings['global_padding']['right'] . $settings['global_padding']['unit'] ) . ' ' . esc_attr( $settings['global_padding']['bottom'] . $settings['global_padding']['unit'] ) . ' ' . esc_attr( $settings['global_padding']['left'] . $settings['global_padding']['unit'] ) . ';">' . $item['content'] . '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
}
