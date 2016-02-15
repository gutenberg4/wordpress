<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>

	<div id="primary-bar">

			<nav id="primary-nav" class="main-navigation" role="navigation" <?php hybrid_attr( 'menu' ); ?>>

				<?php wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'primary-menu sf-menu',
						'walker'         => new Freshlife_Custom_Nav_Walker
					)
				); ?>

			</nav><!-- #primary-nav -->

			<div class="header-search">
				<form method="get" class="searchform" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
					<input type="search" class="search-field field" placeholder="<?php echo esc_attr_x( 'Press enter to search &hellip;', 'placeholder', 'freshlife' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'freshlife' ) ?>" />
					<button name="search" id="search"><i class="fa fa-search"></i></button>
				</form>
			</div>

	</div>

<?php endif; // End check for menu. ?>