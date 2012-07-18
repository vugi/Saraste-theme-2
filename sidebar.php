<?php $opt = get_option('saraste_theme_options');	?>

<aside>
	<?php
		if(is_page()){
			$subpages = wp_list_pages('title_li=&sort_column=menu_order&child_of=' . $post->ID . '&echo=0');
			if(empty($subpages)){
				$parent = $post->post_parent;
			} else {
				$parent = $post->ID;
			}
			$siblings = wp_list_pages('title_li=&sort_column=menu_order&child_of=' . $parent . '&echo=0&depth=1');
			if(!empty($siblings) && !empty($parent)){
				echo '<h2><a href="' . get_permalink($parent) . '">' . get_the_title($parent) . '</a></h2>';
				echo '<ul>' . $siblings . '</ul>';
			}
		}
	?>
	<?php get_sidebar('sivupalkki'); ?>
</aside>