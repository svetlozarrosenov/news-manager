<?php
namespace News_Manager_Package;

class Loader {
	public static function render( $view, $context = [], $folder='fragments' ) {
		extract( $context );

		require NEWS_MANAGER_PATH . $folder . DIRECTORY_SEPARATOR . $view . '.php';
	}

	public static function load_assets() {
		add_action( 'wp_enqueue_scripts', function() {
			\crb_enqueue_style( 'news-styles', NEWS_MANAGER_URL . '/dist/css/bundle.css' );

			\crb_enqueue_script( 'news-js', NEWS_MANAGER_URL . '/dist/js/bundle.js', ['jquery'], true );
		} );
	}
}