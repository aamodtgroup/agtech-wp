<?php
/**
 * The theme setup function.
 * 
 * @since 1.0.0
 */
function agtech_setup() {

	// Set text domain.
	load_theme_textdomain( 'agtech', get_template_directory() . '/languages' );

	// Add theme support.
	add_theme_support( 'html5' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-background', array( 'default-color' => '0077b5' ) );

	// Set content width.
	$GLOBALS['content_width'] = 768;

	/**
	 * Fires after the theme setup has finished.
	 * 
	 * @since 1.0
	 */
	do_action( 'agtech_theme_setup' );

}

add_action( 'after_setup_theme', 'agtech_setup', 10, 0 );

/* 
	Custom functions
*/

// add custom fields to REST API
function add_acf_fields_to_rest( $data, $post, $request ) {
  $_data = $data->data;
  $_data['set_rest_api_name'] = get_field('acf_field_name', $post->ID);
 /* add more fields here if necessary */
  $data->data = $_data;
  return $data;
}
add_filter( 'rest_prepare_post', 'add_acf_fields_to_rest', 10, 3 );


/*
	Sitemap
*/

// enable core sitemap
add_filter( 'wp_sitemaps_enabled', '__return_true' );

// Disable "user" sitemap
function disable_sitemap_users($provider, $name) {
	return ($name == 'users') ? false : $provider;
}
add_filter('wp_sitemaps_add_provider', 'disable_sitemap_users', 10, 2);

// Disable "post" sitemap
function disable_sitemap_post_types($post_types) {
	unset($post_types['post']);
	return $post_types;
}
add_filter('wp_sitemaps_post_types', 'disable_sitemap_post_types');

// Disable "category" sitemap
function disable_sitemap_taxonomy($taxonomies) {
	unset($taxonomies['category']);
	return $taxonomies;
}
add_filter('wp_sitemaps_taxonomies', 'disable_sitemap_taxonomy');

// Change sitemap links
function unparse_url($parsed_url)
{
	$scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
	$host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
	$port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
	$user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
	$pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
	$pass     = ($user || $pass) ? "$pass@" : '';
	$path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
	$query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
	$fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
	return "$scheme$user$pass$host$port$path$query$fragment";
}

function change_urls($entry)
{
	$parsed_url              = parse_url($entry['loc']);
	$parsed_url['scheme']    = 'https';
	$parsed_url['host']      = 'example.com';
	$entry['loc'] = unparse_url($parsed_url);
	return $entry;
}

add_filter('wp_sitemaps_posts_entry', 'change_urls');
add_filter('wp_sitemaps_taxonomies_entry', 'change_urls');
add_filter('wp_sitemaps_users_entry', 'change_urls');