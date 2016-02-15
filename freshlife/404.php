<?php get_header(); ?>

	<main id="main" class="site-main clearfix" role="main" <?php hybrid_attr( 'content' ); ?>>
		<div id="primary" class="content-area">

			<section class="error-404 not-found">

				<h1 class="page-title"><?php _e( '404 - Page Not found', 'freshlife' ); ?></h1>

				<div class="entry-content">
					<p><?php _e( 'We\'re sorry, but we can\'t find the page you were looking for. It\'s probably some thing we\'ve done wrong but now we know about it and we\'ll try to fix it.', 'freshlife' ); ?></p>
					<ul>
						<li><a href="javascript: history.go(-1);"><?php _e( 'Go to Previous Page', 'freshlife' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Go to Homepage', 'freshlife' ); ?></a></li>
					</ul>
				</div><!-- .page-content -->

			</section><!-- .error-404 -->

		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</main><!-- #main -->

<?php get_footer(); ?>