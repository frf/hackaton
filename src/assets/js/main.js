jQuery(document).ready(function($) {
	$('[data-toggle=offcanvas]').click(function() {
	    $('.row-offcanvas').toggleClass('active');
		$('.sidebar-offcanvas').toggleClass('active');
		$('.content').toggleClass('canvas-left');
	    $('.collapse-side').toggleClass('in').toggleClass('hidden-xs').toggleClass('visible-xs');
	});

	// Target your .container, .wrapper, .post, etc.
     $('iframe[src*="youtube"]').parent().fitVids();
	 $('#results').fitVids();
});
