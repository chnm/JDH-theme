<?php

global $wp_query;

$currentPostId = (int) $wp_query->queried_object_id;
$categories = get_the_category($currentPostId);
if($categories[0]->category_parent == 0) {
    $parent = $categories[0];
} else {
    $parent = get_category(jdh_category_top_parent_id($categories[0]));
    
}
$parentName = $parent->name;
$parentId = jdh_category_top_parent_id($categories[0]);
$categories = get_terms( 'category', array('parent' => $parentId, 'hide_empty' => 0));

?>

<h3>Table of Contents for <?php echo $parentName; ?></h3>

<ul id="menu-table-of-contents" class="menu">

<?php     
    foreach($categories as $category):
        $categoryId = $category->term_id;
        $categoryName = $category->name; 
        $featuredCategory = get_category_by_slug('featured');
        $featuredId = $featuredCategory->term_id;
        $subcategories = get_categories(array('parent' => $categoryId, 'hide_empty' => 0));
        $excludeIds = array();
        for ($k = 0; $k < count($subcategories); $k++) {
            $excludeIds[$k] = $subcategories[$k]->term_id;
        }
        $excludeIds[] = $featuredId;

        
        if(is_user_logged_in()) {
            $lastposts = get_posts( array('numberposts' => -1, 'category' => $categoryId, 'category__not_in' => $excludeIds, 'post_status' => 'publish,private,draft,inherit') );
        } else {
            $lastposts = get_posts( array('numberposts' => -1, 'category' => $categoryId, 'category__not_in' => $excludeIds) );
        }
    
?>
        <li class="parent"><a href="<?php echo get_category_link($categoryId); ?>"><?php echo $categoryName; ?></a>
            <ul class="sub-menu">
            <?php if($subcategories): ?>
                <?php $i = 1; ?>
                <?php foreach($subcategories as $subcategory): ?>
                    <?php $subcategoryId = $subcategory->term_id; ?>
                    <li class="parent"><a href="<?php echo get_category_link($subcategoryId); ?>"><?php echo $i . ". " . $subcategory->name; ?></a>
                        <ul class="sub-menu">
                        <? if (is_user_logged_in()): ?>
                            <?php $subcategoryPosts = get_posts( array('numberposts' => -1, 'category' => $subcategoryId, 'category__not_in' => $featuredId, 'post_status' => 'publish,private,draft,inherit') ); ?>
                        <?php else: ?>
                            <?php $subcategoryPosts = get_posts( array('numberposts' => -1, 'category' => $subcategoryId, 'category__not_in' => $featuredId) ); ?>
                        <?php endif; ?>
                        <?php jdh_nested_subcategories($subcategoryPosts, $currentPostId, $subcategoryId); ?>
                        </ul>
                    </li>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php jdh_nested_subcategories($lastposts, $currentPostId, $categoryId); ?>
            </ul>
        </li>
<?php endforeach; ?>   
<?php if($authors = get_permalink( get_page_by_path( 'authors' ))): ?>
    <li><a href="<?php echo $authors; ?>">Authors</a></li>
<?php endif; ?>
</ul>