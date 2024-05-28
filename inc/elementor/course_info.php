<?php
namespace STM_CATALOG\Elementor;

use Elementor\Widget_Base;

class Course_Info extends Widget_Base {

    public function get_name() {
        return 'stm-course-info';
    }

    public function get_title() {
        return esc_html__( 'Course Info', 'lms-starter-theme' );
    }

    public function get_icon() {
        return 'eicon-settings';
    }

    public function get_script_depends(): array
    {
        return array( 'elementor-courses-widget' );
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __( 'Content', 'lms-starter-theme' ),
            )
        );

        $this->add_control(
            'show_program_type',
            array(
                'label'       => __( 'Show Program Type', 'lms-starter-theme' ),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
            )
        );

        $this->add_control(
            'show_format',
            array(
                'label'       => __( 'Show Format', 'lms-starter-theme' ),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
            )
        );

        $this->add_control(
            'show_level',
            array(
                'label'       => __( 'Show Level', 'lms-starter-theme' ),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
            )
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        get_template_part( 'partials/course', 'info', $settings );
    }
}