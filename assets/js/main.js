(function($) {

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

	// var showPage= function(){
	
	// 	var PrButton = $(".show_info_button");	
	// 	var PrOverlay = $(".show_description_overlay");

	// 	// $(PrButton).click(function(){
	// 	$(document).on('click', PrButton, function(event) {
	// 		$(PrOverlay).addClass('active');
	// 		$(PrOverlay).addClass('ontop'); 	
	// 	});

	// 	// $(PrOverlay).click(function(){
	// 	$(document).on('click', PrOverlay, function(event) {	
	// 		if($(PrOverlay).hasClass("active")) {
	// 			$(PrOverlay).removeClass('active');
	// 			$(PrOverlay).removeClass('ontop'); 
	// 		} 
	// 	});

	// };

	var artistCycle = function(){
		$(".artist_artworks_container").cycle({
				slides:".artist_artworks_slide",
				prev: ".artist_artworks_prev",
				next: ".artist_artworks_next",
				timeout: 0,
				speed: 1,
				swipe: true,
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

	//Lazy Load
	// var wwwidth = $(window).width();
	// $(window).resize(function(){
	// 	var wwwidth = $(window).width()
	// })

	var lazy = function(){
		var win =  $(window).height()*1.5;
		var wwwidth = $(window).width();
		$('.lazy a span').unveil({
			offset: win,
			loaded: function () {
	        	var parent = $(this).parent();
	        	var caption = parent.siblings(".shows_block_caption");	
				var	date = caption.children(".shows_block_date");
				var	artists = caption.children(".shows_block_artists");
				var	image = $(this);
				var imageUrl = $(image).attr("zoom-image");

				//ZOOM
				if (wwwidth > 700) {
					$(image).zoom({
						url: imageUrl,
						touch: false
					});
				} else {
					$(image).trigger('zoom.destroy'); 
				}

				//Artist Names
				if(artists.length){
					$(caption).click(function() {
					// $(document).on('click', caption, function(event) {	
						date.toggleClass("hide");
						artists.toggleClass("hide");
					});
				}
	        }
		});
		$('.shop_object_img_s').unveil();
	}

	//Mail Shake
	var mailshake = function(){
		$('.mailform').submit(function() {
		    if ($.trim($(".email").val()) === "") {
		        $("#signup").addClass("shake");
		        setTimeout(function() {
					$("#signup").removeClass("shake");
				}, 500);
		        return false;
		    }
		});
	};

	//Random Margin
	var randommargin = function(){
		$(".home_link_wrapper_upc_d").each(function() {
  			var numRand = Math.floor(Math.random()*201);
  			var a = Math.random() * 50 - 5;
  			$(this).css({'left': numRand});
		});
	}

	//Z-index on hover
	var zindexhover = function(){
		if($(".home_show").length > 1) {
			$(".home_show").each(function() {
  				var zindex = $(this).css("z-index");
  				var shows = $(".home_show").length;
  				var zindexplus = zindex + 1;

  				var title = $(this).attr("show");

  				$(this).hover (function () {
	                  $(this).css({"z-index": zindexplus});
	                  $(this).siblings(".home_show").css({"z-index": ""});

	                  $(".home_link").each(function(){
	                  	var text = $(this).text();
	                  	if(text === title) {
	                  		$(this).addClass("active");
	                  	} else {
	                  		$(this).removeClass("active");
	                  	}
	                  });
	            });

			});

		}
		
	}

	// PJAX
	var options = {
			url: $(this).attr("href"),
			fragment: '#pjax_wrapper',
			timeout: false
	};

	$(document).pjax('.pjax', '#pjax_wrapper', options);

	$(document).on('pjax:end', function(something, options) {

		if ($(".artist_artworks_container").length) {
			artistCycle();
		}
		if ($(".zoomable").length) {
			slideit();
		}
		if ($('.mailform').length) {
			mailshake();
		}
		if ($('.shows_wrap').length || $(".shop_wrapper").length) {
			lazy();
		}
		
		// showPage();
		randommargin();
	});

	//document ready
	$(document).ready(function(){
		if ($(".artist_artworks_container").length) {
			artistCycle();
		}
		if ($(".zoomable").length) {
			slideit();
		}
		if ($('.mailform').length) {
			mailshake();
		}
		if ($('.shows_wrap').length || $(".shop_wrapper").length) {
			lazy();
		}
		
		// showPage();
		randommargin();
		zindexhover();
	});

	$(window).resize(function(){
		lazy();
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
