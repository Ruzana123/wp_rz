/**
 * Functions and scripts related to the theme.
 */

            /*isotope*/
	$(document).ready(function() {

    $('.products').isotope({
        itemSelector: '.product'
    });

    $('#filter a').click(function(){

        $('#filter a').removeClass('current');
        $(this).addClass('current');
        var selector = $(this).attr('data-filter');

        $('.products').isotope({
            filter: selector,
            animationOptions: {
                duration: 1000,
                easing: 'easeOutQuart',
                queue: false
            }
        });
        return false;
	 
	        });
	 
	});