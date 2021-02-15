<?php
namespace News_Manager_Package;

class Loader {
	/**
     * Load file
     */
	public static function render( $view, $context = [], $folder='fragments' ) {
		extract( $context );

		require NEWS_MANAGER_PATH . $folder . DIRECTORY_SEPARATOR . $view . '.php';
	}

	/**
     * Load the css and the js
     */
	public static function load_assets() {
		add_action( 'wp_enqueue_scripts', function() {
			$dist = json_decode( file_get_contents( NEWS_MANAGER_PATH . 'dist/manifest.json' ), true );


			\crb_enqueue_style( 'news-styles', NEWS_MANAGER_URL . '/dist/' . $dist['css/bundle.css'] );

			\crb_enqueue_script( 'news-js', NEWS_MANAGER_URL . '/dist/' . $dist['js/bundle.js'], ['jquery'], true );
		} );
	}
}