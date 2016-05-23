<?php 
/**
 * functions.php        
*/

/**
 * 1.0 - Define constants.
*/

define('THEMEROOT',get_stylesheet_directory_uri());
define('IMAGES',THEMEROOT .'/images');
define('SCRIPTS',THEMEROOT .'/js');
define('FRAMEWORK',get_template_directory() .'/framework');

/**
 * 2.0 - Load the framework.
*/

require_once( FRAMEWORK . '/init.php');

/**
 * 3.0 - Set up the content width value based on the theme's design.
*/

if (! isset($content_width)) {
    $content_width = 800;
}

/**
 * 4.0 - Set up theme default and register various supported features.
*/

if (! function_exists('rz_theme_setup')) {
    function rz_theme_setup(){
        /**
         * Make the theme avaliable for translation.
         */
        $lang_dir = THEMEROOT . '/languages';
        load_theme_textdomain('rz_theme',$lang_dir);
        /**
         * Add support for post formats.
         */
        add_theme_support('post_formats ',
            array(
                'galery',
                'link',
                'image',
                'quote',
                'video',
                'audio'
            )
        );

        /**
         * Add support for automatic feed links.
         */
        
        add_theme_support('automatic-feed-links');

        /**
         * Add support for post thumbnails.
         */
        
        add_theme_support('post-thumbnails');

        /**
         * Register nav menus.
         */
        register_nav_menus(
            array(
                'main-menu' => __('Main Menu','rz_theme')
            )
        );

    }
    add_action('after_setup_theme','rz_theme_setup');
}

/**
 * 5.0 - Display meta information for a specific post.
*/

if ( ! function_exists( 'rz_theme_post_meta()' ) ){
    function rz_theme_post_meta() {
        echo '<ul class="list-inline entry-meta">';

        if( get_post_type() === 'post' ) {

            // If the post is sticky, mark it.
            if ( is_sticky() ){
                echo '<li class="meta-featured-post"><i class="fa fa-thumb-tack"></i>' . __( 'Sticky', 'rz_theme' ) . '</li>';
            }
            printf(
                '<li class="meta-author"><a href="%1$s">%2$s</a></li>',
                esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                get_the_author()
            ) ; 

            // Get the date.
            echo '<li class="meta-date">'.get_the_date().'</li>'; 

            // Get the categories.
            $category_list = get_the_category_list(', ');
            if ( $category_list ) {
                echo '<li class="meta-categories">'.$category_list.'</li>';
            }  

            // Get the tags.
            $tag_list = get_the_tag_list('', ', ');
            if ( $tag_list ) {
                echo '<li class="meta-tags">'.$tag_list.'</li>';
            }  

            // Comment link.
            if ( comments_open() ) :
                echo '<li>';
                echo '<span class="meta-reply">';
                comments_popup_link( __( 'Leave a comment', 'rz_theme' ), __( 'One comment so far', 'rz_theme' ), __( 'View all % comments', 'rz_theme' ));
                echo '</span>';
                echo '</li>';
            endif;

            // Edit link.
            if ( is_user_logged_in() ){
                echo '<li>';
                edit_post_link( __( 'Edit', 'rz_theme' ), '<span class="meta-edit">', '</span>');
                echo '</li>';
            }
        }
    }
}

/**
 * 6.0 - Display navigation to the next/previous set of posts.
*/

if ( ! function_exists( 'rz_theme_paging_nav' ) ) {
    function rz_theme_paging_nav() { ?>
        <ul>
            <?php 
                if ( get_previous_posts_link() ) : ?>
                   <li class="next">
                       <?php previous_posts_link( __( 'Newer Posts &rarr;', 'rz_theme' ) ); ?>
                   </li>
                <?php endif; ?>
            <?php 
                if ( get_next_posts_link() ) : ?>
                   <li class="previous">
                       <?php next_posts_link( __( '&rarr; Older Posts', 'rz_theme' ) ); ?>
                   </li>
                <?php endif; ?>
        </ul> <?php
    }
}

/**
 * 7.0 - Register the widget areas.
*/

