jQuery(document).ready(function($) {
    $('.tax-filter').click( function(event) {

        //Remove all selected class
        $('.selected').removeClass('selected');

		// Prevent default action - opening tag page
		if (event.preventDefault) {
			event.preventDefault();
		} else {
			event.returnValue = false;
		}

		// Get tag slug from title attribute
		var selected_taxonomy = $(this).attr('title');

		$('.tagged-posts').fadeOut();


		data = {
			action: 'filter_posts',
			afp_nonce: afp_vars.afp_nonce,
			taxonomy: selected_taxonomy,
		};

        $.ajax({
            type: 'post',
            dataType: 'html',
            url: afp_vars.afp_ajax_url,
            data: data,
            success: function( data, textStatus, XMLHttpRequest ) {
                $('.tagged-posts').html( data );
                $('.tagged-posts').fadeIn();
                console.log( "test" );
                console.log( textStatus );
                console.log( XMLHttpRequest );
            },
            error: function( MLHttpRequest, textStatus, errorThrown ) {
                console.log( MLHttpRequest );
                console.log( "textStatus: " + textStatus );
                console.log( "errorThrown: " + errorThrown );
                $('.tagged-posts').html( ' No posts found ' );
                $('.tagged-posts').fadeIn();
            }
        })

	});
});