/* Validation form */
validateForm('validation-newsletter');
if(CARTSITE==true) validateForm('validation-cart');
// validateForm('validation-user');
validateForm('validation-contact');
/* Lazys */
NN_FRAMEWORK.Lazys = function () {
	if (isExist($('.lazy'))) {
		var lazyLoadInstance = new LazyLoad({
			elements_selector: '.lazy'
		});
	}
};
NN_FRAMEWORK.Filter = function(){
    function filterProduct() {
        HoldOn.open({
            theme:"sk-bounce",
            message:'Vui lòng chờ tí ...'
        });
        var link = '?filter_active=1';
        const filter1 = [];
        const filter2 = [];
        const filter3 = [];
        if($('#filter_sort_choose li a.checked').data('id')!=undefined) {
            link = link + '&sort=' + $('#filter_sort_choose li a.checked').data('id');
        }
        $('#filter_os_choose a').each(function(index, el) {
        	if($(this).hasClass('checked')) {
        		filter1.push($(this).data('id'));
        	}
        });
        $('#filter_size_choose a').each(function(index, el) {
        	if($(this).hasClass('checked')) {
        		filter2.push($(this).data('id'));
        	}
        });
        $('#filter_color_choose a').each(function(index, el) {
        	if($(this).hasClass('checked')) {
        		filter3.push($(this).data('id'));
        	}
        });
        link += '&brand='+filter1.join()+'&size='+filter2.join()+'&color='+filter3.join();
        var current_link = window.location.href.split("?");
        setTimeout(() => {
            HoldOn.close();
            window.location.href = current_link[0] + link;
        }, 1000)
    }
    $(document).on('click', '#filter_sort_choose li a', function(event) {
        event.preventDefault();
        if($(this).hasClass('checked')) {
            $(this).parents('ul').find('a').removeClass('checked');
        }
        else {
            $(this).parents('ul').find('a').removeClass('checked');
            $(this).addClass('checked');
        }
        filterProduct();
        return false;
    });
    $(document).on('click', '#filter_os_choose li a, #filter_size_choose li a, #filter_color_choose li a', function(event) {
        event.preventDefault();
        $(this).toggleClass('checked');
        filterProduct();
        return false;
    });
    $(document).on('click', '.filter_block .filter_title', function(event) {
        event.preventDefault();
        $(this).parents('.filter_block').find('ul').toggle();
        return false;
    });
};
NN_FRAMEWORK.AutocompleteSeach = function(){
    $(document).on('keyup', '#keyword', function(event) {
        event.preventDefault();
        if($(this).val().length > 0) {
            $.ajax({
                url: 'api/autocomplete.php',
                type: 'post',
                data: {keyword: $(this).val()},
            })
            .done(function(rs) {
                $('.keyword-autocomplete').html(rs);
                $('.keyword-autocomplete').show();
            });
        }
        else {
            $('.keyword-autocomplete').hide();
        }
    });
};
/* Load name input file */
NN_FRAMEWORK.loadNameInputFile = function () {
	if (isExist($('.custom-file input[type=file]'))) {
		$('body').on('change', '.custom-file input[type=file]', function () {
			var fileName = $(this).val();
			fileName = fileName.substr(fileName.lastIndexOf('\\') + 1, fileName.length);
			$(this).siblings('label').html(fileName);
		});
	}
};
/* Back to top */
NN_FRAMEWORK.GoTop = function () {
	$(window).scroll(function () {
		if (!$('.scrollToTop').length)
			$('body').append('<div class="scrollToTop"><img src="' + GOTOP + '" alt="Go Top"/></div>');
		if ($(this).scrollTop() > 100) $('.scrollToTop').fadeIn();
		else $('.scrollToTop').fadeOut();
	});
	$('body').on('click', '.scrollToTop', function () {
		$('html, body').animate({ scrollTop: 0 }, 800);
		return false;
	});
};
/* Alt images */
NN_FRAMEWORK.AltImg = function () {
	$('img').each(function (index, element) {
		if (!$(this).attr('alt') || $(this).attr('alt') == '') {
			$(this).attr('alt', WEBSITE_NAME);
		}
	});
};
/* Menu */
NN_FRAMEWORK.Menu = function () {
	/* Menu remove empty ul */
	if (isExist($('.menu'))) {
		$('.menu ul li a').each(function () {
			$this = $(this);
			if (!isExist($this.next('ul').find('li'))) {
				$this.next('ul').remove();
				$this.removeClass('has-child');
			}
		});
	}
	/* Mmenu */
	if (isExist($('nav#menu'))) {
		var content_menu = $('.menu-main').html();
		if(content_menu!='') {
			$('nav#menu > ul').html(content_menu);
			$('nav#menu > ul').find('.menu-line').remove();
			$('nav#menu > ul').find('.search').remove();
		}
		$('nav#menu').mmenu({
			extensions: ['border-full', 'position-left', 'position-front']
		});
	}
};
/* Tools */
NN_FRAMEWORK.Tools = function () {
	if (isExist($('.toolbar'))) {
		$('.footer').css({ marginBottom: $('.toolbar').innerHeight() });
	}
};
/* Popup */
NN_FRAMEWORK.Popup = function () {
	if (isExist($('#popup'))) {
		$('#popup').modal('show');
	}
};
/* Wow */
NN_FRAMEWORK.Wows = function () {
	new WOW().init();
};
/* Pagings */
NN_FRAMEWORK.Pagings = function () {
	/* Products */
	if (isExist($('.paging-product'))) {
		loadPaging('api/product.php?perpage=8', '.paging-product');
	}
	/* Categories */
	if (isExist($('.paging-product-category'))) {
		$('.paging-product-category').each(function () {
			var list = $(this).data('list');
			loadPaging('api/product.php?perpage=8&idList=' + list, '.paging-product-category-' + list);
		});
	}
};
/* Ticker scroll */
/*NN_FRAMEWORK.TickerScroll = function () {
	if (isExist($('.news-scroll'))) {
		$('.news-scroll')
			.easyTicker({
				direction: 'up',
				easing: 'swing',
				speed: 'slow',
				interval: 3500,
				height: 'auto',
				visible: 3,
				mousePause: true,
				controls: {
					up: '.news-control#up',
					down: '.news-control#down'
				},
				callbacks: {
					before: function (ul, li) {},
					after: function (ul, li) {}
				}
			})
			.data('easyTicker');
	}
};*/
/* Photobox */
NN_FRAMEWORK.Photobox = function () {
	if (isExist($('.album-gallery'))) {
		$('.album-gallery').photobox('a', { thumbs: true, loop: false });
	}
};
/* Comment */
NN_FRAMEWORK.Comment = function () {
	if (isExist($('.comment-page'))) {
		$('.comment-page').comments({
			url: 'api/comment.php'
		});
	}
};
/* DatePicker */
NN_FRAMEWORK.DatePicker = function () {
	if (isExist($('#birthday'))) {
		$('#birthday').datetimepicker({
			timepicker: false,
			format: 'd/m/Y',
			formatDate: 'd/m/Y',
			minDate: '01/01/1950',
			maxDate: TIMENOW
		});
	}
};
/* Search */
NN_FRAMEWORK.Search = function () {
	if (isExist($('.icon-search'))) {
		$('.icon-search').click(function () {
			if ($(this).hasClass('active')) {
				$(this).removeClass('active');
				$('.search-grid').stop(true, true).animate({ opacity: '0', width: '0px' }, 200);
			} else {
				$(this).addClass('active');
				$('.search-grid').stop(true, true).animate({ opacity: '1', width: '230px' }, 200);
			}
			document.getElementById($(this).next().find('input').attr('id')).focus();
			$('.icon-search i').toggleClass('fa fa-search fa fa-times');
		});
	}
};
/* Videos */
NN_FRAMEWORK.Videos = function () {
	if (isExist($('[data-fancybox="video"]'))) {
		$('[data-fancybox="video"]').fancybox({
			transitionEffect: 'fade',
			transitionDuration: 800,
			animationEffect: 'fade',
			animationDuration: 800,
			arrows: true,
			infobar: false,
			toolbar: true,
			hash: false
		});
	}
};
/* Owl Data */
NN_FRAMEWORK.OwlData = function (obj) {
	if (!isExist(obj)) return false;
	var items = obj.attr('data-items');
	var rewind = Number(obj.attr('data-rewind')) ? true : false;
	var autoplay = Number(obj.attr('data-autoplay')) ? true : false;
	var loop = Number(obj.attr('data-loop')) ? true : false;
	var lazyLoad = Number(obj.attr('data-lazyload')) ? true : false;
	var mouseDrag = Number(obj.attr('data-mousedrag')) ? true : false;
	var touchDrag = Number(obj.attr('data-touchdrag')) ? true : false;
	var animations = obj.attr('data-animations') || false;
	var smartSpeed = Number(obj.attr('data-smartspeed')) || 800;
	var autoplaySpeed = Number(obj.attr('data-autoplayspeed')) || 800;
	var autoplayTimeout = Number(obj.attr('data-autoplaytimeout')) || 5000;
	var dots = Number(obj.attr('data-dots')) ? true : false;
	var responsive = {};
	var responsiveClass = true;
	var responsiveRefreshRate = 200;
	var nav = Number(obj.attr('data-nav')) ? true : false;
	var navContainer = obj.attr('data-navcontainer') || false;
	var navTextTemp =
		"<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-arrow-narrow-left' width='50' height='37' viewBox='0 0 24 24' stroke-width='1' stroke='#ffffff' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='5' y1='12' x2='19' y2='12' /><line x1='5' y1='12' x2='9' y2='16' /><line x1='5' y1='12' x2='9' y2='8' /></svg>|<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-arrow-narrow-right' width='50' height='37' viewBox='0 0 24 24' stroke-width='1' stroke='#ffffff' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='5' y1='12' x2='19' y2='12' /><line x1='15' y1='16' x2='19' y2='12' /><line x1='15' y1='8' x2='19' y2='12' /></svg>";
	var navText = obj.attr('data-navtext');
	navText =
		nav &&
		navContainer &&
		(((navText === undefined || Number(navText)) && navTextTemp) ||
			(isNaN(Number(navText)) && navText) ||
			(Number(navText) === 0 && false));
	if (items) {
		items = items.split(',');
		if (items.length) {
			var itemsCount = items.length;
			for (var i = 0; i < itemsCount; i++) {
				var options = items[i].split('|'),
					optionsCount = options.length,
					responsiveKey;
				for (var j = 0; j < optionsCount; j++) {
					const attr = options[j].indexOf(':') ? options[j].split(':') : options[j];
					if (attr[0] === 'screen') {
						responsiveKey = Number(attr[1]);
					} else if (Number(responsiveKey) >= 0) {
						responsive[responsiveKey] = {
							...responsive[responsiveKey],
							[attr[0]]: (isNumeric(attr[1]) && Number(attr[1])) ?? attr[1]
						};
					}
				}
			}
		}
	}
	if (nav && navText) {
		navText = navText.indexOf('|') > 0 ? navText.split('|') : navText.split(':');
		navText = [navText[0], navText[1]];
	}
	obj.owlCarousel({
		rewind,
		autoplay,
		loop,
		lazyLoad,
		mouseDrag,
		touchDrag,
		smartSpeed,
		autoplaySpeed,
		autoplayTimeout,
		dots,
		nav,
		navText,
		navContainer: nav && navText && navContainer,
		responsiveClass,
		responsiveRefreshRate,
		responsive
	});
	if (autoplay) {
		obj.on('translate.owl.carousel', function (event) {
			obj.trigger('stop.owl.autoplay');
		});
		obj.on('translated.owl.carousel', function (event) {
			obj.trigger('play.owl.autoplay', [autoplayTimeout]);
		});
	}
	if (animations && isExist(obj.find('[owl-item-animation]'))) {
		var animation_now = '';
		var animation_count = 0;
		var animations_excuted = [];
		var animations_list = animations.indexOf(',') ? animations.split(',') : animations;
		obj.on('changed.owl.carousel', function (event) {
			$(this).find('.owl-item.active').find('[owl-item-animation]').removeClass(animation_now);
		});
		obj.on('translate.owl.carousel', function (event) {
			var item = event.item.index;
			if (Array.isArray(animations_list)) {
				var animation_trim = animations_list[animation_count].trim();
				if (!animations_excuted.includes(animation_trim)) {
					animation_now = 'animate__animated ' + animation_trim;
					animations_excuted.push(animation_trim);
					animation_count++;
				}
				if (animations_excuted.length == animations_list.length) {
					animation_count = 0;
					animations_excuted = [];
				}
			} else {
				animation_now = 'animate__animated ' + animations_list.trim();
			}
			$(this).find('.owl-item').eq(item).find('[owl-item-animation]').addClass(animation_now);
		});
	}
};
/* Owl Page */
NN_FRAMEWORK.OwlPage = function () {
	if (isExist($('.owl-page'))) {
		$('.owl-page').each(function () {
			NN_FRAMEWORK.OwlData($(this));
		});
	}
};
/* Dom Change */
NN_FRAMEWORK.DomChange = function () {
	/* Video Fotorama */
	$('#video-fotorama').one('DOMSubtreeModified', function () {
		$('#fotorama-videos').fotorama();
	});
	/* Video Select */
	$('#video-select').one('DOMSubtreeModified', function () {
		$('.listvideos').change(function () {
			var id = $(this).val();
			$.ajax({
				url: 'api/video.php',
				type: 'POST',
				dataType: 'html',
				data: {
					id: id
				},
				beforeSend: function () {
					HoldOn.open({
            theme:"sk-bounce",
            message:'Vui lòng chờ tí ...'
			        });
				},
				success: function (result) {
					$('.video-main').html(result);
					holdonClose();
				}
			});
		});
	});
	/* Chat Facebook */
	$('#messages-facebook').one('DOMSubtreeModified', function () {
		$('.js-facebook-messenger-box').on('click', function () {
			$('.js-facebook-messenger-box, .js-facebook-messenger-container').toggleClass('open'),
				$('.js-facebook-messenger-tooltip').length && $('.js-facebook-messenger-tooltip').toggle();
		}),
			$('.js-facebook-messenger-box').hasClass('cfm') &&
				setTimeout(function () {
					$('.js-facebook-messenger-box').addClass('rubberBand animated');
				}, 3500),
			$('.js-facebook-messenger-tooltip').length &&
				($('.js-facebook-messenger-tooltip').hasClass('fixed')
					? $('.js-facebook-messenger-tooltip').show()
					: $('.js-facebook-messenger-box').on('hover', function () {
							$('.js-facebook-messenger-tooltip').show();
					  }),
				$('.js-facebook-messenger-close-tooltip').on('click', function () {
					$('.js-facebook-messenger-tooltip').addClass('closed');
				}));
		$('.search_open').click(function () {
			$('.search_box_hide').toggleClass('opening');
		});
	});
};
/* Cart */
NN_FRAMEWORK.Cart = function () {
	/* Add */
	$('body').on('click', '.addcart', function () {
		// var color = $parents.find('.color-block-pro-detail').find('.color-pro-detail input:checked').val();
		// color = color ? color : 0;
		// var size = $parents.find('.size-block-pro-detail').find('.size-pro-detail input:checked').val();
		$this = $(this);
		$parents = $this.parents('.right-pro-detail');
		var id = $('.addcart').data('id');
		var action = $this.data('action');
		var quantity = $parents.find('.quantity-pro-detail').find('.qty-pro').val();
		quantity = quantity ? quantity : 1;

		if($('.proprice_item_size.active').length > 0) {
			var size = $('.proprice_item_size.active').data('id'); 
			var gia = $('.proprice_item_size.active').data('min_price');
		}
		else {
			var size = 0;
			var gia = 0;
			alert('Vui lòng chọn size.');
			return false;
		}

		if($('.proprice_item_color.active').length > 0) {
			var color = $('.proprice_item_color.active').data('id');             	
			var photo = $('.proprice_item_color.active').data('photo');
		}
		else {
			var color = 0;
			var photo = 0;
			alert('Vui lòng chọn màu.');
			return false;
		}

		if (id) {
			$.ajax({
				url: 'api/cart.php',
				type: 'POST',
				dataType: 'json',
				async: false,
				data: {
					cmd: 'add-cart',
					id: id,
					color: color,
					size: size,
					quantity: quantity,
					gia: gia,
					photo: photo
				},
				beforeSend: function () {
					holdonOpen();
				},
				success: function (result) {
					if (action == 'addnow') {
						$('.count-cart').html(result.max);
						$.ajax({
							url: 'api/cart.php',
							type: 'POST',
							dataType: 'html',
							async: false,
							data: {
								cmd: 'popup-cart'
							},
							success: function (result) {
								$('#popup-cart .modal-body').html(result);
								$('#popup-cart').modal('show');
								NN_FRAMEWORK.Lazys();
								holdonClose();
							}
						});
					} else if (action == 'buynow') {
						window.location = CONFIG_BASE + 'gio-hang';
					}
				}
			});
		}

		// if (id) {
		// 	$.ajax({
		// 		url: 'api/cart.php',
		// 		type: 'POST',
		// 		dataType: 'json',
		// 		async: false,
		// 		data: {
		// 			cmd: 'add-cart',
		// 			id: id,
		// 			color: color,
		// 			size: size,
		// 			quantity: quantity
		// 		},
		// 		beforeSend: function () {
		// 			HoldOn.open({
		// 	            theme:"sk-bounce",
		// 	            message:'Vui lòng chờ tí ...'
		// 	        });
		// 		},
		// 		success: function (result) {
		// 			if (action == 'addnow') {
		// 				$('.count-cart').html(result.max);
		// 				$.ajax({
		// 					url: 'api/cart.php',
		// 					type: 'POST',
		// 					dataType: 'html',
		// 					async: false,
		// 					data: {
		// 						cmd: 'popup-cart'
		// 					},
		// 					success: function (result) {
		// 						$('#popup-cart .modal-body').html(result);
		// 						$('#popup-cart').modal('show');
		// 						NN_FRAMEWORK.Lazys();
		// 						holdonClose();
		// 					}
		// 				});
		// 			} else if (action == 'buynow') {
		// 				window.location = CONFIG_BASE + 'gio-hang';
		// 			}
		// 		}
		// 	});
		// }
	});
	/* Delete */
	$('body').on('click', '.del-procart', function () {
		confirmDialog('delete-procart', LANG['delete_product_from_cart'], $(this));
	});
	/* Counter */
	$('body').on('click', '.counter-procart', function () {
		var $button = $(this);
		var quantity = 1;
		var input = $button.parent().find('input');
		var id = input.data('pid');
		var code = input.data('code');
		var oldValue = $button.parent().find('input').val();
		if ($button.text() == '+') quantity = parseFloat(oldValue) + 1;
		else if (oldValue > 1) quantity = parseFloat(oldValue) - 1;
		$button.parent().find('input').val(quantity);
		updateCart(id, code, quantity);
	});
	/* Quantity */
	$('body').on('change', 'input.quantity-procart', function () {
		var quantity = $(this).val() < 1 ? 1 : $(this).val();
		$(this).val(quantity);
		var id = $(this).data('pid');
		var code = $(this).data('code');
		updateCart(id, code, quantity);
	});
	/* City */
	if (isExist($('.select-city-cart'))) {
		$('.select-city-cart').change(function () {
			var id = $(this).val();
			loadDistrict(id);
			loadShip();
		});
	}
	/* District */
	if (isExist($('.select-district-cart'))) {
		$('.select-district-cart').change(function () {
			var id = $(this).val();
			loadWard(id);
			loadShip();
		});
	}
	/* Ward */
	if (isExist($('.select-ward-cart'))) {
		$('.select-ward-cart').change(function () {
			var id = $(this).val();
			loadShip(id);
		});
	}
	/* Payments */
	if (isExist($('.payments-label'))) {
		$('.payments-label').click(function () {
			var payments = $(this).data('payments');
			$('.payments-cart .payments-label, .payments-info').removeClass('active');
			$(this).addClass('active');
			$('.payments-info-' + payments).addClass('active');
		});
	}
	/* Colors */
	if (isExist($('.color-pro-detail'))) {
		$('.color-pro-detail input').click(function () {
			$this = $(this).parents('label.color-pro-detail');
			$parents = $this.parents('.attr-pro-detail');
			$parents_detail = $this.parents('.grid-pro-detail');
			$parents.find('.color-block-pro-detail').find('.color-pro-detail').removeClass('active');
			$parents.find('.color-block-pro-detail').find('.color-pro-detail input').prop('checked', false);
			$this.addClass('active');
			$this.find('input').prop('checked', true);
			var id_color = $parents.find('.color-block-pro-detail').find('.color-pro-detail input:checked').val();
			var id_pro = $this.data('idproduct');
			$.ajax({
				url: 'api/color.php',
				type: 'POST',
				dataType: 'html',
				data: {
					id_color: id_color,
					id_pro: id_pro
				},
				beforeSend: function () {
					HoldOn.open({
			            theme:"sk-bounce",
			            message:'Vui lòng chờ tí ...'
			        });
				},
				success: function (result) {
					if (result) {
						$parents_detail.find('.left-pro-detail').html(result);
						MagicZoom.refresh('Zoom-1');
						NN_FRAMEWORK.OwlData($('.owl-pro-detail'));
						NN_FRAMEWORK.Lazys();
					}
					holdonClose();
				}
			});
		});
	}
	/* Sizes */
	if (isExist($('.size-pro-detail'))) {
		$('.size-pro-detail input').click(function () {
			$this = $(this).parents('label.size-pro-detail');
			$parents = $this.parents('.attr-pro-detail');
			$parents.find('.size-block-pro-detail').find('.size-pro-detail').removeClass('active');
			$parents.find('.size-block-pro-detail').find('.size-pro-detail input').prop('checked', false);
			$this.addClass('active');
			$this.find('input').prop('checked', true);
		});
	}
	/* Quantity detail page */
	if (isExist($('.quantity-pro-detail span'))) {
		$('.quantity-pro-detail span').click(function () {
			var $button = $(this);
			var oldValue = $button.parent().find('input').val();
			if ($button.text() == '+') {
				var newVal = parseFloat(oldValue) + 1;
			} else {
				if (oldValue > 1) var newVal = parseFloat(oldValue) - 1;
				else var newVal = 1;
			}
			$button.parent().find('input').val(newVal);
		});
	}
};
NN_FRAMEWORK.AutoHeight = function () {
	var src_w = $(window).width();
	if(src_w < 992) {
        $('.autoHeight').find('iframe, video, embed, object').addClass('embed-responsive-item');
        $('.autoHeight').find('iframe, video, embed, object').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');
        $('.autoHeight').find('iframe, video, embed, object').removeAttr('width');
        $('.autoHeight').find('iframe, video, embed, object').removeAttr('height');
        $('.autoHeight').find('iframe, video, embed, object').removeAttr('style');
        $('.autoHeight').find('img').addClass('img-fluid');
    }
    else {
        $('.autoHeight').find('iframe, video, embed, object, img').addClass('border-0 outline-0');
    }
};
NN_FRAMEWORK.LikeProduct = function () {
	$(document).on('click', '.save-listing', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        var ele = $('.save-listing[data-id='+id+']');
        if(id) {
            $.ajax({
                url: 'api/ajax_save-listing.php',
                type: 'post',
                data: {id: id},
            })
            .done(function(kq) {
                ele.addClass('save-listing-already').removeClass('save-listing');
                $('.count-like').html(kq);
            });
            return false;
        }
    });
    $(document).on('click', '.save-listing-already', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        var ele = $('.save-listing-already[data-id='+id+']');
        if(id) {
            $.ajax({
                url: 'api/ajax_remove-listing.php',
                type: 'post',
                data: {id: id},
            })
            .done(function(kq) {
                ele.addClass('save-listing').removeClass('save-listing-already');
                $('.count-like').html(kq);
            });
            return false;
        }
    });
};

