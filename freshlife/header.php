<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php hybrid_attr( 'body' ); ?>>

<div id="page" class="container hfeed site clearfix">

	<header id="masthead" class="site-header" role="banner" <?php hybrid_attr( 'header' ); ?>>

		<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

		<div class="site-branding clearfix">
				<?php freshlife_site_branding(); // Display the site title/logo. ?>
				<?php freshlife_header_ad(); // Display banner/ad in header. ?>
		</div>

		<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>

	</header><!-- #masthead -->

	<div id="site-content" class="site-content">
