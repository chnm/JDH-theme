<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h1><?php the_title(); ?></h1>
    
    <?php if(function_exists('coauthors')): ?>
        <h4 class="author"><?php coauthors(',<br>'); ?></h4>
    <?php else: ?>
        <h4 class="author"><?php echo the_author_meta('first_name'); ?> <?php echo the_author_meta('last_name'); ?></h4>
    <?php endif; ?>
    
    <?php the_content(); ?>
    
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

<?php get_footer(); ?>