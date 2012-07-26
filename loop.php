 <?php if ( have_posts() ) : ?>
	<article>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php
				if (has_post_thumbnail()) {
					the_post_thumbnail('article-big');
				} 
			?>
			<?php if(is_category()) : ?>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php else : ?>
				<h2><?php the_title(); ?></h2>
			<?php endif; ?>
			<?php if(!is_page()){ ?><p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p><?php } ?>
			<?php the_content(); ?>
			
			<?php if(is_single()) : ?>
				<div id="social" class="visible-desktop">				
					<div class="fb-like" data-send="false" data-width="390" data-show-faces="false" data-font="tahoma"></div>
					<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="Saraste2012" data-lang="fi" data-size="large" data-count="none">Twiittaa</a>
				</div>
				<?php comments_template(); ?>
			<?php endif; ?>
		<?php endwhile; ?>
		<?php if(is_category()) : ?>
			<?php if ($wp_query->max_num_pages > 1) : ?>
				<ul class="pager">
				  <li class="previous">
					<?php next_posts_link('&larr; Vanhemmat artikkelit'); ?>
				  </li>
				  <li class="next">
					<?php previous_posts_link('Uudemmat artikkelit &rarr;'); ?>
				  </li>
				</ul>
			<?php endif; ?>		
		<?php endif; ?>
	</article>
	
<?php else: ?>
	
	<?php get_404_template(); ?>
 
 <?php endif; ?>