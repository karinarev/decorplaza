$(document).ready(function() {
	/* Search */
	$('.button-search').bind('click', function() {
		url = $('#hidden').attr('href') + 'index.php?route=product/search';
				 
		var search = $('input[name=\'search\']').attr('value');
		
		if (search) {
			url += '&search=' + encodeURIComponent(search);
		}
		
		location = url;
	});
	
	$('#header input[name=\'search\']').bind('keydown', function(e) {
		if (e.keyCode == 13) {
			url = $('#hidden').attr('href') + 'index.php?route=product/search';
			 
			var search = $('input[name=\'search\']').attr('value');
			
			if (search) {
				url += '&search=' + encodeURIComponent(search);
			}
			
			location = url;
		}
	});
	/* Ajax Cart */
	
	
	if ($('body').width() < 980) {
			$('#cart .heading span.link_a').live("click", function(){
				if ($('#cart').hasClass('active')) { 
					jQuery('#cart').removeClass('active'); 
					}
				else {
					$('#cart').addClass('active');
					}
				})
			
			} else {
			$('#cart > .heading span.link_a').live('mouseover', function() {
			$('#cart').addClass('active');
			
			$('#cart').load('index.php?route=module/cart #cart > *');
			
			$('#cart').live('mouseleave', function() {
				$(this).removeClass('active');
			});
			});	
			
		}
		
		
			
			
		
	
	
	
	/* Mega Menu */
	$('#menu ul > li > a + div').each(function(index, element) {
		// IE6 & IE7 Fixes
		if ($.browser.msie && ($.browser.version == 7 || $.browser.version == 6)) {
			var category = $(element).find('a');
			var columns = $(element).find('ul').length;
			
			$(element).css('width', (columns * 143) + 'px');
			$(element).find('ul').css('float', 'left');
		}		
		
		var menu = $('#menu').offset();
		var dropdown = $(this).parent().offset();
		
		i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());
		
		if (i > 0) {
			$(this).css('margin-left', '-' + (i + 5) + 'px');
		}
	});

	// IE6 & IE7 Fixes
	if ($.browser.msie) {
		if ($.browser.version <= 6) {
			$('#column-left + #column-right + #content, #column-left + #content').css('margin-left', '195px');
			
			$('#column-right + #content').css('margin-right', '195px');
		
			$('.box-category ul li a.active + ul').css('display', 'block');	
		}
		
		if ($.browser.version <= 7) {
			$('#menu > ul > li').bind('mouseover', function() {
				$(this).addClass('active');
			});
				
			$('#menu > ul > li').bind('mouseout', function() {
				$(this).removeClass('active');
			});	
		}
	}
	
	$('.success img, .warning img, .attention img, .information img').live('click', function() {
		$(this).parent().fadeOut('slow', function() {
			$(this).remove();
		});
	});	
});

function getURLVar(key) {
	var value = [];
	
	var query = String(document.location).split('?');
	
	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');
			
			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}
		
		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
} 

$(".carousel-button-right-ajcart").live('click',function(){ 
   	right_carusel();
});
   
$(".carousel-button-left-ajcart").live('click',function(){ 
   	left_carusel();
});

function left_carusel(){
	var block_width = $('.carousel-block-ajcart').width() + 20;
	$(".carousel-items-ajcart .carousel-block-ajcart").eq(-1).clone().prependTo(".carousel-items-ajcart"); 
	$(".carousel-items-ajcart").css({"left":"-"+block_width+"px"}); 
	$(".carousel-items-ajcart").animate({left: "0px"}, 200); 
	$(".carousel-items-ajcart .carousel-block-ajcart").eq(-1).remove(); 
}
	
