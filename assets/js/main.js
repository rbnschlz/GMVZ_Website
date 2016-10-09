(function($) {

	var example = function(){
	}

	var switchtoggle = function(){
		var artists = $(".menu_artist");
		$("#menu_switch_checkbox").click(function() {
			if ($('#menu_switch_checkbox').prop('checked')) {
				console.log("checked");
				artists.each(function() {
  					$(this).attr( 'href', $(this).attr('data-links'));
  					if($(this).hasClass('active')){
  						$(this).removeClass('active active-ph');
  					}
				});
				// window.location.href = window.location.href.split('?')[0];
				history.pushState("", document.title, window.location.pathname);
				$(".menu_time").css("display", "none");
				$(".menu_reset").css("display", "none");
			} else {
				console.log("unchecked");
				artists.each(function() {
  					$(this).attr( 'href', $(this).attr('data-filter'));
  					if($(this).hasClass('active')){
  						$(this).removeClass('active');
  					}
				});
				// if ($('#menu_switch_checkbox').hasClass("gohome")) {
					pathArray = location.href.split( '/' );
					protocol = pathArray[0];
					host = pathArray[2];
					url = protocol + '//' + host;
					window.location.href = url;
				// } else {
				// 	pathArray = location.href.split( '/' );
				// 	protocol = pathArray[0];
				// 	host = pathArray[2];
				// 	url = protocol + '//' + host;
				// 	window.location.href = url;
				// }
				$(".menu_time").css("display", "inline-block");
				$(".menu_reset").css("display", "block");
			}
		});
	}

	//document ready
	$(document).ready(function(){
		switchtoggle();
	});



	//on load
	$(window).load(function(){
		
	});

	//keypresses
	$(document).keydown(function(e) {
	    switch(e.which) {
	        case 37: // left
	        break;

	        case 38: // up
	        case 33: // page up
	        break;

	        case 39: // right
	        break;

	        case 40: // down
	        case 34: // page down
	        break;

	        case 36: // home
	        break;

	        case 35: // end
			break;

	        default: return; // exit this handler for other keys
	    }
	    e.preventDefault(); // prevent the default action (scroll / move caret)
	});

})(jQuery);
