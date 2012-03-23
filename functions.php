<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
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

?>