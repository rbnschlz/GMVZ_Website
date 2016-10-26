(function($) {

	var example = function(){
	}

	var showArtist = function(){
		var artistMenu = $(".menu_artists");
		var artists = $(".menu_artist");
		var show = $(".home_show");

		var ArtistArray = [];
		artists.each(function() {
			var menuArtists = $(this).text().toLowerCase();	
			ArtistArray.push(menuArtists);
		});
		// var ArtistArray = ArtistArray.toString();

		show.each(function() {
		var show = $(this);	
		var showArtist = $(this).attr('artist');
		var showArtist = showArtist.split(", ");	
		var showCaption = $(this).find('.home_show_caption span');
		var showImg = $(this).find('.img');


			$(this).hover(function() {
				var outsideArray = [];
				$(showArtist).each(function () {
				var word = this.toString();
					artists.each(function () {
					activeArtist = $(this);
					var artistHtml = $(this).text().toLowerCase();		
					if (artistHtml.indexOf(word) >= 0) { 
						activeArtist.addClass('active')  
					} else if (ArtistArray.indexOf(word) <= 0) {
						outsideArray.push(word);
					}
			    	});
				});

			  	var outsideArray = outsideArray.reverse();
			  	jQuery.each(outsideArray, function() {
				var outsideArray_once = this;
			  	var outsideArray_once_class = outsideArray_once.replace(/ /g, "")
			  	var temp_artist = '<span class="menu_artist menu_artists_temp '+outsideArray_once_class+'"><p>'+outsideArray_once+'</p></span>';
					if(typeof outsideArray_once !== "undefined" && $('.'+outsideArray_once_class+'').length === 0) {
					  $(temp_artist).insertAfter(artists.last());
					}
				});			

			  	// $(showImg).fadeTo(100, 0);

			    $(show).children("img").addClass('non_active_show');

			    if(show.children("img").hasClass('non_active_show')) {
			    	$(this).removeClass('non_active_show');
			    }

		  	}, function() {
			  	// $(showImg).fadeTo(50, 1);

		    	$('.menu_artist').each(function () {
			    	$(this).removeClass('active');
			    });

		    	$('.menu_artists_temp').remove();
		    	$(show).siblings().children("img").removeClass('non_active_show');
		    	
		    	// if (pastShow.hasClass('past_date')) {
			    // 	pastShow.fadeTo(200, 0)
			    // }
		 	});

		});
	}

	var switchtoggle = function(){
		// var artists = $(".menu_artist");
		// $("#menu_switch_checkbox").click(function() {
		// 	if ($('#menu_switch_checkbox').prop('checked')) {
		// 		artists.each(function() {
  // 					$(this).attr( 'href', $(this).attr('data-links'));
  // 					if($(this).hasClass('active')){
  // 						$(this).removeClass('active');
  // 					}
		// 		});
		// 		// window.location.href = window.location.href.split('?')[0];
		// 		history.pushState("", document.title, window.location.pathname);
		// 		$(".menu_time").css("display", "none");
		// 		$(".menu_reset").css("display", "none");
		// 		$(".home_show_wrap").css("display", "none");
		// 		$('.menu_switch_shows').removeClass('active');
		// 		$('.menu_switch_artists').addClass('active');
		// 	} else {
		// 		console.log("unchecked");
		// 		artists.each(function() {
  // 					$(this).attr( 'href', $(this).attr('data-filter'));
  // 					if($(this).hasClass('active')){
  // 						$(this).removeClass('active');
  // 					}
		// 		});
		// 		// if ($('#menu_switch_checkbox').hasClass("gohome")) {
		// 			pathArray = location.href.split( '/' );
		// 			protocol = pathArray[0];
		// 			host = pathArray[2];
		// 			url = protocol + '//' + host;
		// 			window.location.href = url;
		// 		// }
		// 		$(".menu_time").css("display", "inline-block");
		// 		$(".menu_reset").css("display", "block");
		// 		$('.menu_switch_shows').addClass('active');
		// 		$('.menu_switch_artists').removeClass('active');
		// 		// $(".home_show_wrap").css("display", "block");
		// 	}
		// });
	}

	//document ready
	$(document).ready(function(){
		switchtoggle();
		showArtist();
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
