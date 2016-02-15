<?php
// Return early if no widget found.
if ( ! is_active_sidebar( 'primary' ) ) {
	return;
}

// Return early if user uses 1 column layout.
if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
	return;
}
?>

<div id="secondary" class="widget-area widget-primary sidebar" role="complementary" aria-label="<?php echo esc_attr_x( 'Primary Sidebar', 'Sidebar aria label', 'freshlife' ); ?>" <?php hybrid_attr( 'sidebar', 'primary' ); ?>>
	<?php dynamic_sidebar( 'primary' ); ?>
</div><!-- #secondary -->