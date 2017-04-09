jQuery(document).ready(function($) {
	$('[data-toggle=offcanvas]').click(function() {
	    $('.row-offcanvas').toggleClass('active');
		$('.sidebar-offcanvas').toggleClass('active');
	    $('.collapse-side').toggleClass('in').toggleClass('hidden-xs').toggleClass('visible-xs');
	});

	$('input:-webkit-autofill').each(function(){
        var text = $(this).val();
        var name = $(this).attr('name');
        $(this).after(this.outerHTML).remove();
        $('input[name=' + name + ']').val(text);
    });


	if (navigator.userAgent.toLowerCase().indexOf('chrome') >= 0) {
		$(window).load(function(){
			$(':-webkit-autofill').each(function(){
				$(this).after(this.outerHTML).remove();
			});
		});
	}
});
