<?php if ( post_password_required() ) : ?>
	<p class="alert"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyeleven' ); ?></p>
<?php
		return;
	endif;
?>

<?php // You can start editing here -- including this comment! ?>

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number('Ei kommentteja', '1 kommentti', '% kommenttia'); ?></h3>
	<?php wp_list_comments('type=comment&callback=saraste_comment'); ?>
<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="alert">Kommentointi on suljettu.</p>
<?php endif; ?>

<?php


$fields = array('author' => '<p><input type="text" id="author" name="author"><span class="help-inline">Nimi (pakollinen)</span></p>',
				'email' => '<p><input type="text" id="email" name="email"><span class="help-inline">Sähköposti (pakollinen, ei julkaista)</span></p>',
				'url' => '<p><input type="text" id="url" name="url"><span class="help-inline">Kotisivu</span></p>');

$args = array(	'fields' => $fields,
				'title_reply' => '',
				'comment_field' => '<textarea id="comment" name="comment"></textarea>',
				'comment_notes_after' => '',
				'comment_notes_before' => ''
			);
					
?>
<?php if (comments_open() && !is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<h3>Jätä kommentti</h3>
	<div class="well">
		<?php comment_form($args); ?>
	</div>
<?php endif; ?>
