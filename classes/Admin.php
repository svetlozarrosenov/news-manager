<?php
namespace News_Manager_Package;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

class Admin {
    public function __construct() {
        add_action( 'after_setup_theme', function(){            
            $this->create_post_types();        
            $this->add_options_page();
            $this->remove_theme_help();
        } );
    }

    /**
     * Create admin options page
     */
    public function add_options_page() {
        Container::make( 'theme_options', __( 'News Manager', 'crb' ) )
        ->set_page_file( 'crb-news-options.php' )
        ->add_fields( array(
            Field::make( 'html', 'crb_news_manager_shortcode', __( 'Shortcode', 'crb' ) )
                ->set_html( '<p>You can use the <strong>[news]
                    </strong>shortcode for listing your available news.</p>
                    <p>You can use <strong>posts_per_page</strong> attribute and <strong>sort</strong> attribute.</p>
                    <p>The <strong>sort</strong> attribute except only <strong>asc</strong> and <strong>desc</strong> values.</p> 
                    <p>Example: <strong>[news posts_per_page=3 sort="desc"]</strong></p>' )
        ) );
    }

    /**
     * Create news post type
     */
    public function create_post_types() {
        register_post_type( 'crb_news', array(
            'labels' => array(
                'name' => __( 'News', 'crb' ),
                'singular_name' => __( 'News', 'crb' ),
                'add_new' => __( 'Add New', 'crb' ),
                'add_new_item' => __( 'Add new News', 'crb' ),
                'view_item' => __( 'View News', 'crb' ),
                'edit_item' => __( 'Edit News', 'crb' ),
                'new_item' => __( 'New News', 'crb' ),
                'view_item' => __( 'View News', 'crb' ),
                'search_items' => __( 'Search News', 'crb' ),
                'not_found' =>  __( 'No news found', 'crb' ),
                'not_found_in_trash' => __( 'No news found in trash', 'crb' ),
            ),
            'public' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            '_edit_link' => 'post.php?post=%d',
            'rewrite' => array(
                'slug' => 'news',
                'with_front' => false,
            ),
            'query_var' => true,
            'menu_icon' => 'dashicons-admin-site-alt3',
            'supports' => array( 'title', 'editor', 'page-attributes', 'thumbnail' ),
        ) );
    }

    /**
     * CarbonFields library automatically create theme help page.
     * We don't need it currently so this function remove the action.
     */
    public function remove_theme_help() {
        remove_action( 'admin_menu', 'crb_add_theme_readme', 11 );
    }
}
