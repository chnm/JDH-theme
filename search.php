<?php get_header(); ?>

<div class="sidebar four columns alpha">
    <?php get_sidebar(); ?>
</div>
    
<div id="article" class="ten columns offset-by-two omega">

<h1>Results for "<?php the_search_query() ?>".</h1>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="post">
    
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        
        <?php the_excerpt(); ?>
        
    </div>
    
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

<div class="navigation"><?php posts_nav_link('<span class="break"> </span>', "Previous results", "Next results"); ?></div>

<?php get_footer(); ?>