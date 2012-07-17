 <?php if ( have_posts() ) : ?>
	<article>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<?php
			if (has_post_thumbnail('article-big')) {
				the_post_thumbnail();
			} 
		?>
		<h2><?php the_title(); ?></h2>
		<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
		<?php the_content(); ?>
		
		<div class="well well-small">
			<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink());?>&send=false&layout=button_count&width=90&show_faces=false&action=like&colorscheme=light&font&height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px; margin-bottom: -1px;" allowTransparency="true"></iframe>
			<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-via="Saraste2012">Tweet</a>
			<div class="g-plusone" data-size="medium" data-annotation="none" data-href="<?php get_permalink(); ?>"></div>
		</div>
		
		<?php comments_template(); ?>
	<?php endwhile; ?>
	</article>
	
<?php else: ?>
	
	<?php get_404_template(); ?>
 
 <?php endif; ?>