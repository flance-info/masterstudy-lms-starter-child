<?php
    /**
     * @var $args
     */


?>

<?php if( have_rows('course_options_list') ): ?>
    <div class="stm-course-info">
        <ul class="stm-course-info-list">
            <?php while( have_rows('course_options_list') ): ?>
                <?php the_row(); ?>
                <?php
                    $label = get_sub_field('label');
                    $value = get_sub_field('value');
                ?>
                <li>
                    <div class="bar">
                        <span class="filled-bar"></span>
                    </div>
                    <h4><?php echo get_sub_field('label'); ?>:</h4>
                    <p><?php echo get_sub_field('value'); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>