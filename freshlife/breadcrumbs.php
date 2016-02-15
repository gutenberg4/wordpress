<div id="breadcrumbs">

	<?php if ( function_exists( 'breadcrumb_trail' ) ) : // Check for breadcrumb support. ?>
		<?php breadcrumb_trail(
			array(
				'separator'     => '<i class="fa fa-caret-right"></i>',
				'post_taxonomy' => array(
				'post' => 'category'
				),
				'show_browse'   => false,
				'show_on_front' => false,
			) 
		); ?>
	<?php endif; // End check for breadcrumb support. ?>

</div>