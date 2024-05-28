<?php
$settings = array(
    'title_sidebar' => 'FILTERS',
    'title_content' => 'Result',
    'show_search_field' => 'yes',
    'per_page' => 10,
);
wp_enqueue_style('elementor-courses-widget');
get_template_part( 'partials/courses', '', $settings );