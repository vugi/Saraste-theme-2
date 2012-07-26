<?php $first = 1; ?>
<?php $odd = 1; ?>
<div class="articles">
	<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php if($first && is_sticky()) : ?>
					<article class="first">
						<a href="<?php the_permalink(); ?>">
							<?php
								if (has_post_thumbnail()) {
									the_post_thumbnail('article-big');
								} 
							?>
						</a>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
						<?php the_content('Lue lisää &rarr;'); ?> 
					</article>
				<?php else : ?>
					<article<?php if($odd) echo ' class="odd"'; ?>>
						<a href="<?php the_permalink(); ?>">
							<?php
								if (has_post_thumbnail()) {
									the_post_thumbnail('article-small');
								} else {
									echo '<img src="' . get_bloginfo( 'template_directory') . '/img/default-thumb.jpg" alt="">';
								}
							?>
						</a>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
						<?php the_excerpt(); ?>
					</article>
					<?php $odd = ($odd ? 0 : 1); ?>
				<?php endif; ?>
				<?php if($first) : ?>
					<div id="recent">
				<?php endif; ?>
				<?php $first = 0; ?>
			<?php endwhile; ?>
		</div>
	<?php else: ?>
		<?php get_404_template(); ?>
	<?php endif; ?>
</div>