function right_carusel(){
	var block_width = $('.carousel-block-ajcart').width() + 20;
	$(".carousel-items-ajcart").animate({left: "-"+ block_width +"px"}, 200); 
	setTimeout(function () { 
	    $(".carousel-items-ajcart .carousel-block-ajcart").eq(0).clone().appendTo(".carousel-items-ajcart"); 
	    $(".carousel-items-ajcart .carousel-block-ajcart").eq(0).remove(); 
	    $(".carousel-items-ajcart").css({"left":"0px"}); 
	}, 300);
}
function sklonenie(a,b,c,s) {
	var s = $('.ajaxtable_tbody .ajaxtable_tr').length;
	var words = [a, b, c];
	var index = s % 100;

	if (index >=11 && index <= 14) { index = 0; }
	else { index = (index %= 10) < 5 ? (index > 2 ? 2 : index): 0; }

	return(words[index]);
}
function start_show() {
	$(".ajaxtable_tbody .ajaxtable_tr").slice(0,3).css('display', 'table-row');

	var product_count_all = $('.ajaxtable_tbody .ajaxtable_tr').length;
	if (product_count_all > 3) {
		product_count = product_count_all-3;
		$('#hideproducts span b').html(product_count);
		$("#hideproducts span i").html(sklonenie("товаров", "товара", "товар", $(this).attr()));
	} else if(product_count_all < 4) {
		$('#hideproducts ').css('display', 'none');
	} else {
		product_count = false;
	}
}
$(document).ready(function() {
	
	$('.feedbackForm').fancybox();
	
	$('.yandexmapmodal').fancybox();

    $(".ajaxcart").colorbox({ 
      	onLoad     : function() { $(this).colorbox.resize(); },
      	onComplete : function() { start_show(); $(this).colorbox.resize(); },
      	fastIframe: false,
	    scrolling: false,
	    initialWidth: false,
	    innerWidth: false,
	    maxWidth: false,
	    height: false,
	    initialHeight: false,
	    innerHeight: false
    });
    $("#colorbox").draggable({ 
      	cursor: "crosshair",
      	containment: "parent"
    }); 
});

$('html').append('<div style="display:none;"><a class="ajaxcart" id="showcart" href="index.php?route=common/ocjoyajaxcart">&nbsp;</a></div>');
$('head').prepend('<link rel="stylesheet" type="text/css" href="catalog/view/theme/theme331/stylesheet/ocjoyajaxcart/ocjoyajaxcart.css"/>');

function addToCart(product_id, quantity) {
	
				
	quantity = typeof(quantity) != 'undefined' ? quantity : 1;
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: 'product_id=' + product_id + '&quantity=' + quantity,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information, .error').remove();
			if (json['redirect']) {
				location = json['redirect'];
			}
			if(window.screen.width > 1024) {
				var bbbb = $('body').width(); alert(bbbb);
			if ($.browser.msie && ($.browser.version == 7 || $.browser.version == 8)) {
				
 if (json['success']) {
  $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
  $('.success').fadeIn('slow');
  $('#cart-total').html(json['total']);
  $('html, body').animate({ scrollTop: 0 }, 'slow'); 
 }	
}else{
	
  if (json['success']) {
   $('#showcart').trigger('click');
   $('#cart-total').html(json['total']);
 
}
}
			}
		}
	});
}
function addToWishList(product_id) {
	$.ajax({
		url: 'index.php?route=account/wishlist/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;"><i class="fa fa-thumbs-up"></i>' + json['success'] + '<span><i class="fa fa-times-circle"></i></span></div>');
				
				$('.success').fadeIn('slow');
				
				$('#wishlist-total').html(json['total']);
			
			}	
			setTimeout(function() {$('.success').fadeOut(1000)},3000)
		}
	});
}
$(document).ready(function() {
if ($('#compare .compare-block').length ==0 ) {
	$('#compare').hide() 
} else {
	$('#compare').show()
}});
function addToCompare(product_id) { 
	$.ajax({
		url: 'index.php?route=product/compare/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				$('#compare').load('index.php?route=module/compare #compare > *');
				$('#compare-total').html(json['total']);
				$('#notification').html('<div class="success" style="display: none;"><i class="fa fa-thumbs-up"></i>' + json['success'] + '<span class="close"><i class="fa fa-times-circle "></i></span></div>');
				
				$('.success').fadeIn('slow');
				
				
				$('#compare').show();
				$('html, body').animate({scrollTop:$('#compare').position().top}, 'slow');
			}
			setTimeout(function() {$('.success').fadeOut(1000)},3000)
		}
		
	});
}
function RemoveCompare(product_id) { 
	$.ajax({
		url: 'index.php?route=module/compare&remove='+ product_id,
		success: function() {
			$('.compare-block_'+product_id).slideUp('slow', function(){
				$('#compare').load('index.php?route=module/compare #compare > *');
				if ($('#compare .compare-block').length <=1 ) {
				$('#compare').fadeOut('slow') 
					} else {
				$('#compare').fadeIn('slow') 
					}
				});
			
		}
	});
}
