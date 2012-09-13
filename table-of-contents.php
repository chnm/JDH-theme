<?php
/*
Template Name: Archived Table of Contents
*/
?>

<?php get_header(); ?>
    
<div class="front-page twelve columns offset-by-two omega">

<?php /* This section is the introduction for the table of contents. It pulls the_content() from the Table of Contents page. That page also has custom meta values for the PDF and EPUB links. */

if ( have_posts() ) : while ( have_posts() ) : the_post();

    the_content(); 
    
    $pdf_url = null;
    if($pdf_values = get_post_custom_values('pdf_url')) {
        $pdf_url = $pdf_values[0]; 
    }
    
    $epub_url = null;
    if($epub_values = get_post_custom_values('epub_url')) {
        $epub_url = $epub_values[0]; 
    }

    $ibook_url = null;
    if($ibook_values = get_post_custom_values('ibook_url')) {
        $ibook_url = $ibook_values[0]; 
    }


?>

    <div class="downloads">
        <p>Available for download</p>
        <?php if($pdf_url): ?>
        <a href="<?php echo $pdf_url; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/pdf.png" alt="pdf download"></a>
        <?php endif; ?>
        <?php if($epub_url): ?>
        <a href="<?php echo $epub_url; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/epub.png" alt="epub download"></a>
        <?php endif; ?>
        <?php if($ibook_url): ?>
        <a href="<?php echo $ibook_url; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ibook.png" alt="ibook download"></a>
        <?php endif; ?>

    </div>

<?php endwhile; else: ?>

    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

<?php /*  This section checks the category for this page, which should be the issue number, and looks for all posts that fall under this issue and the "Introduction" category. */ ?>

<div class="introduction">

<?php 
    if(has_category()):
    $issueCategories = get_the_category(); 
    $issueCategory = $issueCategories[0]->term_id;
    endif;
    
    $intro = get_terms('category', array('name__like' => 'Introduction', 'parent' => $issueCategory, 'hide_empty' => 0));
    $introId = $intro[0]->term_id;
        if ( is_user_logged_in() ) {
        $args = array( 'numberposts' => 2, 'cat' => $introId, 'post_status' => 'publish,private,draft,inherit' );
    } else {
        $args = array( 'numberposts' => 2, 'cat' => $introId );
    }
    $lastposts = get_posts( $args ); ?>
    
    <h2><?php echo $intro[0]->name; ?></h2>

    <?php if(count($lastposts)==1): ?>
        <?php $post = $lastposts[0]; ?>
        <div class="solo eight columns offset-by-two">
            <h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php if(function_exists('coauthors')): ?>
                <h4 class="author-name"><?php coauthors(',<br>'); ?></h4>
            <?php else: ?>
                <h4 class="author-name"><?php echo the_author_meta('first_name'); ?> <?php echo the_author_meta('last_name'); ?></h4>
            <?php endif; ?>
            <?php if(get_the_excerpt()): ?>
                <?php the_excerpt(); ?>
            <?php endif; ?>
        </div>
    <?php elseif(count($lastposts) == 0): ?>
            <p>No introduction posts found.</p>
    <?php else:     
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
    <?php endif; ?>

</div>


<?php

if($introId) {
    $categories = get_categories( array('parent' => $issueCategory, 'hide_empty' => 0, 'exclude' => $introId) );
} else {
    $categories = get_categories( array('parent' => $issueCategory, 'hide_empty' => 0) );
}

$j = 0;
foreach($categories as $category) :

    $j++;

    $categoryId = $category->term_id;
    $categoryName = $category->name; 

    $subcategories = get_categories( array('parent' => $categoryId, 'hide_empty' => 0) );

    $featured = get_category_by_slug('featured');
    $featuredId = $featured->term_id;

    $excludeIds = array();
    for ($k = 0; $k < count($subcategories); $k++) {
        $excludeIds[$k] = $subcategories[$k]->term_id;
    }
    array_push($featuredId, $excludeIds);

    if ( is_user_logged_in() ) {
        $lastArgs = array('category' => $categoryId, 'category__not_in' => $excludeIds, 'post_status' => 'publish,private,draft,inherit', 'numberposts' => -1 );
        $featuredPosts = get_posts(array('category__and' => array($categoryId, $featuredId), 'post_status' => 'publish,draft,private,inherit'));
        
    } else {
        $lastArgs = array('category' => $categoryId, 'category__not_in' => $excludeIds, 'numberposts' => -1);
        $featuredPosts = get_posts(array('category__and' => array($categoryId, $featuredId), 'post_status' => 'public'));        
    }
    
    $lastposts = get_posts($lastArgs);
    
    /* Every other subcategory uses a layout displaying articles on the right. */  ?>

    <div class="front-page-section">

        
    <?php if( $j % 2 != 0): ?>
                
        <div class="five columns alpha">
        
            <h3><?php echo $categoryName; ?></h3>
            
            <?php if($subcategories): ?>
                <?php $l = 1; ?>
                <?php foreach($subcategories as $subcategory): ?>
                    <?php $subcategoryPosts = get_posts(array('category' => $subcategory->term_id)); ?>
                    <h4><?php echo $l . '. ' . $subcategory->name; ?></h4>
                    <?php jdh_toc_list_posts($subcategoryPosts); ?>
                    <?php $l++; ?>
                <?php endforeach; ?>
                <?php if($lastposts): ?>
                    <h4><?php echo $l; ?>. Other</h4>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php jdh_toc_list_posts($lastposts); ?>
                        
        </div>
        
        <div class="toc-previews six columns offset-by-one omega">
            <?php 
            /* There should only be one featured post in this subcategory, and this is where we display it. */
            if($featuredPosts): 
                echo $featuredPosts[0]->post_content;
            else:
                echo '<p>Featured content post needs to be created for this category.</p>';
            endif; ?>
        </div> 
        
    <?php else: ?>
        
        <div class="toc-previews six columns alpha">
            <?php 
            if($featuredPosts): 
                echo $featuredPosts[0]->post_content;                                    
            else:
                echo '<p>Featured content post needs to be created for this category.</p>';
            endif; ?>
        </div> 
        
        <div class="five columns offset-by-one omega">
        
            <h3><?php echo $categoryName; ?></h3>
            
            <?php if($subcategories): ?>
                <?php $l = 1; ?>
                <?php foreach($subcategories as $subcategory): ?>
                    <?php $subcategoryPosts = get_posts(array('category' => $subcategory->term_id)); ?>
                    <h4><?php echo $l . '. ' . $subcategory->name; ?></h4>
                    <?php jdh_toc_list_posts($subcategoryPosts); ?>
                    <?php $l++; ?>
                <?php endforeach; ?>
                <?php if($lastposts): ?>
                    <h4><?php echo $l; ?>. Other</h4>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php jdh_toc_list_posts($lastposts); ?>
            
        </div>
        
    <?php endif; ?> 
    
    </div>                      

<?php endforeach; ?>

    <p class="issn">ISSN 2165-6673</p>

<?php get_footer(); ?>                 