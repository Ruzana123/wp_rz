<?php 
if ( ! function_exists( 'rz_sorting_products' ) ) {
    function rz_sorting_products(){
        ?>
        <?php $terms =  array(
            'taxonomy' => 'product_cat',
            'orderby'      => 'name'
        ) ;
        $all_categories = get_categories( $terms );
        ?>
        <div class="isotope" style="text-align:center;">
            <h4>Sort products by category of this page:</h4>
            <ul id="filter" class="clearfix">
                <li style="display:inline-block;"><a href="" class="current btn" data-filter="*"><?php echo __('Default sorting','rz_theme') ?></a></li>
                <?php foreach ($all_categories as $cat) { ?>
                    <li style="display:inline-block;"><a href="" class="btn" data-filter=".product-cat-<?php echo mb_strtolower($cat->name); ?>"><?php echo $cat->name ?></a></li>
                <?php } ?>
            </ul>
        </div>

        <?php
    }
    add_action( 'woocommerce_before_main_content', 'rz_sorting_products' );
}



function alpha_get_options($arg1){
    global $rz_redux_demo;
    return $rz_redux_demo[$arg1];
}
 ?>