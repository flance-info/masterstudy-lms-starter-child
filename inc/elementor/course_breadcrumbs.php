<?php
namespace STM_CATALOG\Elementor;

use Elementor\Widget_Base;

class Course_Breadcrumbs extends Widget_Base {

    public function get_name() {
        // `theme` prefix is to avoid conflicts with a dynamic-tag with same name.
        return 'stm-course-breadcrumbs';
    }

    public function get_title() {
        return esc_html__( 'Course Breadcrumbs', 'lms-starter-theme' );
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
                'label' => __('Content', 'lms-starter-theme'),
            )
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        get_template_part( 'partials/course', 'breadcrumbs', $settings );
    }
}