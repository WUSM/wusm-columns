<?php
/*
Plugin Name: WUSM Columns in content
Plugin URI: 
Description: Add a button that lets you break the main content into columns
Author: Aaron Graham
Version:14.05.01.0
Author URI: 
*/

add_action( 'init', 'github_plugin_updater_wusm_columns_init' );
function github_plugin_updater_wusm_columns_init() {

		if( ! class_exists( 'WP_GitHub_Updater' ) )
			include_once 'updater.php';

		if( ! defined( 'WP_GITHUB_FORCE_UPDATE' ) )
			define( 'WP_GITHUB_FORCE_UPDATE', true );

		if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin

				$config = array(
						'slug' => plugin_basename( __FILE__ ),
						'proper_folder_name' => 'wusm-columns',
						'api_url' => 'https://api.github.com/repos/coderaaron/wusm-columns',
						'raw_url' => 'https://raw.github.com/coderaaron/wusm-columns/master',
						'github_url' => 'https://github.com/coderaaron/wusm-columns',
						'zip_url' => 'https://github.com/coderaaron/wusm-columns/archive/master.zip',
						'sslverify' => true,
						'requires' => '3.0',
						'tested' => '3.8',
						'readme' => 'README.md',
						'access_token' => '',
				);

				new WP_GitHub_Updater( $config );
		}

}

class wusm_columns_plugin {
	public function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'column_shortcode_styles' ) );
	}
	
	public function admin_init() {
		//add_filter( 'style_loader_tag', array( $this, 'style_loader_tag' ), 50, 2 );
		add_filter( 'mce_external_plugins', array( $this, 'add_buttons' ) );
		add_filter( 'mce_buttons', array( $this, 'register_buttons' ) );
		add_editor_style( plugin_dir_url( __FILE__ ) . 'css/wusm-columns-admin.css'  );
	}
	
	public function style_loader_tag( $tag, $handle ) {
		if ( $handle == 'editor-buttons' ) {
			remove_filter( 'style_loader_tag', array( $this, 'style_loader_tag' ), 50, 2 );
			wp_register_style( 'mce-two-cols', plugin_dir_url( __FILE__ ) . 'css/wusm-columns-tinymce.css' );
			wp_print_styles( 'mce-two-cols' );
		}

		return $tag;
	}

	public function add_buttons( $plugin_array ) {
		$plugin_array['wusm_columns'] = plugins_url( '/js/wusm-columns.js', __FILE__ );
		return $plugin_array;
	}

	public function register_buttons( $buttons ) {
		// The ID value of the button we are creating
		array_push( $buttons, 'wusm_columns' );
		return $buttons;
	}

	public function column_shortcode_styles() {
		if ( !is_admin() ) {
			wp_register_style( 'column-styles', plugins_url('css/wusm-columns.css', __FILE__) );
			wp_enqueue_style( 'column-styles' );
		}
	}
}
new wusm_columns_plugin();
