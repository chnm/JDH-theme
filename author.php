<?php get_header(); ?>

<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<h1><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></h1>

<div class="author-bio">

    <h2>About</h2>

    <?php echo nl2br($curauth->description); ?>
    
</div>

<div class="author-posts">

    <h2>Entries</h2>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="post">
    
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        
        <?php the_excerpt(); ?>
        
    </div>
    
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

</div>

<div class="navigation"><?php posts_nav_link('<span class="break"> </span>', "Newer results", "Older results"); ?></div>

<?php get_footer(); ?>