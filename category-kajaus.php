<?php get_header(); ?>
<article>
	<h2>Kajaus</h2>
	<?php if ( have_posts() ) : ?>
	<?php $count = $wp_query->found_posts; ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<a href="<?php the_permalink(); ?>" class="thumb">
				<img src="<?php echo get_post_meta($post->ID, 'kajaus_thumb', true); ?>" alt="">Kajaus <?php echo $count--; ?>/2012
			</a>
		<?php endwhile; ?>
	<?php endif; ?>
</article>
<?php get_footer(); ?>