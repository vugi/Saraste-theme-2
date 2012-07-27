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


$fields = array('author' => '<p><label>Nimi</label><input type="text" id="author" name="author" required="required"><span class="help-inline">(pakollinen)</span></p>',
				'email' => '<p><label>Sähköposti</label><input type="email" id="email" name="email" required="required"><span class="help-inline">(pakollinen, ei julkaista)</span></p>',
				'url' => '<p><label>Kotisivu</label><input type="url" id="url" name="url"></p>');

$args = array(	'fields' => $fields,
				'title_reply' => '',
				'comment_field' => '<textarea id="comment" name="comment" required="required" placeholder="Kommentti..."></textarea>',
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
