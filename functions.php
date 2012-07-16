<?php

add_filter('excerpt_length', 'custom_excerpt_length', 999);
function custom_excerpt_length( $length ) {
	return 15;
}

add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more( $more ) {
	return '...';
}

function saraste_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
?>
	<div <?php comment_class('well'); ?> id="comment-<?php comment_ID() ?>">
		<?php echo get_avatar($comment, $args['avatar_size']); ?>
		<p class="comment-author vcard"><strong><?php comment_author_link(); ?></strong><span style="float: right;"><?php edit_comment_link('Muokkaa'); ?></p>
		<p class="comment-meta"><a href="#comment-<?php comment_ID() ?>"><?php comment_date('j.n.Y'); ?> klo <?php comment_time('h:i'); ?></a></p>
		<p class="comment-body"><?php comment_text(); ?></p>
	</div>

<?php
}
?>