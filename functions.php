<?php

add_theme_support('automatic-feed-links');

add_theme_support('post-thumbnails'); 
add_image_size('article-big', 580, 250, true);
add_image_size('article-small', 280, 120, true);
add_image_size('sidebar-thumb', 160, 100, true);
add_image_size('kajaus-cover', 150, 215, true);

register_sidebar(array('name' => 'Sivupalkki', 'id' => 'sivupalkki', 'before_widget' => '', 'after_widget' => '', 'before_title' => '<h2>', 'after_title' => '</h2>'));
register_sidebar(array('name' => 'Yhteystiedot', 'id' => 'contact', 'before_widget' => '<address>', 'after_widget' => '</address>', 'before_title' => '<strong>', 'after_title' => '</strong>'));

add_filter('excerpt_length', 'saraste_excerpt_length', 999);
function saraste_excerpt_length( $length ) {
	return 10;
}

add_filter('excerpt_more', 'saraste_excerpt_more');
function saraste_excerpt_more( $more ) {
	return '...';
}

add_action('init', 'my_init');
function my_init() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery'); 
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', false, '1.7.2'); 
		wp_enqueue_script('jquery');
	}
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


//[alasivut]
add_shortcode('alasivut', 'alasivut_func');
function alasivut_func(){
	global $post;

	if($post->post_parent) {
		$children = wp_list_pages("title_li=&child_of=" . $post->post_parent . "&echo=0");
  } else {
		$children = wp_list_pages("title_li=&child_of=" . $post->ID . "&echo=0");
  }
  
  if($children){
		$r = '<ul>' . $children . '</ul>';
		return $r;
  }
}

//https://gist.github.com/1597994
add_action( 'after_setup_theme', 'bootstrap_setup' );
function bootstrap_setup(){

	add_action( 'init', 'register_menu' );

	function register_menu(){
		register_nav_menu( 'nav', 'Navigaatio' ); 
	}

	class bootstrap_menu extends Walker_Nav_Menu {


		function start_lvl( &$output, $depth ) {

			$indent = str_repeat( "\t", $depth );
			$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";

		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$li_attributes = '';
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = ($args->has_children) ? 'dropdown' : '';
			$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
			$classes[] = 'menu-item-' . $item->ID;


			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

			if ( !$element )
				return;

			$id_field = $this->db_fields['id'];

			//display this element
			if ( is_array( $args[0] ) ) 
				$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
			else if ( is_object( $args[0] ) ) 
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
			$cb_args = array_merge( array(&$output, $element, $depth), $args);
			call_user_func_array(array(&$this, 'start_el'), $cb_args);

			$id = $element->$id_field;

			// descend only when the depth is right and there are childrens for this element
			if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
				foreach( $children_elements[ $id ] as $child ){

					if ( !isset($newlevel) ) {
						$newlevel = true;
						//start the child delimiter
						$cb_args = array_merge( array(&$output, $depth), $args);
						call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
					}
					$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
				}
					unset( $children_elements[ $id ] );
			}

			if ( isset($newlevel) && $newlevel ){
				//end the child delimiter
				$cb_args = array_merge( array(&$output, $depth), $args);
				call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
			}

			//end this element
			$cb_args = array_merge( array(&$output, $element, $depth), $args);
			call_user_func_array(array(&$this, 'end_el'), $cb_args);
		}
	}
}


if(function_exists('register_post_type')){
	$labels = array(
							'name' => 'Purkit', 
							'singular_name' => 'Purkki',
							'add_new' => 'Lisää uusi',
							'all_items' => 'Kaikki purkit',
							'add_new_item' => 'Lisää uusi purkki',
							'edit_item' => 'Muokkaa purkkia',
							'new_item' => 'Uusi purkki',
							'view_item' => 'Näytä purkki',
							'search_items' => 'Etsi purkkeja',
							'not_found' => 'Purkkeja ei löytynyt',
							'not_found_in_trash' => 'Purkkeja ei löytynyt roskakorista'
								);

	$args = array(
						'label' => 'purkit',
						'labels' => $labels,
						'description' => 'Saraste-kätköt, kavereiden kesken Sarastepurkit',
						'public' => true,
						'show_ui' => true,
						'show_in_menu' => true,
						'menu_position' => 20,
						'supports' => array('title', 'custom-fields', 'comments'),
						'has_archive' => true,
								);

	register_post_type('purkit', $args);
}

