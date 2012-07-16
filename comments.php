<?php if ( post_password_required() ) : ?>
	<p class="alert"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyeleven' ); ?></p>
<?php
		return;
	endif;
?>

<?php // You can start editing here -- including this comment! ?>

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number('Ei kommentteja', '1 kommentti', '% kommenttia'); ?></h3>
	<?php wp_list_comments(
						array(
							'style' => 'div',
							'type' => 'comment',
							'avatar_size' => 50,
							'callback' => 'saraste_comment'
							)
						);	?>

<?php
	/* If there are no comments and comments are closed, let's leave a little note, shall we?
	 * But we don't want the note on pages or post types that do not support comments.
	 */
	elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="alert">Kommentointi on suljettu.</p>
<?php endif; ?>

<?php comment_form(
				array(
					'author' => '<input type="text" id="author" name="author"><span class="help-inline">Nimi (pakollinen)</span>',
					'email' => '<input type="text" id="email" name="email"><span class="help-inline">Sähköposti (pakollinen, ei julkaista)</span>',
					'url' => '<input type="text" id="url" name="url"><span class="help-inline">Kotisivu</span>',
					'comment_field' => '<textarea id="comment" name="comment"></textarea>',
					'comment_notes_after' => ''
					)
				); 
?>

