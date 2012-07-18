<?php get_header(); ?>

<?php $first = 1; ?>
<?php $categories = get_categories('child_of=' . get_query_var('cat') . '&orderby=count'); ?>
<article>
	<h2>Blogit</h2>
	<?php foreach ($categories as $cat) : ?>
		<?php query_posts('cat=' . $cat->cat_ID . '&showposts=2'); ?>
		<?php if(!$first) echo '<hr>'; ?>
		
		<h3 class="blogs"><a href="<?php echo get_category_link($cat->cat_ID); ?>"><?php single_cat_title(); ?></a></h3>
		<p><?php echo category_description($cat->cat_ID); ?></p>
		
		<?php $odd = 1; ?>
		<div id="recent">
			<?php while (have_posts()) : the_post(); ?>
				<div<?php if($odd) echo ' class="odd"'; ?>>
					<?php
						if (has_post_thumbnail('article-small')) {
							the_post_thumbnail();
						} else {
							echo '<img src="' . get_bloginfo( 'template_directory') . '/img/default-thumb.jpg" alt="">';
						}
					?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
					<?php the_excerpt(); ?>
				</div>
				<?php $odd = ($odd ? 0 : 1); ?>
			<?php endwhile; ?>
		</div>
		<?php $first = 0; ?>
	<?php endforeach; ?> 
</article>

<?php get_footer(); ?>