<?php

namespace STM_CATALOG\Helpers;

use Elementor\Plugin;

class TemplateManager {

    private static $post_type    = 'course_template';
    private static $plural       = 'Course Templates';
    private static $single       = 'Course Template';
    private static $setting_name = 'single_course_template';

    private static $data_for_select;

    public static $selected_template_id;

    public static $templateManagerDir;

    public static function init() {

        self::stm_get_templates_list();

        self::$templateManagerDir = get_stylesheet_directory().'/inc/template_manager';

        add_action( 'init', array( self::class, 'stm_register_post_type' ) );
        add_filter( 'single_template', array( self::class, 'stm_override_single_template' ) );
    }

    public static function get_templates_list(){

        $posts = get_posts([
            'post_type'     => self::$post_type,
            'post_status'   => 'publish',
            'numberposts'   => - 1,
        ]);

        $list = array(
            0 => __( 'Default', 'masterstudy-lms-starter-child' )
        );

        if(count($posts)) {
            foreach ($posts as $post) {
                $list[$post->ID] = $post->post_title;
            }
        }

        return $list;
    }

    public static function stm_register_post_type() {

        self::$selected_template_id = (int)get_field( self::$setting_name, 'option' );
        if ( null === self::$selected_template_id ) {
            if(count(self::$data_for_select)) {
                self::$selected_template_id = self::$data_for_select[0]['post_id'];
            }
        }

        // @codingStandardsIgnoreStart
        $labels = array(
            'name'               => __( self::$plural, 'masterstudy-lms-starter-child' ),
            'singular_name'      => __( self::$single, 'masterstudy-lms-starter-child' ),
            'add_new'            => __( 'Add New', 'masterstudy-lms-starter-child' ),
            'add_new_item'       => __( 'Add New ' . self::$single, 'masterstudy-lms-starter-child' ),
            'edit_item'          => __( 'Edit ' . self::$single, 'masterstudy-lms-starter-child' ),
            'new_item'           => __( 'New ' . self::$single, 'masterstudy-lms-starter-child' ),
            'all_items'          => __( 'All ' . self::$plural, 'masterstudy-lms-starter-child' ),
            'view_item'          => __( 'View ' . self::$single, 'masterstudy-lms-starter-child' ),
            'search_items'       => __( 'Search ' . self::$plural, 'masterstudy-lms-starter-child' ),
            'not_found'          => __( 'No ' . self::$plural . ' found', 'masterstudy-lms-starter-child' ),
            'not_found_in_trash' => __( 'No ' . self::$plural . '  found in Trash', 'masterstudy-lms-starter-child' ),
            'parent_item_colon'  => '',
            'menu_name'          => __( self::$plural, 'masterstudy-lms-starter-child' ),
        );
        // @codingStandardsIgnoreEnd

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
//            'show_in_menu'       => false,
//            'show_in_nav_menus'  => false,
            'query_var'          => true,
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => null,
            'supports'           => array( 'title', 'editor' ),
        );

        register_post_type( self::$post_type, $args );
    }

    public static function stm_get_templates_list() {
        $args = array(
            'post_type'      => self::$post_type,
            'post_status'    => 'publish',
            'posts_per_page' => - 1,
        );

        $posts = new \WP_Query( $args );

        $for_select = array();

        foreach ( $posts->posts as $post ) {
            $for_select[] = array(
                'post_id'   => $post->ID,
                'slug'      => $post->post_name,
                'title'     => $post->post_title,
                'edit_link' => get_admin_url( null, 'post.php?post=' . $post->ID . '&action=elementor' ),
                'view_link' => get_the_permalink( $post->ID ),
            );
        }

        self::$data_for_select = $for_select;

        wp_reset_postdata();
    }

    public static function stm_override_single_template( $single_template ) {
        global $post;

        $file = self::$templateManagerDir . '/templates/single-' . $post->post_type . '.php';

        if ( file_exists( $file ) ) {
            $single_template = $file;
        }

        return $single_template;
    }

    public static function display_template() {
        global $post;
        $special_course_template = get_post_meta( $post->ID, 'special_course_template', true );
        $template_listing_id      = ( $special_course_template ) ? $special_course_template : self::$selected_template_id;
        $template_listing         = get_post( $template_listing_id );
        setup_postdata( $template_listing );
        //phpcs:ignore
        echo Plugin::instance()->frontend->get_builder_content_for_display( $template_listing->ID );
        wp_reset_postdata();
    }
}
