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
				echo '<div class="well" style="padding: 8px 0;"><ul class="nav nav-list">';
				echo '<li class="nav-header"><a href="' . get_permalink($parent) . '">' . get_the_title($parent) . '</a></li>';
				echo $siblings;
				echo '</ul></div>';
			}
		}
	?>
	<?php dynamic_sidebar('sivupalkki'); ?>
	<?php if($post->post_parent == 1008) : // Leiriläisille ?>
		<a href="http://www.scandinavianoutdoorstore.com/" target="_blank"><img src="http://www.saraste2012.fi/wp-content/uploads/2012/07/scandinavian-outdoor-store-banneri.png" alt="Partiovaruste"></a>
	<?php endif; ?>
</aside>