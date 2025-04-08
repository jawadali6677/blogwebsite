(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$(".toggle-password").click(function() {

		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("toggle"));
		console.log(input.attr("type"));
		
		if (input.attr("type") == "password") {
		  input.attr("type", "text");
		  console.log(input.attr("type"));
		} else {
		  input.attr("type", "password");
		}
	  });

})(jQuery);