$("body").on("click",".apply-coupon",function(){  
	var coupon = $(".code-coupon").val();
	var ship = $(".price-ship").val();

	if(coupon=='')
	{
		modalNotify(LANG['no_coupon']);
		return false;
	}

	$.ajax({
		type: "POST",
		url:'api/ajax_coupon_cart.php',
		dataType: 'json',
		data: {coupon:coupon,ship:ship},
		success: function(result){
			$('.price-total').val(result.total);
			$('.load-price-total').html(result.totalText);
			$('.price-endowType').val(result.endowType);
			$('.price-endowID').val(result.endowID);
			$('.price-endow').val(result.endow);
			$('.load-price-endow').html(result.endowText);

			if(result.error!='')
			{
				$(".code-coupon").val("");
				modalNotify(result.error);
			}
		}
	});
});

NN_FRAMEWORK.doigia = function(){
	if (isExist($('.proprice_item_size'))) {
		$(document).on('click', '.proprice_item_size', function(event) {
			event.preventDefault();
			$('.proprice_item').removeClass('active');
			$(this).addClass('active').siblings('.proprice_item_size').removeClass('active');
			fill_price($(this).data('min_price'));
		});
	}
};

NN_FRAMEWORK.doihinh = function(){
	if (isExist($('.proprice_item_color'))) {
		$(document).on('click', '.proprice_item_color', function(event) {
			event.preventDefault();
			$('.proprice_item1').removeClass('active');
			$(this).addClass('active').siblings('.proprice_item_color').removeClass('active');
			var photo = $('.proprice_item1.active').data('img');
			var id_product = $('.proprice_item1.active').data('id_prod');
			
			$.ajax({
				url: 'doihinh',
				type: 'post',
				data: {
					id_product: id_product,
					photo: photo,
				},
			})
			.done(function(kq) {
				$('.productTop1_fotorama').html(kq);
				$('.fotorama').fotorama();
			});		
		});
	}
};
/* Ready */
$(document).ready(function () {
	NN_FRAMEWORK.Lazys();
	NN_FRAMEWORK.Tools();
	NN_FRAMEWORK.Popup();
	NN_FRAMEWORK.Wows();
	NN_FRAMEWORK.AltImg();
	NN_FRAMEWORK.GoTop();
	NN_FRAMEWORK.Menu();
	NN_FRAMEWORK.OwlPage();
	NN_FRAMEWORK.Pagings();
	NN_FRAMEWORK.Cart();
	NN_FRAMEWORK.Videos();
	NN_FRAMEWORK.Photobox();
	NN_FRAMEWORK.Comment();
	NN_FRAMEWORK.Search();
	NN_FRAMEWORK.DomChange();
	//NN_FRAMEWORK.TickerScroll();
	NN_FRAMEWORK.DatePicker();
	NN_FRAMEWORK.loadNameInputFile();
	NN_FRAMEWORK.AutocompleteSeach();
	NN_FRAMEWORK.Filter();
	NN_FRAMEWORK.AutoHeight();
	NN_FRAMEWORK.LikeProduct();
	NN_FRAMEWORK.doigia();
	NN_FRAMEWORK.doihinh();
});