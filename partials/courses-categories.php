<?php
/* Get Categories */
$args       = array(
    'taxonomy'   => 'stm_category',
    'count'      => true,
    'number'     => 100,
    'hide_empty' => false,
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

                <?php
                    /* Get Sub Categories */
                    $args_sub       = array(
                        'taxonomy'   => 'stm_category',
                        'count'      => true,
                        'number'     => 100,
                        'hide_empty' => false,
                        'parent'     => $category->term_id,
                        'update_term_meta_cache' => false
                    );
                    $sub_categories = get_terms( $args_sub );
                ?>
                <?php if(count($sub_categories)) : ?>
                    <span class="stm-toggle-collapse">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                             fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                          <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </span>
                    <ul class="stm-courses-subcategories-list" style="display: none;">
                        <?php foreach ($sub_categories as $subcategory) : ?>
                            <li<?php if(in_array($subcategory->term_id, $course_categories)): ?> class="active"<?php endif; ?>>
                                <a href="<?php echo get_term_link( $subcategory->term_id, $subcategory->taxonomy ); ?>"><?php echo $subcategory->name; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php
endif;
?>

<script type="text/javascript">
    (function ($){
        $('.stm-toggle-collapse').on('click', function (){
           $(this).toggleClass('open');
           $(this).next('.stm-courses-subcategories-list').toggle();
        });
    })(jQuery);
</script>