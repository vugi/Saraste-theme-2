<?php

add_filter('excerpt_length', 'custom_excerpt_length', 999);
function custom_excerpt_length( $length ) {
	return 15;
}

add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more( $more ) {
	return '...';
}


?>