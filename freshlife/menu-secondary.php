<?php if ( has_nav_menu( 'secondary' ) ) : // Check if there's a menu assigned to the 'secondary' location. ?>
	
	<div id="secondary-bar" class="clearfix">

			<nav id="secondary-nav" class="main-navigation" role="navigation" <?php hybrid_attr( 'menu' ); ?>>

				<?php wp_nav_menu(
					array(
						'theme_location' => 'secondary',
						'container'      => false,
						'menu_id'        => 'secondary-menu',
						'menu_class'     => 'secondary-menu sf-menu',
						'walker'         => new Freshlife_Custom_Nav_Walker
					)
				); ?>

			</nav><!-- #secondary-nav -->

			<?php freshlife_header_social(); // Social icons. ?>

	</div>

<?php endif; // End check for menu. ?>