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
	<div class="visible-desktop">
		<h3>Facebook</h3>
		<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fsaraste2012&width=340&height=427&colorscheme=light&show_faces=false&border_color&stream=true&header=false&appId=350352811668809" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:340px; height:427px;" allowTransparency="true"></iframe>
	</div>
</aside>