<?php $opt = get_option('saraste_theme_options');	?>

<aside>
	<div class="featured">
		<div>
			<a href="#"><img src="<?php echo $opt["nosto1_kuva"]; ?>" alt=""></a>
			<a href="<?php echo $opt["nosto1_teksti"]; ?>"><h3><?php echo $opt["nosto1_teksti"]; ?></h3></a>
		</div>
		<div>
			<a href="#"><img src="<?php echo $opt["nosto2_kuva"]; ?>" alt=""></a>
			<a href="<?php echo $opt["nosto2_teksti"]; ?>"><h3><?php echo $opt["nosto2_teksti"]; ?></h3></a>
		</div>
	</div>
	<h2>Live</h2>
	<a href="#"><img src="http://placehold.it/340x225" alt=""></a>
	<h2>Blogit</h2>
	<div class="featured">
		<div>
			<a href="#"><img src="<?php echo $opt["blogi1_kuva"]; ?>" alt=""></a>
			<a href="<?php echo $opt["blogi1_teksti"]; ?>"><h3><?php echo $opt["blogi1_teksti"]; ?></h3></a>
		</div>
		<div>
			<a href="#"><img src="<?php echo $opt["blogi2_kuva"]; ?>" alt=""></a>
			<a href="<?php echo $opt["blogi2_teksti"]; ?>"><h3><?php echo $opt["blogi2_teksti"]; ?></h3></a>
		</div>
	</div>
	<div>
		<h3>Facebook</h3>
		<img src="http://placehold.it/340x400/3b5998/ffffff">
	</div>
</aside>