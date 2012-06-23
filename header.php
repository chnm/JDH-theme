<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="icon" 
      type="image/i" 
      href="<?php bloginfo( 'template_directory' ); ?>/images/favicon.ico">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/stylesheets/skeleton.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/stylesheets/layout.css" type="text/css" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Arvo:400,400italic|Ubuntu:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>  

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#menu-table-of-contents').dcAccordion({
		eventType: 'click',
		hoverDelay: 0,
		menuClose: false,
		autoClose: true,
		saveState: false,
		autoExpand: true,
		classExpand: 'current-menu-item',
		classDisable: '',
		showCount: false,
		disableLink: true,
		cookie: 'dc_jqaccordion_widget-2',
		speed: 'fast'
    });
});
</script>

</head>

<body <?php body_class(); ?>>

<div class="wrap">

<header>

    <div class="container">
        
        <a class="site-title" href="<?php echo home_url(); ?>">
            <img src="<?php bloginfo( 'template_directory' ); ?>/images/logo.png" alt="Journal of Digital Humanities">
        </a>

        <?php get_search_form(); ?>    

        <nav>        
            <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_class' => 'tabs' ) ); ?>
        </nav>
        
    </div>

</header>

<section id="content" class="container row ">


