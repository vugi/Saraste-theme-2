	<?php get_sidebar(); ?>
</section>
		
		<footer>
			<section id="sitemap">
				<h3>Sivukartta</h3>
				<?php wp_nav_menu(
												array(
													'theme_location' => 'nav',
													'container' => false,
													'menu_class' => 'nav',
													'depth' => 2,
													'walker' => new bootstrap_menu()
													)
												);
								?>
			</section>
			<div>
				<address>
					<h3>Yhteystiedot</h3>
					<p>Osoite 1<br>Osoite 2</p>
					<p>Näin lähetät postia leirille</p>
					<p>Puhelinnumero</p>
					<p>Sähköposti</p>
					<p><a href="#">Palautelomake</a></p>
				</address>
				<a href="http://www.paakaupunkiseudunpartiolaiset.fi" target="_blank"><img src="<?php bloginfo( 'template_directory' ); ?>/img/papa-logo.png" alt="Pääkaupunkiseudun Partiolaiset ry"></a>	
			</div>
		</footer>
	</div>
	<?php wp_footer(); ?>
</body>
</html>