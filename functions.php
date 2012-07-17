<?php

add_theme_support('post-thumbnails'); 
add_image_size('article-big', 580, 250);
add_image_size('article-small', 280, 120);
add_image_size('sidebar-thumb', 160, 100);

add_filter('excerpt_length', 'saraste_excerpt_length', 999);
function saraste_excerpt_length( $length ) {
	return 10;
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

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting('saraste_options', 'saraste_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page('Sivupalkki', 'Sivupalkki', 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}


/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>Sivupalkki</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div class="updated fade"><p><strong>Asetukset tallennettu.</strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields('saraste_options'); ?>
			<?php $options = get_option( 'saraste_theme_options' ); ?>

			<table class="form-table">
				<tr valign="top"><th scope="row">Nosto 1</th>
					<td>
						<input id="saraste_theme_options[nosto1_teksti]" class="regular-text" type="text" name="saraste_theme_options[nosto1_teksti]" value="<?php esc_attr_e($options['nosto1_teksti']); ?>" />
						<label class="description" for="saraste_theme_options[nosto1_teksti]">Teksti</label>
						<br/>
						<input id="saraste_theme_options[nosto1_linkki]" class="regular-text" type="text" name="saraste_theme_options[nosto1_linkki]" value="<?php esc_attr_e($options['nosto1_linkki']); ?>" />
						<label class="description" for="saraste_theme_options[nosto1_linkki]">Linkin osoite)</label>
						<br/>
						<input id="saraste_theme_options[nosto1_kuva]" class="regular-text" type="text" name="saraste_theme_options[nosto1_kuva]" value="<?php esc_attr_e($options['nosto1_kuva']); ?>" />
						<label class="description" for="saraste_theme_options[nosto1_kuva]">Kuvan osoite)</label>
					</td>
				</tr>
				<tr valign="top"><th scope="row">Nosto 2</th>
					<td>
						<input id="saraste_theme_options[nosto2_teksti]" class="regular-text" type="text" name="saraste_theme_options[nosto2_teksti]" value="<?php esc_attr_e($options['nosto2_teksti']); ?>" />
						<label class="description" for="saraste_theme_options[nosto2_teksti]">Teksti</label>
						<br/>
						<input id="saraste_theme_options[nosto2_linkki]" class="regular-text" type="text" name="saraste_theme_options[nosto2_linkki]" value="<?php esc_attr_e($options['nosto2_linkki']); ?>" />
						<label class="description" for="saraste_theme_options[nosto2_linkki]">Linkin osoite)</label>
						<br/>
						<input id="saraste_theme_options[nosto2_kuva]" class="regular-text" type="text" name="saraste_theme_options[nosto2_kuva]" value="<?php esc_attr_e($options['nosto2_kuva']); ?>" />
						<label class="description" for="saraste_theme_options[nosto2_kuva]">Kuvan osoite)</label>
					</td>
				</tr>
				<tr valign="top"><th scope="row">Blogi 1</th>
					<td>
						<input id="saraste_theme_options[blog1_teksti]" class="regular-text" type="text" name="saraste_theme_options[blogi1_teksti]" value="<?php esc_attr_e($options['blogi1_teksti']); ?>" />
						<label class="description" for="saraste_theme_options[blogi1_teksti]">Teksti</label>
						<br/>
						<input id="saraste_theme_options[blogi1_linkki]" class="regular-text" type="text" name="saraste_theme_options[blogi1_linkki]" value="<?php esc_attr_e($options['blogi1_linkki']); ?>" />
						<label class="description" for="saraste_theme_options[blogi1_linkki]">Linkin osoite)</label>
						<br/>
						<input id="saraste_theme_options[blogi1_kuva]" class="regular-text" type="text" name="saraste_theme_options[blogi1_kuva]" value="<?php esc_attr_e($options['blogi1_kuva']); ?>" />
						<label class="description" for="saraste_theme_options[blogi1_kuva]">Kuvan osoite)</label>
					</td>
				</tr>
				<tr valign="top"><th scope="row">Blogi 2</th>
					<td>
						<input id="saraste_theme_options[blogi2_teksti]" class="regular-text" type="text" name="saraste_theme_options[blogi2_teksti]" value="<?php esc_attr_e($options['blogi2_teksti']); ?>" />
						<label class="description" for="saraste_theme_options[blogi2_teksti]">Teksti</label>
						<br/>
						<input id="saraste_theme_options[blogi2_linkki]" class="regular-text" type="text" name="saraste_theme_options[blogi2_linkki]" value="<?php esc_attr_e($options['blogi2_linkki']); ?>" />
						<label class="description" for="saraste_theme_options[blogi2_linkki]">Linkin osoite)</label>
						<br/>
						<input id="saraste_theme_options[blogi2_kuva]" class="regular-text" type="text" name="saraste_theme_options[blogi2_kuva]" value="<?php esc_attr_e($options['blogi2_kuva']); ?>" />
						<label class="description" for="saraste_theme_options[blogi2_kuva]">Kuvan osoite)</label>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="Tallenna" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}

?>