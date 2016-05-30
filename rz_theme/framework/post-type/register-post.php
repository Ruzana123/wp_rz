<?php 

// Register Post Type - Review
if ( ! function_exists( 'rz_theme_post_review' ) ){
    function rz_theme_post_review() {
        $labels = array(
            'name'                  => _x( 'Review', 'Post Type General Name', 'rz_theme' ),
            'singular_name'         => _x( 'Review', 'Post Type Singular Name', 'rz_theme' ),
            'menu_name'             => __( 'Review', 'rz_theme' ),
            'name_admin_bar'        => __( 'Post Type Review', 'rz_theme' ),
            'archives'              => __( 'Item Archives', 'rz_theme' ),
            'parent_item_colon'     => __( 'Parent Item:', 'rz_theme' ),
            'all_items'             => __( 'All Items', 'rz_theme' ),
            'add_new_item'          => __( 'Add New Item', 'rz_theme' ),
            'add_new'               => __( 'Add New', 'rz_theme' ),
            'new_item'              => __( 'New Item', 'rz_theme' ),
            'edit_item'             => __( 'Edit Item', 'rz_theme' ),
            'update_item'           => __( 'Update Item', 'rz_theme' ),
            'view_item'             => __( 'View Item', 'rz_theme' ),
            'search_items'          => __( 'Search Item', 'rz_theme' ),
            'not_found'             => __( 'Not found', 'rz_theme' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'rz_theme' ),
            'featured_image'        => __( 'Featured Image', 'rz_theme' ),
            'set_featured_image'    => __( 'Set featured image', 'rz_theme' ),
            'remove_featured_image' => __( 'Remove featured image', 'rz_theme' ),
            'use_featured_image'    => __( 'Use as featured image', 'rz_theme' ),
            'insert_into_item'      => __( 'Insert into item', 'rz_theme' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'rz_theme' ),
            'items_list'            => __( 'Items list', 'rz_theme' ),
            'items_list_navigation' => __( 'Items list navigation', 'rz_theme' ),
            'filter_items_list'     => __( 'Filter items list', 'rz_theme' ),
        );
        $args = array(
            'label'                 => __( 'Review', 'rz_theme' ),
            'description'           => __( 'Review Type Description', 'rz_theme' ),
            'labels'                => $labels,
            'supports'              => array( ),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,        
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'Review', $args );
    }
    add_action( 'init', 'rz_theme_post_review', 0 );
}

 ?>