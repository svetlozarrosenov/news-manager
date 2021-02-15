<?php
namespace News_Manager_Package;

class News {
	public function __construct() {
		$this->load_news_single_template();

		add_action( 'after_setup_theme', function(){
			$this->create_shortcode();
			$this->excerpt_length(30);
        } );
	}

	/**
     * Get single template for the news post type from the plugin directory.
     */
	public function load_news_single_template() {
		add_filter('template_include', function ( $template ) {
		    $post_types = array('crb_news');

		    if (is_singular($post_types)) {
		        $template = Loader::render('news-single', [], 'templates');
		    }

		    return $template;
		} );
	}

	/**
     * Create news listing shortcode
     */
	public function create_shortcode() {
		add_shortcode( 'news', function( $atts, $content ) {
			$posts_per_page = ( ! empty( $atts['posts_per_page'] ) && is_numeric( $atts['posts_per_page'] ) ) ? $atts['posts_per_page'] : 3;

			$sort_options = [ 'asc', 'desc' ];

			$sort = ( ! empty( $atts['sort'] ) && in_array( $atts['sort'], $sort_options ) ) ? $atts['sort'] : 'asc';


			ob_start();
			Loader::render('news', [
				'news' => [
					'posts_per_page' => $posts_per_page,
					'sort' => $sort,
				]
			] );

			return ob_get_clean();
		} );
	}

	/**
	 * Change the excerpt length.
	 * @param  integer $news_length number of words to return.
	 */
	public function excerpt_length( $news_length ) {
		add_filter( 'excerpt_length', function( $length ) use ( $news_length ) {
			global $post;
    		if ( $post->post_type == 'crb_news' ) {
    			$length = $news_length;	
    		}

			return $length;
		}, 999 );
	}
}