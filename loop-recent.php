﻿<?php if ( have_posts() ) : ?>
	<div id="recent">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<div>
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
		<?php endwhile; ?>
	</div>
<?php endif; ?>