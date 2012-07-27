<?php get_header(); ?>
<?php $i = $wp_query->post_count; ?>
<div class="articles">
	<h2>Kajaus</h2>
	<p><?php echo category_description($cat->cat_ID); ?></p>
	<?php if(have_posts()) : ?>
		<?php while(have_posts()) : ?>
			<article class="kajaus">
				<?php the_post(); ?>
				<a href="<?php the_permalink(); ?>">
					<?php
						if (has_post_thumbnail()) {
							the_post_thumbnail('kajaus-cover', array('class' => 'pull-left'));
						} 
					?>
				</a>
				<h3><a href="<?php the_permalink(); ?>">Kajaus <?php echo $i--; ?>/2012</a></h3>
				<p class="meta"><?php the_time("j.n.Y"); ?></p>
				<p><?php the_content('Lue lehti &rarr;'); ?>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php get_footer(); ?>