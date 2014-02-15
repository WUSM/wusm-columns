<?php
/*
Plugin Name: Dashicons in TinyMCE demo
Plugin URI: 
Description: Demonstration of how to use dashicons in custom TinyMCE buttons
Author: Aaron Graham
Version: 0.1
Author URI: 
*/

class tinymce_dashicon_plugin {
	public function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}
	
	public function admin_init() {
		add_filter( 'style_loader_tag', array( $this, 'style_loader_tag' ), 50, 2 );
		add_filter( 'mce_external_plugins', array( $this, 'add_buttons' ) );
		add_filter( 'mce_buttons', array( $this, 'register_buttons' ) );
	}
	
	public function style_loader_tag( $tag, $handle ) {
		if ( $handle == 'editor-buttons' ) {
			remove_filter( 'style_loader_tag', array( $this, 'style_loader_tag' ), 50, 2 );
			wp_register_style( 'mce-two-cols', plugin_dir_url( __FILE__ ) . 'css/tinymce-dashicon.css' );
			wp_print_styles( 'mce-two-cols' );
		}

		return $tag;
	}

	public function add_buttons( $plugin_array ) {
		$plugin_array['tinymce_dashicon'] = plugins_url( '/js/tinymce-dashicon.js', __FILE__ );
		return $plugin_array;
	}
	public function register_buttons( $buttons ) {
		// The ID value of the button we are creating
		array_push( $buttons, 'tinymce_dashicon' );
		return $buttons;
	}
}
new tinymce_dashicon_plugin();