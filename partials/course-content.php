<div class="stm-course-content">
    <?php
        $is_elementor = (isset($_GET['action']) && $_GET['action'] == 'elementor') ? true : false;
        if(is_singular() && !$is_elementor) {
            global $post;
            echo wpautop($post->post_content);
        } else {
            _e('Course Content', 'lms-starter-theme');
        }
    ?>
</div>
