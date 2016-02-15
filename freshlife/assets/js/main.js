// Global jQuery variable
$ = jQuery;

/**
 * Responsive Video
 */
var fitvidsInit = function() {
	var $selector = $( ".hentry, .widget" );
	$selector.fitVids();
};

/**
 * Superfish
 */
var superfishInit = function() {
	var $selector = $( "ul.sf-menu" );
	$selector.superfish( {
		delay: 100,
		speed: "fast",
		autoArrows: false
	} );
};

/**
 * Tabs
 */
var tabsInit = function() {
	var $tabsNav    = $( ".tabs-nav" ),
		$tabsNavLis = $tabsNav.children( "li" ),
		$tabContent = $( ".tab-content" );

	$tabsNav.each( function() {
		var $this = $( this );
		$this.next().children( ".tab-content" ).stop( true,true ).hide().first().show();
		$this.children( "li" ).first().addClass( "active" ).stop( true, true ).show();
	} );

	$tabsNavLis.on( "click", function( event ) {
		event.preventDefault();

		var $this = $( this );
		$this.siblings().removeClass( "active" ).end().addClass( "active" );
		$this.parent().next().children( ".tab-content" ).stop( true, true ).hide().siblings( $this.find( "a" ).attr( "href" ) ).fadeIn();
	});

};

/**
 * Flexslider
 */
var flexsliderInit = function() {
	var $selector = $( ".flexslider" );
	$selector.flexslider({
		animation: "slide",
		prevText: "",
		nextText: "",
		start: function( slider ){
			$( "body" ).removeClass( "loading" );
		}
	});
};

/**
 * Execute after DOM ready.
 */
$( function() {
	fitvidsInit();
	superfishInit();
	tabsInit();
} );

/**
 * Execute on window load.
 */
$( window ).load( function() {
	flexsliderInit();
} );