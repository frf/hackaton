jQuery(document).ready(function($) {

	// Open and CLose sidebar

	$('[data-toggle=offcanvas]').click(function() {
		$('.row-offcanvas').toggleClass('active');
		$('.sidebar-offcanvas').toggleClass('active');
		$('.content').toggleClass('canvas-left');
	});


	
});
