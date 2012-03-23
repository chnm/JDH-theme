<?php get_header(); ?>

<div class="article ten columns offset-by-two omega">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h1><?php the_title(); ?></h1>

    <?php 
        $authors = get_post_custom_values('article_author'); 
        foreach ($authors as $key => $value) {
            echo '<p class="author">'.$value.'</p>';
        }
    ?>
    
    <?php the_content(); ?>
    
    <?php comments_template(); ?>
    
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>