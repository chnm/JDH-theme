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

add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

add_action( 'init', 'enable_category_taxonomy_for_pages', 500 );

function enable_category_taxonomy_for_pages() {
    register_taxonomy_for_object_type('category','page');
}


/* Flush rewrite rules for custom post types. */
add_action( 'load-themes.php', 'frosty_flush_rewrite_rules' );

/* Flush your rewrite rules */
function frosty_flush_rewrite_rules() {
	global $pagenow, $wp_rewrite;

	if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
		$wp_rewrite->flush_rules();
}

add_action( 'init', 'enable_category_taxonomy_for_introductions', 500 );

function enable_category_taxonomy_for_introductions() {
    register_taxonomy_for_object_type('category','introduction');
}


add_action( 'init', 'create_post_type' );

function create_post_type() {
	register_post_type( 'introduction',
		array(
    		'publicly_queryable' => true,
    		'query_var' => true,
    		'rewrite' => false,
			'labels' => array(
				'name' => __( 'Introductions' ),
				'singular_name' => __( 'Introductions' )
			),
		'public' => true,
		'has_archive' => true
		)
	);
	
	add_post_type_support( 'introduction', array('excerpt', 'custom-fields', 'author', 'revisions') );
}

global $wp_rewrite;
$introduction_structure = '/%category%/introduction/%introduction%';
$wp_rewrite->add_rewrite_tag("%introduction%", '([^/]+)', "introduction=");
$wp_rewrite->add_permastruct('introduction', $introduction_structure, false);

add_filter('post_type_link', 'introduction_permalink', 10, 3);	
// Adapted from get_permalink function in wp-includes/link-template.php
function introduction_permalink($permalink, $post_id, $leavename) {
	$post = get_post($post_id);
	$rewritecode = array(
		'%year%',
		'%monthnum%',
		'%day%',
		'%hour%',
		'%minute%',
		'%second%',
		$leavename? '' : '%postname%',
		'%post_id%',
		'%category%',
		'%author%',
		$leavename? '' : '%pagename%',
	);
 
	if ( '' != $permalink && !in_array($post->post_status, array('draft', 'pending', 'auto-draft')) ) {
		$unixtime = strtotime($post->post_date);
 
		$category = '';
		if ( strpos($permalink, '%category%') !== false ) {
			$cats = get_the_category($post->ID);
			if ( $cats ) {
				usort($cats, '_usort_terms_by_ID'); // order by ID
				$category = $cats[0]->slug;
				if ( $parent = $cats[0]->parent )
					$category = get_category_parents($parent, false, '/', true) . $category;
			}
			// show default category in permalinks, without
			// having to assign it explicitly
			if ( empty($category) ) {
				$default_category = get_category( get_option( 'default_category' ) );
				$category = is_wp_error( $default_category ) ? '' : $default_category->slug;
			}
		}
 
		$author = '';
		if ( strpos($permalink, '%author%') !== false ) {
			$authordata = get_userdata($post->post_author);
			$author = $authordata->user_nicename;
		}
 
		$date = explode(" ",date('Y m d H i s', $unixtime));
		$rewritereplace =
		array(
			$date[0],
			$date[1],
			$date[2],
			$date[3],
			$date[4],
			$date[5],
			$post->post_name,
			$post->ID,
			$category,
			$author,
			$post->post_name,
		);
		$permalink = str_replace($rewritecode, $rewritereplace, $permalink);
	} else { // if they're not using the fancy permalink option
	}
	return $permalink;
}

wp_enqueue_script('modernizr.custom.20659', get_template_directory_uri() . '/javascripts/modernizr.custom.20659.js',array(),'1.0',false);
wp_enqueue_script('respond.min', get_template_directory_uri() . '/javascripts/respond.min.js',array(),'1.0',true);
wp_enqueue_script('selectivizr-min', get_template_directory_uri() . '/javascripts/selectivizr-min.js',array('jquery'),'1.0',true);
wp_enqueue_script('jquery.cookie', get_template_directory_uri() . '/javascripts/jquery.cookie.js',array('jquery'),'1.0',true);
wp_enqueue_script('jquery.hoverIntent.minified', get_template_directory_uri('jquery') . '/javascripts/jquery.hoverIntent.minified.js',array(),'1.0',true);
wp_enqueue_script('jquery.dcjqaccordion.2.7.min', get_template_directory_uri('jquery') . '/javascripts/jquery.dcjqaccordion.2.7.min.js',array(),'1.0',true);


?>