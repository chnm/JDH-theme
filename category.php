<?php get_header(); ?>

<div class="article ten columns offset-by-two omega">

<h1>You are viewing entries marked '<?php single_cat_title(); ?>'.</h1>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="post">
    
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        
        <?php the_excerpt(); ?>
        
    </div>
    
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

<div class="navigation"><?php posts_nav_link('<span class="break"> </span>', "Newer results", "Older results"); ?></div>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>