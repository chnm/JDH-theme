<?php get_header(); ?>

<div class="sidebar four columns alpha">
    <?php get_sidebar(); ?>
</div>
    
<div id="article" class="ten columns offset-by-two omega">

<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<div class="gravatar">
    <?php echo get_avatar($curauth->ID, $size = '52', $default = 'http://www.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536'); ?>
</div>

<h1><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></h1>

<?php if($curauth->description): ?>

<div class="author-bio">

    <h2>About</h2>

    <?php echo nl2br($curauth->description); ?>
    
</div>

<?php endif; ?>

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

<div class="navigation"><?php posts_nav_link('<span class="break"> </span>', "Previous results", "Next results"); ?></div>

<?php get_footer(); ?>