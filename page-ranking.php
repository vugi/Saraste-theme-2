<?php get_header(); ?>
<article>
<h2>Ranking</h2>
<?php
$query = "SELECT $wpdb->commentmeta.meta_value AS nimi, COUNT(DISTINCT $wpdb->comments.comment_post_ID) AS maara
					FROM $wpdb->commentmeta, $wpdb->comments, $wpdb->postmeta
					WHERE $wpdb->comments.comment_approved = '1'
						AND $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
						AND $wpdb->commentmeta.meta_key = 'lippukunta'
						AND $wpdb->postmeta.post_id = $wpdb->comments.comment_post_ID
						AND $wpdb->postmeta.meta_key = 'Lippukunta'
						AND $wpdb->postmeta.meta_value != $wpdb->commentmeta.meta_value
					GROUP BY $wpdb->commentmeta.meta_value
					ORDER BY maara DESC
					LIMIT 10";
					
$lpkt = $wpdb->get_results($query);

$i = $i2 = 1;

if($lpkt){
	echo '<h3>Eniten kätköjä löytäneet lippukunnat</h3><ol>';
	foreach($lpkt as $lpk){
		if($lpk->maara < $i2){
			$i++;
		}
		echo '<li value="' . $i . '">' . $lpk->nimi . ' (' . $lpk->maara . ')</li>';
		$i2 = $lpk->maara;
	}
	echo '</ol>';
}

$query = "SELECT purkki, ID, AVG(_avg) AS __avg
					FROM
					(
						SELECT $wpdb->posts.post_title AS purkki, $wpdb->posts.ID, $wpdb->commentmeta.meta_value AS lpk, AVG(stars.meta_value) AS _avg
						FROM $wpdb->posts, $wpdb->comments, $wpdb->commentmeta,
						(
							SELECT meta_value, comment_id 
							FROM $wpdb->commentmeta
							WHERE meta_key = 'arvio'
						) AS stars
						WHERE $wpdb->posts.ID = $wpdb->comments.comment_post_ID
						AND $wpdb->comments.comment_id = $wpdb->commentmeta.comment_id
						AND $wpdb->posts.post_type = 'purkit'
						AND $wpdb->comments.comment_approved = 1
						AND $wpdb->commentmeta.meta_key = 'lippukunta'
						AND stars.comment_id = $wpdb->comments.comment_id
						GROUP BY $wpdb->posts.post_title, $wpdb->commentmeta.meta_value
					) AS purkit
					GROUP BY purkki
					ORDER BY __avg DESC
					LIMIT 10";
					
$purkit = $wpdb->get_results($query);

if($purkit){
	echo '<h3>Parhaiten arvioidut kätköt</h3><ol>';
	foreach($purkit as $p){
		echo '<li><a href="' . get_permalink($p->ID) . '">' . $p->purkki . '</a></li>';
	}
	echo '</ol>';
}

?>
</article>
<?php get_footer(); ?>