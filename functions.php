<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Left Sidebar',
        'before_widget' => '',
        'after_widget' => '',
    'before_title' => '<div class="title"><h4>',
        'after_title' => '</h4></div>',
    ));    
    
    register_sidebar(array(
        'name' => 'Footer',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class="title">',
        'after_title' => '</div>',
    ));
    
    register_sidebar(array(
        'name' => 'Article Previews',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class="title">',
        'after_title' => '</div>',
    ));
    
    register_sidebar(array(
        'name' => 'Conversation Previews',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class="title">',
        'after_title' => '</div>',
    ));
    
    register_sidebar(array(
        'name' => 'Review Previews',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class="title">',
        'after_title' => '</div>',
    ));    
    
function register_my_menus() {
  register_nav_menus(
    array('main-menu' => __( 'Main Menu' ) )
  );
}

add_action( 'init', 'register_my_menus' );

add_action( 'init', 'enable_category_taxonomy_for_pages', 500 );

function enable_category_taxonomy_for_pages() {
    register_taxonomy_for_object_type('category','page');
}

add_action( 'init', 'enable_category_taxonomy_for_introductions', 500 );

function enable_category_taxonomy_for_introductions() {
    register_taxonomy_for_object_type('category','introduction');
}

add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'introduction',
		array(
			'labels' => array(
				'name' => __( 'Introductions' ),
				'singular_name' => __( 'Introductions' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
	add_post_type_support( 'introduction', array('excerpt', 'custom-fields', 'author', 'revisions') );
}

add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

wp_enqueue_script('modernizr.custom.20659', get_template_directory_uri() . '/javascripts/modernizr.custom.20659.js',array(),'1.0',false);
wp_enqueue_script('respond.min', get_template_directory_uri() . '/javascripts/respond.min.js',array(),'1.0',true);
wp_enqueue_script('selectivizr-min', get_template_directory_uri() . '/javascripts/selectivizr-min.js',array('jquery'),'1.0',true);
wp_enqueue_script('jquery.cookie', get_template_directory_uri() . '/javascripts/jquery.cookie.js',array('jquery'),'1.0',true);
wp_enqueue_script('jquery.hoverIntent.minified', get_template_directory_uri('jquery') . '/javascripts/jquery.hoverIntent.minified.js',array(),'1.0',true);
wp_enqueue_script('jquery.dcjqaccordion.2.7.min', get_template_directory_uri('jquery') . '/javascripts/jquery.dcjqaccordion.2.7.min.js',array(),'1.0',true);


?>