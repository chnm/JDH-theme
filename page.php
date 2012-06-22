<?php get_header(); ?>

<div class="sidebar four columns alpha">
    <?php get_sidebar(); ?>
</div>
    
<div id="article" class="ten columns offset-by-two omega">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
    <h1><?php the_title(); ?></h1>
    
    <?php the_content(); ?>
    
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>