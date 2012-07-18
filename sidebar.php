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
	<div class="featured">
		<div>
			<a href="#"><img src="<?php echo $opt["nosto1_kuva"]; ?>" alt=""></a>
			<a href="<?php echo $opt["nosto1_teksti"]; ?>"><h3><?php echo $opt["nosto1_teksti"]; ?></h3></a>
		</div>
		<div>
			<a href="#"><img src="<?php echo $opt["nosto2_kuva"]; ?>" alt=""></a>
			<a href="<?php echo $opt["nosto2_teksti"]; ?>"><h3><?php echo $opt["nosto2_teksti"]; ?></h3></a>
		</div>
	</div>
	<h2>Live</h2>
	<a href="#"><img src="http://placehold.it/340x225" alt=""></a>
	<h2>Blogit</h2>
	<div class="featured">
		<div>
			<a href="#"><img src="<?php echo $opt["blogi1_kuva"]; ?>" alt=""></a>
			<a href="<?php echo $opt["blogi1_teksti"]; ?>"><h3><?php echo $opt["blogi1_teksti"]; ?></h3></a>
		</div>
		<div>
			<a href="#"><img src="<?php echo $opt["blogi2_kuva"]; ?>" alt=""></a>
			<a href="<?php echo $opt["blogi2_teksti"]; ?>"><h3><?php echo $opt["blogi2_teksti"]; ?></h3></a>
		</div>
	</div>
	<div class="visible-desktop">
		<h3>Facebook</h3>
		<div class="fb-like-box" data-href="http://www.facebook.com/Saraste2012" data-width="340" data-height="400" data-show-faces="false" data-stream="true" data-header="false"></div>
	</div>
</aside>