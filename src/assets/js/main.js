jQuery(document).ready(function($) {
	$('[data-toggle=offcanvas]').click(function() {
	    $('.row-offcanvas').toggleClass('active');
		$('.sidebar-offcanvas').toggleClass('active');
	    $('.collapse-side').toggleClass('in').toggleClass('hidden-xs').toggleClass('visible-xs');
	});
});
