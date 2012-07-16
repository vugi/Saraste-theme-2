<?php

add_theme_support('post-thumbnails'); 
add_image_size('article-big', 580, 250);
add_image_size('article-small', 280, 120);
add_image_size('sidebar-thumb', 160, 100);

add_filter('excerpt_length', 'saraste_excerpt_length', 999);
function saraste_excerpt_length( $length ) {
	return 15;
}

add_filter('excerpt_more', 'saraste_excerpt_more');
function saraste_excerpt_more( $more ) {
	return '...';
}

function saraste_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<div <?php comment_class('well'); ?> id="comment-<?php comment_ID() ?>">
		<?php echo get_avatar($comment, 50); ?>
		<p class="comment-author vcard"><strong><?php comment_author_link(); ?></strong><span style="float: right;"><?php edit_comment_link('Muokkaa'); ?></p>
		<p class="comment-meta"><a href="#comment-<?php comment_ID() ?>"><?php comment_date('j.n.Y'); ?> klo <?php comment_time('h:i'); ?></a></p>
		<div class="comment-body"><?php comment_text(); ?></div>
	</div>

<?php
}

add_filter( 'wp_title', 'saraste_wp_title', 10, 2 );
function saraste_wp_title( $title, $separator ) {
	// Tämä on Boilerplatesta...
	
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf('Haku: %s', '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf('Sivu %s', $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf('Sivu %s', max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}


?>