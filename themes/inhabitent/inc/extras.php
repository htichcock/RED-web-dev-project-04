<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package inhabitent_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function inhabitent_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'inhabitent_body_classes' );


// Remove "Editor" links from sub-menus
function inhabitent_remove_submenus() {
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
	remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}
add_action( 'admin_menu', 'inhabitent_remove_submenus', 110 );


//login logo
function inhabitent_login_logo() {
	echo '<style type="text/css">
			#login h1 a { 
				background-image:url('.get_stylesheet_directory_uri().'/images/inhabitent-logo-text-dark.svg);
				background-size: contain;
				height: 50px;
				width: 300px; }                            
	</style>';
}
add_action('login_head', 'inhabitent_login_logo');

function inhabitent_login_logo_url( $url ) {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'inhabitent_login_logo_url' );

function inhabitent_login_logo_url_title(){
	return 'Inhabitent';
}
add_filter('login_headertitle', 'inhabitent_login_logo_url_title');

//dynamic css
function inhabitent_dynamic_css() {
	
	if ( ! is_page_template( 'page_templates/about.php') ) {
		return;
	}
	
	$image = CFS()->get( 'about_header_image' );

	if ( ! $image ) {
		return;
	}
	
	$hero_css = ".page-template-about .entry-header {
		background:
			linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
			url({$image}) no-repeat center bottom;
		background-size: cover;
		height: 100vh;
	}";
	
	wp_add_inline_style( 'inhabitent-style' , $hero_css );
}
add_action( 'wp_enqueue_scripts', 'inhabitent_dynamic_css');