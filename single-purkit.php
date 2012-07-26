<?php get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/purkit.css" />
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	function mapInit(){
		var options = {
			zoom: 10,
			center: new google.maps.LatLng(60.23163, 24.908752),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById("map_small"), options)
		
		var coord = jQuery(".hidden").text()
		coord = coord.split(",")
		
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(coord[0], coord[1]),
			map: map,
			title: jQuery("td:first-child", jQuery(this)).text(),
			clickable: false,
			icon: "<?php bloginfo('template_directory'); ?>/img/purkit/marker.png"
		})
	}
	
	jQuery(function(){
		mapInit()
	})
</script>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<article>
					<h2><?php the_title(); ?></h2>
					<p><?php echo get_post_meta(get_the_ID(), 'Kuvaus', true);	?></p>
					<?php
						$fields = array("Lippukunta", "Vaikeusaste", "Ohjeet");
						
						foreach($fields as $field){
							if(get_post_meta($post->ID, $field, true)){
								$meta = get_post_meta(get_the_ID(), $field, true);
								echo '<div class="span3 ' . $field . '">' . $field . '</div><div class="span7">' . ($field == "Vaikeusaste" ? purkit_taso($meta) : $meta) . '</div>';
							}
						}
						
						if(get_post_meta($post->ID, "Sijainti", true)){
							echo '<p class="meta"><span>Sijainti</span>';
							echo '<div id="map_container"><div id="map_small"></div></div></p>';
							echo '<span class="hidden">' . get_post_meta(get_the_ID(), "Sijainti", true) . '</span><div style="clear: both;"></div>';
						}
						
					?>
					
				<?php comments_template('/comments-purkit.php', true); ?>
<?php endwhile; ?>

<?php get_footer(); ?>