if ( !function_exists( 'rz_theme_widget_init' ) ) {
    function rz_theme_widget_init() {
        if ( function_exists( 'register_sidebar' ) ) {
            register_sidebar(
                array(
                    'name' => __( 'Main widget area', 'rz_theme' ),
                    'id' => 'sidebar-1',
                    'description' => __( 'Appears on posts and pages', 'rz_theme' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => '<h5 class="widget-title">',
                    'after_title' => '</h5>'
                )
            );

            register_sidebar(
                array(
                    'name' => __( 'Footer widget area', 'rz_theme' ),
                    'id' => 'sidebar-2',
                    'description' => __( 'Appears on the footer', 'rz_theme' ),
                    'before_widget' => '<div id="%1$s" class="widget col-sm-3 %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => '<h5 class="widget-title">',
                    'after_title' => '</h5>'
                )
            );
        }
    }

    add_action( 'widgets_init', 'rz_theme_widget_init' );
}

/**
 * 8.0 - Register the widget areas.
*/

if ( ! function_exists( 'rz_theme_validate_length' ) ) {
        function rz_theme_validate_length( $field_value, $min_length ) {
            // First, remove trailing and leading whitespace.
            return ( strlen( trim( $field_value ) ) > $min_length );
        }
    }

/**
 * ----------------------------------------------------------------------------------------
 * 9.0 - Include the generated CSS in the page header.
 * ----------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'rz_theme_load_wp_head' ) ) {
    function rz_theme_load_wp_head() {
        // Get the logos
        $logo = IMAGES . '/logo.png';
        $logo_retina = IMAGES . '/logo@2x.png';

        $logo_size = getimagesize( $logo );
        ?>
        
        <!-- Logo CSS -->
        <style type="text/css">
            .site-logo a {
                background: transparent url( <?php echo $logo; ?> ) 0 0 no-repeat;
                width: <?php echo $logo_size[0] ?>px;
                height: <?php echo $logo_size[1] ?>px;
                display: inline-block;
            }

            @media only screen and (-webkit-min-device-pixel-ratio: 1.5),
            only screen and (-moz-min-device-pixel-ratio: 1.5),
            only screen and (-o-min-device-pixel-ratio: 3/2),
            only screen and (min-device-pixel-ratio: 1.5) {
                .site-logo a {
                    background: transparent url( <?php echo $logo_retina; ?> ) 0 0 no-repeat;
                    background-size: <?php echo $logo_size[0]; ?>px <?php echo $logo_size[1]; ?>px;
                }
            }
        </style>

        <?php
    }

    add_action( 'wp_head', 'rz_theme_load_wp_head' );
}

/**
 * ----------------------------------------------------------------------------------------
 * 10.0 - Load the custom scripts for the theme.
 * ----------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'rz_theme_scripts' ) ) {
    function rz_theme_scripts() {
        // Adds support for pages with threaded comments
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        // Register scripts
        wp_register_script( 'rz_carusel', SCRIPTS . '/owl.carousel.js', array( 'jquery' ), false, true );
        wp_register_script( 'rz_iq', SCRIPTS . '/jquery-1.12.3.min.js', array( 'jquery' ), false, true );
        wp_register_script( 'bootstrap-js', 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array( 'jquery' ), false, true );
        wp_register_script( 'rz_theme-custom', SCRIPTS . '/scripts.js', array( 'jquery' ), false, true );
        wp_register_script( 'rz_theme-iso', SCRIPTS . '/isotope-docs.min.js', array( 'jquery' ), false, true );

        // Load the custom scripts
        wp_enqueue_script( 'rz_carusel' );
        wp_enqueue_script( 'rz_iq' );
        wp_enqueue_script( 'bootstrap-js' ); 
        wp_enqueue_script( 'rz_theme-custom' );
        wp_enqueue_script( 'rz_theme-iso' );
        

        // Load the stylesheets
        wp_enqueue_style( 'font-awesome', THEMEROOT . '/css/font-awesome.min.css' );
        wp_enqueue_style( 'rz_theme-master', THEMEROOT . '/css/master.css' );
        wp_enqueue_style( 'rz_theme-carysel', THEMEROOT . '/css/owl.carousel.css' );
    }

    add_action( 'wp_enqueue_scripts', 'rz_theme_scripts' );
}
?>


<!-- MY -->
<?php 
if ( ! function_exists( 'rz_sorting_products' ) ) {
    function rz_sorting_products(){
        ?>
        <div class="isotope" style="text-align:center;"
            <h4>Sort products by category of this page:</h4>
            <ul id="filter" class="clearfix">
                <li style="display:inline-block;"><a href="" class="current btn" data-filter="*">Default sorting</a></li>
                <li style="display:inline-block;"><a href="" class="btn" data-filter=".product-cat-music">Music</a></li>
                <li style="display:inline-block;"><a href="" class="btn" data-filter=".product-cat-albums">Albums</a></li>
                <li style="display:inline-block;"><a href="" class="btn" data-filter=".product-cat-clothing">Clothing</a></li>
                <li style="display:inline-block;"><a href="" class="btn" data-filter=".product-cat-posters">Posters</a></li>              
            </ul>
        </div>

        <?php
    }
    add_action( 'woocommerce_before_main_content', 'rz_sorting_products' );
}
?>