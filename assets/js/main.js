(function($) {

	var example = function(){
	}

	//Slideshow Loading
	$(document).on( 'cycle-initialized', function(e, opts) {
	    var key = 'cycle-look-ahead';
	    opts.container.on( 'cycle-before', function( e, opts, outgoing, incoming, fwd ) {
	        var index = fwd ? (opts.nextSlide + 1) : (opts.nextSlide - 1),
	            slide = $( opts.slides[ index ] ),
	            images;

	        if ( slide.length && ! slide.data( key ) ) {
	            slide.data( key, true );
	            images = slide.is( 'div[data-style]' ) ? slide : slide.find( 'div[data-style]' );
	            images.each(function() {
	                var img = $(this);
	                img.attr( 'style', img.attr('data-style') );
	                img.removeAttr( 'data-style' );
	            });
	        }
	    });
	});

	var showsCaption = function(){
		var showBlock = $(".shows_block");

		$(showBlock).each(function() {	
		var caption = $(this).children(".shows_block_caption");	
		var	date = caption.children(".shows_block_date");
		var	artists = caption.children(".shows_block_artists");
		var	image = $(this).find(".shows_block_thumb");
		var imageUrl = $(image).attr("zoom-image");
		var captionHeight = $(caption).height();
		var captionWidth = $(caption).width();

		// Zoom
		$(image).zoom({url: imageUrl});

		// Click for artist
		if(artists.length){
			$(caption).click(function() {
				date.toggleClass("hide");
				artists.toggleClass("hide");
			});
		}
			
		});	
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

	//Overlay Slideshow
	var slideit= function(){
		$(document).on('click', ".zoomable", function(event) {
			var i = $(".zoomable").index(this);
			$(".overlay_wrapper").addClass('active').addClass('ontop');
			$(".overlay_wrapper").addClass('ontop');
			$(".overlay_slide").cycle({
				slides:".overlay_slide_s",
				timeout: 0,
				speed: 50,
				swipe: true,
				startingSlide: i
			});
			var first = $(".cycle-slide").first().children().children().first(); //Find first slide
                first.attr( 'style', first.attr('data-style') ); //Load background image
                first.removeAttr( 'data-style' ); //Clean up code
			var active = $(".cycle-slide-active").children().children().first(); //Find active slide
                active.attr( 'style', active.attr('data-style') ); //Load background image
                active.removeAttr( 'data-style' ); //Clean up code
            var next = $(".cycle-slide-active").next().children().children().first(); //Find next slide
                next.attr( 'style', next.attr('data-style') ); //Load background image
                next.removeAttr( 'data-style' ); //Clean up code
            var prev = $(".cycle-slide-active").prev().children().children().first(); //Find prev slide
                prev.attr( 'style', prev.attr('data-style') ); //Load background image
                prev.removeAttr( 'data-style' ); //Clean up code
		});

		$(document).on('click', '.overlay_wrapper', function(event) {
			$(".overlay_wrapper").removeClass('active');
			setTimeout(function() { 
				$('.overlay_wrapper').removeClass('ontop'); 
				$('.overlay_slide').cycle('destroy');
			}, 250);
		});
	};

	var showPage= function(){
	
		var PrButton = $(".show_info_button");	
		var PrOverlay = $(".show_description_overlay");

		$(PrButton).click(function(){
			$(PrOverlay).addClass('active');
			$(PrOverlay).addClass('ontop'); 	
		});

		$(PrOverlay).click(function(){
			if($(PrOverlay).hasClass("active")) {
				$(PrOverlay).removeClass('active');
				$(PrOverlay).removeClass('ontop'); 
			} 
		});

	};

	var artistCycle = function(){
		$(".artist_artworks_container").cycle({
				slides:".artist_artworks_slide",
				prev: ".artist_artworks_prev",
				next: ".artist_artworks_next",
				timeout: 0,
				speed: 1,
				swipe: true,
				// startingSlide: i
		});

		$(document).on('click', '.sub_menu_works', function(event) {		
			$('.artist_artworks_container').addClass('active'); 
			$('.artist_artworks_container').addClass('ontop'); 
		});

		$(document).on('click', '.artist_artworks_end', function(event) {
			$(".artist_artworks_container").removeClass('active');
			$('.artist_artworks_container').removeClass('ontop'); 	
		});
		
	}


	// var shopCycle = function(){
	// 	$(".shop_object_img").each(function(){
	// 	var images = $(this).children("img");

	// 	$(this).cycle({
	// 				fx: "fade",
	// 				slides:".shop_object_img_s",
	// 				timeout: 0,
	// 				speed: 1,
	// 				swipe: true,
	// 				autoHeight: "container",
	// 				autoHeightSpeed: 0,
	// 	});

	// 	$(this).on( 'cycle-pre-initialize', function( ) {
	// 	     setTimeout(function(){ $(images).css('opacity','1') }, 65); 
	// 	});


	// 	$(this).click(function() {
	// 		if($(this).hasClass("border")) {
	// 			 $(this).removeClass("border");
	// 		}	
	// 		else if (!$(this).hasClass("border")) {
	// 			 $(this).cycle('next');

	// 			 // $(this).on('cycle-before',function( slideOptions, currEl, nextEl, fwdFlag ){
	// 				//  if(currEl.slideNum == 1){
	// 		  //         	$(this).addClass("border");
	// 		  //   	 }
	// 	   //  	 });

	// 	  //   	 if($(images).length === 1) {
	// 	  //   		$(this).addClass("border");
	// 			// }
	// 		}	

	// 	});	
	// });






	//document ready
	$(document).ready(function(){
		slideit();
		showPage();
		artistCycle();
		showsCaption();
		// shopCycle();
	});

	$(window).resize(function(){
	})

	$(document.documentElement).keyup(function (event) {
	    if (event.keyCode == 37) {
	    	$('.overlay_slide').cycle('prev');
        } else if (event.keyCode == 39) {
            $('.overlay_slide').cycle('next')
	    }
	    else if (event.keyCode == 27) {
            $(".overlay_wrapper").removeClass('active');
			setTimeout(function() { 
				$('.overlay_wrapper').removeClass('ontop'); 
				$('.overlay_slide').cycle('destroy');
			}, 250);
	    }
	});






})(jQuery);
