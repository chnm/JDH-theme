<?php get_header(); ?>

<div id="article" class="ten columns offset-by-two omega">

<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<h1>Entries by <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?>.</h1>

<div class="author-bio">

    <?php echo nl2br($curauth->description); ?>
    
</div>

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