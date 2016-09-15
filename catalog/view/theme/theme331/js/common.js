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
	$(".telephoneNumber").on("mouseover", function(event){
		$(".telephoneNumber").removeClass("headerBigText");
		//	$(".telephoneNumber").css("padding-top", "5px");
		//	$(".telephoneNumber").css("padding-bottom", "5px");
		$("#callIcon").attr("src", "/image/callActive.png");
		switch (event.target.id){
			case "firstNumber" :  $("#callIcon").css("top", "0");  break;
			case "secondNumber" :  $("#callIcon").css("top", "11px");  break;
			case "thirdNumber" :  $("#callIcon").css("top", "33px");  break;
		}
	});
	$(".telephoneNumber").on("mouseout", function(){
		//	$(".telephoneNumber").css("padding", "0");
		$(".telephoneNumber:first-child").addClass("headerBigText");
		$("#callIcon").attr("src", "/image/call.png");
		$("#callIcon").css("top", "0");
	});
	$("a[href='#catalogCollapse']").on("mouseover", function(){
		$("#catalogCollapse").addClass("collapse in");
	});
	$("a[href='#catalogCollapse']").on("mouseout", function(event){
		if (event.relatedTarget.className != "categoryLi")
		$("#catalogCollapse").removeClass("collapse in").addClass("collapse");
	});
	$("#catalogCollapse, .categoryLi").on("mouseout", function(event){
		if (event.relatedTarget.className != ".categoryA" && event.relatedTarget.id != "#catalogCollapse" && event.relatedTarget.className != "pointerSpan" && event.relatedTarget.className != "categoryLi" && event.relatedTarget.className != "subcategoryLi" && event.relatedTarget.className != "subcategoryUl" && event.relatedTarget.className != "list-group categoryUl"){
			$("#catalogCollapse").removeClass("collapse in").addClass("collapse");
		    $(".collapseHorizontal").addClass("invisibleElement").removeClass("visibleElement");}
	})
	$("#catalogCollapse>ul>a>li").on("mouseover", function(event){
		$(event.target).find("span").css("background-image", "url(/image/pointerActive.png)");
	});
	$("#catalogCollapse>ul>a>li").on("mouseout", function(event){
		$(event.target).find("span").css("background-image", "url(/image/pointer.png)");
		if (event.relatedTarget.className != "subcategoryLi" && event.relatedTarget.className != "subcategoryUl")
			$(".collapseHorizontal").addClass("invisibleElement").removeClass("visibleElement");
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
	 $('#cart-total2').html(json['total'].split(' ')[1]);
  $('html, body').animate({ scrollTop: 0 }, 'slow'); 
 }	
}else{
	
  if (json['success']) {
   $('#showcart').trigger('click');
	  $('#cart-total2').html(json['total'].split(' ')[1]);
 
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
function callBack(event){
	event.preventDefault();
	var link = event.target;
	$(link).css("visibility", "hidden");
	$(".callBackStuff").css("display", "inline-block");
	$("#callBackInput").focus().on("blur", function(){
		$(".callBackStuff").css("display", "none");
		$(link).css("visibility", "visible");
	});
}

function callBackSend(){
	if ($("#callBackInput").val()=='')
		alert("Заявка отклонена: введите телефон");
	else {
		alert("Заявка принята, ожидайте звонка");
	}
}

function subcategoryBlockShow(categoryNumber){
	var categoryBlock = event.target;
	$(".collapseHorizontal>ul").empty();
	var category = categories[categoryNumber];
	$("#firstSubcategoryCollapse").addClass("visibleElement").removeClass("invisibleElement");
	for (var i=0; i<10; i++){
		if (category.children[i] != undefined){
			var li = document.createElement("li");
			var a = document.createElement("a");
			a.href=category.children[i].href;
			var li = document.createElement("li");
			li.textContent = category.children[i].name;
			li.className="subcategoryLi";
			$(a).append(li);
			$("#firstSubcategoryCollapse>ul").append(a);
		}
	}
	if (category.children.length>10){
		$("#secondSubcategoryCollapse").addClass("visibleElement").removeClass("invisibleElement");
		for (i=10; i<20; i++) {
			if (category.children[i] != undefined) {
				var a = document.createElement("a");
				a.href=category.children[i].href;
				var li = document.createElement("li");
				li.textContent = category.children[i].name;
				li.className="subcategoryLi";
				$(a).append(li);
				$("#secondSubcategoryCollapse>ul").append(a);
			}
		}
	}
	$(".collapseHorizontal>ul").on("mouseout", function(event){
		console.log(event.relatedTarget);
		if (event.relatedTarget.className != "subcategoryUl" && event.relatedTarget.id != "#firstSubcategoryCollapse" && event.relatedTarget.className != "subcategoryLi") {
			$(".collapseHorizontal").addClass("invisibleElement").removeClass("visibleElement");
			if (event.relatedTarget.className != ".categoryA" && event.relatedTarget.id != "#catalogCollapse" && event.relatedTarget.className != "pointerSpan" && event.relatedTarget.className != "categoryLi" && event.relatedTarget.className != "list-group categoryUl")
				$("#catalogCollapse").removeClass("collapse in").addClass("collapse");
		}
	})


}