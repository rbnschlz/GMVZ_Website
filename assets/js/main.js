(function($) {

	var example = function(){
	}

	var showArtist = function(){
		var artistMenu = $(".menu_artists");
		var artists = $(".menu_artist");
		var show = $(".home_show");
		var activeColor = $('.active').css('color');

		console.log(activeColor);

		var ArtistArray = [];
		artists.each(function() {
			var menuArtists = $(this).text().replace(/, /g, '');
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
				$('.menu_artists_temp').remove();
		    	$(show).siblings().children("img").removeClass('non_active_show');
		
				var outsideArray = [];
				$(showArtist).each(function () {
				var word = this.toString();
					artists.each(function () {
					activeArtist = $(this);
					var artistHtml = $(this).text().replace(/,/g, '');	

					if (artistHtml.indexOf(word) >= 0) { 
						activeArtist.css('color', activeColor);
						activeArtist.siblings().addClass('tempNonActive');
					} /*else if (ArtistArray.indexOf(word) <= 0) {
						outsideArray.push(word);
					}*/
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

			

		  	}, function() {
		    	$('.menu_artist').each(function () {
			    	$(this).css('color', '');
			    	$(this).removeClass('tempNonActive');
			    });

		    	// $('.menu_artists_temp').remove();
		    	// $(show).siblings().children("img").removeClass('non_active_show');
		 	});

		});
	}

	var artistsPreview = function(){
 		var artists = $('.menu_artist');

 		windhowHeight = $(window).height();
 		menuHeight = $('.menu_wrapper').height();
 		divHeight = windhowHeight - menuHeight - 125;
 		
 		$('.artists_image_container').height(divHeight);

 		artists.each(function () {
 		var attr = $(this).attr('data-style');
		var timer;
		var delay = 75;
		var artist = $(this);

	 		$(this).hover(function () {
	 			timer = setTimeout(function() {
	 			if (typeof attr !== typeof undefined && attr !== false) {
	 				$(artist).addClass('active');
	 				$(artist).siblings().removeClass('active');
	    			$(".artists_image_container").css('background-image', 'url(' + attr + ')');
				}		
	 		}, delay);
			}, function() {
			    clearTimeout(timer);
			});

 		});
  	}

  	var toggleArtistContent = function(){
  		var button = $(".artist_menu").children();
		
		button.click(function() {

			if(!$(this).hasClass("active")) {
				$(this).addClass("active");
				$(this).siblings("span").removeClass("active");

				if($(".artist_biography_button").hasClass("active")) {
				$(".artist_biography").toggleClass("hide");
				
				} else if ($(".artist_work_button").hasClass("active")) {
				$(".artist_thumb_wrap").toggleClass("hide");
				$(".artist_biography").toggleClass("hide");
				}

			} 
			
		});
	}

	//Slideshow
	var slideit= function(){
		$(document).on('click', ".zoomable", function(event) {
			var i = $(".zoomable").index(this);
			$(".artist_overlay_wrapper").addClass('active').addClass('ontop');
			$(".artist_overlay_wrapper").addClass('ontop');
			$(".overlay_slide").cycle({
				slides:"> div",
				timeout: 0,
				speed: 250,
				swipe: true,
				startingSlide: i
			});
			var first = $(".cycle-slide").first().children().first(); //Find first slide
                first.attr( 'style', first.attr('data-style') ); //Load background image
                first.removeAttr( 'data-style' ); //Clean up code
			var active = $(".cycle-slide-active").children().first(); //Find active slide
                active.attr( 'style', active.attr('data-style') ); //Load background image
                active.removeAttr( 'data-style' ); //Clean up code
            var next = $(".cycle-slide-active").next().children().first(); //Find next slide
                next.attr( 'style', next.attr('data-style') ); //Load background image
                next.removeAttr( 'data-style' ); //Clean up code
            var prev = $(".cycle-slide-active").prev().children().first(); //Find prev slide
                prev.attr( 'style', prev.attr('data-style') ); //Load background image
                prev.removeAttr( 'data-style' ); //Clean up code
		});

		$(document).on('click', '.artist_overlay_wrapper', function(event) {
			$(".artist_overlay_wrapper").removeClass('active');
			setTimeout(function() { 
				$('.artist_overlay_wrapper').removeClass('ontop'); 
				$('.overlay_slide').cycle('destroy');
			}, 250);
		});
	};


	//document ready
	$(document).ready(function(){
		artistsPreview();
		toggleArtistContent();
		slideit();
		// showArtist();

		var lastScroll = 0;
		var menuHeight = $(".main_wrapper").outerHeight() - $(".main_wrapper").children().height() ;
		console.log(menuHeight);
		var scrollhide = function(){ 
			$(window).scroll(function(){
				var scroll = $(window).scrollTop();
			    	if ((scroll > lastScroll) && (scroll > 100)) {
			    		if (!$(".menu_wrapper").hasClass("opacityzero")) {
			        		$(".menu_wrapper").addClass("opacityzero");
			        	}
			    	} else if (scroll < lastScroll) {
			        	if ($(".menu_wrapper").hasClass("opacityzero")) {
			        		$(".menu_wrapper").removeClass("opacityzero");
			        	}
			    	}
			    	lastScroll = scroll;
			});
		};
		setTimeout(function() { scrollhide(); }, 200);


	});

	$(window).resize(function(){
		artistsPreview();

	})


	//on load
/*	$(window).load(function(){
		
	});*/

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
