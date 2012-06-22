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

?>