function purkit_taso($str){
	return "<span class=\"purkit_vaikeusaste " . strtolower($str) . "\">" . $str . "</span>";
}

function purkit_tahdet($x){
	$str = '';
	for($i = $x; $i > 0; $i--){
		$str .= '<a class="tahti2 sini"></a>';
	}
	for($i = 0; $i < 5 - $x; $i++){
		$str .= '<a class="tahti2"></a>';
	}
	return $str;
}

add_action('comment_post', 'purkit_comments_meta', 1);

function purkit_comments_meta($comment_id) {
	$comment = get_comment($comment_id);
	$post = $comment->comment_post_ID;

	if($_POST["status"] == 1) { //Löytyi
		add_comment_meta($comment_id, 'status', $_POST["status"], true);
		add_comment_meta($comment_id, 'lippukunta', $_POST['lpk'], true);
		add_comment_meta($comment_id, 'loytopvm', $_POST['loytopvm'], true);
		
		if($_POST["arvio"] == 0){
			wp_delete_comment($comment_id);
		} elseif($_POST["arvio"] < 6 && $_POST["arvio"] > 0){
			add_comment_meta($comment_id, 'arvio', $_POST['arvio'], true);
			purkit_rate_up($post, $_POST["arvio"]);
		}
	} elseif($_POST["status"] == 0){ // Ei löytynyt
		add_comment_meta($comment_id, 'loytopvm', $_POST['loytopvm'], true);
		add_comment_meta($comment_id, 'status', $_POST["status"], true);
	} else { //Pelkkä kommentti
		add_comment_meta($comment_id, 'status', $_POST["status"], true);
	}
}

function purkit_rate_up($post, $x){
	$arvio_vanha = get_post_meta($post, 'arvio', true);
	$maara_vanha = get_post_meta($post, 'arvio_maara', true);
	
	update_post_meta($post, 'arvio', $arvio_vanha + $x);
	update_post_meta($post, 'arvio_maara', $maara_vanha + 1);
}

add_action('trash_comment', 'purkit_rate_down', 1);

function purkit_rate_down($comment_id){
	$comment = get_comment($comment_id);
	$post = $comment->comment_post_ID;
	
	$x = get_comment_meta($comment_id, "arvio", true);
	
	$arvio_vanha = get_post_meta($post, 'arvio', true);
	$maara_vanha = get_post_meta($post, 'arvio_maara', true);
	
	update_post_meta($post, 'arvio', $arvio_vanha - $x);
	update_post_meta($post, 'arvio_maara', $maara_vanha - 1);
}

function purkit_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	
	$status = get_comment_meta(get_comment_ID(), "status", true);
	
	switch ($comment->comment_type) :
		case '' :
		
			if($status == 1){ // Löytyi
				$lpk = get_comment_meta(get_comment_ID(), "lippukunta", true);	
				$arvio = get_comment_meta(get_comment_ID(), "arvio", true);	
				$pvm = get_comment_meta(get_comment_ID(), "loytopvm", true);
				?>
				<div class="loyto">
					<p><strong><?php comment_author(); ?></strong> (<?php echo $lpk; ?>) löysi purkin <?php echo $pvm; ?></p>
					<div class="kommentti"><?php comment_text(); ?></div>
					<?php if(!empty($arvio)) { ?><div class="tahdet"><?php echo purkit_tahdet($arvio); ?></div><?php } ?>
				</div>
				<?php
			} elseif($status == 0){ // Ei löytynyt
				$pvm = get_comment_meta(get_comment_ID(), "loytopvm", true);
				?>
				<div class="loyto">
					<p><strong><?php comment_author(); ?></strong> ei löytänyt purkkia <?php echo $pvm; ?></p>
					<div class="kommentti"><?php comment_text(); ?></div>
				</div>
				<?php
			} else { // Pelkkä kommentti
				?>
				<div class="loyto">
					<p><strong><?php comment_author(); ?></strong> kommentoi <?php echo comment_date(); ?></p>
					<div class="kommentti"><?php comment_text(); ?></div>		
				</div>
				<?php
			}
			
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<?php
			break;
	endswitch;
}

?>