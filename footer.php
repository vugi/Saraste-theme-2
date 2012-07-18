	<?php get_sidebar(); ?>
</section>
		
		<footer>
			<section id="sitemap">
				<h3>Sivukartta</h3>
				<?php wp_nav_menu(
					array(
						'theme_location' => 'nav',
						'container' => false,
						'menu_class' => 'footer-nav',
						'depth' => 2
						)
					);
				?>
			</section>
			<section id="contact">
				<address>
					<p>
						Osoite 1, Osoite 2 |
						Puhelinnumero |
						Sähköposti | 
						<a href="#">Palautelomake</a>
					</p>
				</address>
				<a href="http://www.paakaupunkiseudunpartiolaiset.fi" target="_blank"><img src="<?php bloginfo( 'template_directory' ); ?>/img/papa-logo.png" alt="Pääkaupunkiseudun Partiolaiset ry"></a>	
			</section>
		</footer>
	</div>
	<?php wp_footer(); ?>
</body>
</html>