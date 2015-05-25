<?php

	//include .css and .js files

	function wp_theme_styles() {
		wp_enqueue_style("main_css", get_template_directory_uri() . "/style.css");
	}

	add_action("wp_enqueue_scripts", "wp_theme_styles");

	function wp_theme_scripts() {
		wp_enqueue_script("bootstrap_js", "https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js", array("jquery"), "", true);
	}

	add_action("wp_enqueue_scripts", "wp_theme_scripts");

	//thumbnail Support
	add_theme_support( 'post-thumbnails' );

	//Menu Support
	function register_theme_menus() {
		register_nav_menus(
			array(
				"main-menu" => "Main Menu"
				)
		);
	}

	add_action("init", "register_theme_menus");

?>