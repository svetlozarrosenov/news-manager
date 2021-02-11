<?php
/**
 * Plugin Name: News Manager
 * Description: Managing News
 * Version: 1.0.0
 * Author: ssimeonov
 *
 * @package News Manager
 **/

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

use News_Manager_Package\Admin;
use News_Manager_Package\News;
use News_Manager_Package\Loader;

define( 'NEWS_MANAGER_VERSION', '1.0.0' );

define( 'NEWS_MANAGER_URL', plugin_dir_url( __FILE__ ) );
define( 'NEWS_MANAGER_PATH', plugin_dir_path( __FILE__ ) );

class News_Manager {
    public function __construct() {
        require 'vendor/autoload.php';

        add_action( 'after_setup_theme', function() {
                \Carbon_Fields\Carbon_Fields::boot();
            }, 10 
        );

        Loader::load_assets();

        new Admin();

        new News();
    }

    public function activate() {}

    public function deactivate() {}
}

$news_manager = new News_Manager();

register_activation_hook( __FILE__, [ $news_manager, 'activate' ] );

register_deactivation_hook( __FILE__, [ $news_manager, 'deactivate' ] );
