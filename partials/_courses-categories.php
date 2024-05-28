<?php
/* Get Categories */
$args       = array(
    'taxonomy'   => 'stm_category',
    'count'      => true,
    'number'     => 100,
    'hide_empty' => 1,
    'parent'     => 0,
    'update_term_meta_cache' => false
);
$categories = get_terms( $args );

$course_categories = wp_get_post_terms( get_the_ID(), 'stm_category', array('fields' => 'ids') );

if(count($categories)) : ?>
    <ul class="stm-courses-categories-list">
        <?php foreach ($categories as $category) : ?>
            <li<?php if(in_array($category->term_id, $course_categories)): ?> class="active"<?php endif; ?>>
                <a href="<?php echo get_term_link( $category->term_id, $category->taxonomy ); ?>"><?php echo $category->name; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php
endif;