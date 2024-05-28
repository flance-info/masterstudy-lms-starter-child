<?php
namespace STM_CATALOG\Elementor;

use Elementor\Widget_Base;

class Courses_Categories extends Widget_Base {

    public function get_name() {
        return 'stm-courses-categories';
    }

    public function get_title() {
        return esc_html__( 'Courses Categories', 'lms-starter-theme' );
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

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        get_template_part( 'partials/courses', 'categories', $settings );
    }
}