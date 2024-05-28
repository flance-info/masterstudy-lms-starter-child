<?php get_header(); ?>

    <?php if(get_post_type() == 'stm_courses'): ?>
        <div id="wrapper" class="wrapper">
            <div class="container">
                <?php get_template_part( 'templates/' . get_post_type() . '/index' ); ?>
            </div>
        </div>
    <?php else: ?>
        <div id="wrapper" class="wrapper">
            <div class="container">
                <div class="starter-row">
                    <div class="stm-col-xl-9">
                        <?php get_template_part( 'templates/' . get_post_type() . '/index' ); ?>
                    </div>
                    <div class="stm-col-xl-3">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php
get_footer();
