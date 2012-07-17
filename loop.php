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
		
		<?php if(is_single()) : ?>
			<div id="social">				
				<div class="fb-like" data-send="false" data-width="390" data-show-faces="false" data-font="tahoma"></div>
				<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>
				<a href="https://twitter.com/share" class="twitter-share-button" data-via="Saraste2012" data-lang="fi" data-size="large" data-count="none">Twiittaa</a>
			</div>
		<?php endif; ?>
		
		<?php comments_template(); ?>
	<?php endwhile; ?>
	</article>
	
<?php else: ?>
	
	<?php get_404_template(); ?>
 
 <?php endif; ?>