<?php 

/*Filter Isotope on shop page / Sorting products*/
if ( ! function_exists( 'rz_theme_sorting_products' ) ) {
    function rz_theme_sorting_products(){
        $terms =  array(
            'taxonomy' => 'product_cat',
            'orderby'      => 'name'
        ) ;
        $all_categories = get_categories( $terms );
        
        if (is_shop()) {
          ?>
            <div class="isotope" style="text-align:center;">
                <ul id="filter" class="clearfix">
                    <li style="display:inline-block;"><a href="" class="current btn" data-filter="*"><?php echo __('Default sorting','rz_theme') ?></a></li>
                    <?php foreach ($all_categories as $cat) { ?>
                        <li style="display:inline-block;"><a href="" class="btn" data-filter=".product-cat-<?php echo mb_strtolower($cat->name); ?>"><?php echo $cat->name ?></a></li>
                    <?php } ?>
                </ul>
            </div><?php
        }
    }
    add_action( 'woocommerce_before_main_content', 'rz_theme_sorting_products' );
}


 ?>