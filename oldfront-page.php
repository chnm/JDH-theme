<?php get_header(); ?>
    
<div class="front-page twelve columns offset-by-two omega">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>

<?php

    $pdf_values = get_post_custom_values('pdf_url');
    foreach ( $pdf_values as $key => $value ) {
      $pdf_url = "$value"; 
    }
    
    $epub_values = get_post_custom_values('epub_url');
    foreach ( $epub_values as $key => $value ) {
      $epub_url = "$value"; 
    }    

?>

<div class="downloads">
    <p>Available for download</p>
    <a href="<?php echo $pdf_url; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/pdf.png" alt="pdf download"></a>
    <a href="<?php echo $epub_url; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/epub.png" alt="epub download"></a>
</div>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

<div class="introduction">

<h2>Introductions</h2>

<?php
$args = array( 'numberposts' => 3, 'category' => 8 );
$lastposts = get_posts( $args );
$i = 0;
foreach($lastposts as $post) : setup_postdata($post); ?>
	<?php if($i == 0): ?>
    	<div class="intro-post six columns alpha">
	<?php else: ?>
    	<div class="intro-post six columns omega">
    <?php endif; ?>
    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php if(function_exists('coauthors')): ?>
            <h4 class="author-name"><?php coauthors(',<br>'); ?></h4>
        <?php else: ?>
            <h4 class="author-name"><?php echo the_author_meta('first_name'); ?> <?php echo the_author_meta('last_name'); ?></h4>
        <?php endif; ?>
    	<?php the_excerpt(); ?>
    </div>	
    <?php $i++; ?>
<?php endforeach; ?>

</div>

<div class="front-page-section">

    <div class="five columns alpha">
        <h3>Articles</h3>
        <?php
        $args = array( 'numberposts' => -1, 'category' => 5 );
        $lastposts = get_posts( $args );
        $i = 0;
        foreach($lastposts as $post) : setup_postdata($post); ?>
            	<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                <?php if(function_exists('coauthors')): ?>
                    <?php coauthors(',<br>'); ?>
                <?php else: ?>
                    <?php echo the_author_meta('first_name'); ?> <?php echo the_author_meta('last_name'); ?>
                <?php endif; ?>
                </p>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>

    <div class="toc-previews six columns omega offset-by-one">
        <?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar('Article Previews') ) : ?>
        <?php endif; ?>
    </div>

</div>

<div class="front-page-section">

    <div class="toc-previews six columns alpha">
        <?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar('Conversation Previews') ) : ?>
        <?php endif; ?>
    </div>

    <div class="five columns omega offset-by-one">
        <h3>Conversations</h3>
        <?php
        $args = array( 'numberposts' => -1, 'category' => 9 );
        $lastposts = get_posts( $args );
        $i = 0;
        foreach($lastposts as $post) : setup_postdata($post); ?>
            	<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                <?php if(function_exists('coauthors')): ?>
                    <?php coauthors(',<br>'); ?>
                <?php else: ?>
                    <?php echo the_author_meta('first_name'); ?> <?php echo the_author_meta('last_name'); ?>
                <?php endif; ?>
                </p>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>

</div>

<div class="front-page-section">

    <div class="three columns alpha">
        <h3>Reviews</h3>
        <?php
        $args = array( 'numberposts' => -1, 'category' => 7 );
        $lastposts = get_posts( $args );
        $i = 0;
        foreach($lastposts as $post) : setup_postdata($post); ?>
            	<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                <?php if(function_exists('coauthors')): ?>
                    <?php coauthors(',<br>'); ?>
                <?php else: ?>
                    <?php echo the_author_meta('first_name'); ?> <?php echo the_author_meta('last_name'); ?>
                <?php endif; ?>
                </p>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>

    <div class="toc-previews eight columns omega offset-by-one">
        <?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar('Review Previews') ) : ?>
        <?php endif; ?>
    </div>

</div>

 <?php rewind_posts(); ?>
 
    <?php while (have_posts()) : the_post(); ?>

    <p class="issn">
        <?php
        
          $mykey_values = get_post_custom_values('issn');
          foreach ( $mykey_values as $key => $value ) {
            echo "$value"; 
          }
        
        ?>
    </p>

    <?php endwhile; ?>

<?php get_footer(); ?>