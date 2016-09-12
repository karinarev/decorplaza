<?php echo $header; ?>
	<?php echo $column_left; ?>
		<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content">

	<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
	</ul>
			<h3 class="category-header"><?php echo $heading_title; ?></h3>
		<?php echo $content_top; ?>

  <?php if ($categories) { ?>
  <div class="box subcat">
	<div class="box-heading1"><?php echo $text_refine; ?></div>
	
    <div class="box-content">
		<div class="box-product box-subcat">
			<ul class="row"><?php $i=0;?>
				<?php foreach ($categories as $category) { $i++; ?>
				<?php 
						if ($i%3==1) {
							$a='first-in-line';
						}
						elseif ($i%3==0) {
							$a='last-in-line';
						}
						else {
							$a='';
						}
					?>
				<li class="cat-height  col-sm-3">
					<?php if ($category['thumb']) { ?>
					<div class="image"><a href="<?php echo $category['href']; ?>"><img src="<?php echo $category['thumb']; ?>" alt="<?php echo $category['name']; ?>" /></a></div>
					<?php } ?>
					<div class="name subcatname"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
  </div>
  <?php } ?>
		<img src="image/ocjoyajaxcart/loading.gif" id="ajaxcartloadimg"/>
	<div class="row-wrapper">
		<?php if ($products) { ?>
  <div class="sort-row row">
		<div class="sort col-md-6 col-lg-6 col-sm-12"><label for="input-sort"><?php echo $text_sort; ?></label>
	 	 <select id="input-sort" onchange="location = this.value;">
		<?php foreach ($sorts as $sorts) { ?>
		<?php if ($sorts['value'] == $sort . '-' . $order) { ?>
		<option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
		<?php } else { ?>
		<option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
		<?php } ?>
		<?php } ?>
	  </select>
	</div>
	  <div class="col-md-6 col-lg-6 col-sm-12 text-right">
		  <?php if (isset($pagination)) { ?>
		  <?php echo $pagination; ?>
		  <?php } ?>
	  </div>
  </div>
	  <div class="row product-row">
		  <?php foreach ($products as $product) { ?>
		  <div class="item category-item col-md-3 col-sm-4 col-xs-12" id="<?php echo $product['product_id']; ?>">
			  <div class="product-layout">
				  <div class="product-thumb transition">
					  <div class="image col-xs-5 col-md-12">
						  <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
						  <a class="more product-icon" href="<?php echo $product['href']; ?>"></a>
						  <div>
							  <form class="add_to_cart" method="post">
								  <div class="container_list_product">

									  <input class="q-mini" type="hidden" name="product_id" size="2" value="<?php echo $product['product_id']; ?>" />
									  <input class="q-mini" type="hidden" name="quantity" size="2" value="1" />
									  <input id="product_name" type="hidden" value="<?php echo $product['name']; ?>">
									  <input id="product_price" type="hidden" value="<?php echo ($product['special'] ? $$product['special'] : $product['price']); ?>">
									  <input type="hidden" id="product_url" value="<? echo($this->url->link('product/product&product_id=' . $product['product_id']));?>"/>
									  <?php foreach ($product['options'] as $option) { ?>
									  <?php if ($option['type'] == 'select') { ?>
									  <!--<div id="option-<?php echo $option['product_option_id']; ?>" class="option">-->

									  <select class="selectare" name="option[<?php echo $option['product_option_id']; ?>]">
										  <option value="0">Выберите <?php echo $option['name']; ?></option>
										  <?php foreach ($option['option_value'] as $option_value) { ?>
										  <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
											  <?php if ($option_value['price']) { ?>
											  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
											  <?php } ?>
										  </option>
										  <?php } ?>
									  </select>
									  <!--</div>-->
									  <?php } ?>
									  <?php if ($option['type'] == 'radio') { ?>
									  <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										  <label>
											  <?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <b><?php echo $option['name']; ?>:</b></label>
										  <?php foreach ($option['option_value'] as $option_value) { ?>

										  <label class="radio" for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
											  <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /><?php echo $option_value['name']; ?>
											  <?php if ($option_value['price']) { ?>
											  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
											  <?php } ?>
										  </label>
										  <?php } ?>
									  </div>
									  <br />
									  <?php } ?>
									  <?php if ($option['type'] == 'checkbox') { ?>
									  <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										  <label><?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <b><?php echo $option['name']; ?>:</b></label>
										  <?php foreach ($option['option_value'] as $option_value) { ?>

										  <label class="checkbox" for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /><?php echo $option_value['name']; ?>
											  <?php if ($option_value['price']) { ?>
											  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
											  <?php } ?>
										  </label>
										  <?php } ?>
									  </div>
									  <br />
									  <?php } ?>
									  <?php if ($option['type'] == 'image') { ?>
									  <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										  <label><?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <?php echo $option['name']; ?>:</label>
										  <table class="option-image">
											  <?php foreach ($option['option_value'] as $option_value) { ?>
											  <tr>
												  <td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
												  <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
												  <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
														  <?php if ($option_value['price']) { ?>
														  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
														  <?php } ?>
													  </label></td>
											  </tr>
											  <?php } ?>
										  </table>
									  </div>

									  <?php } ?>
									  <?php if ($option['type'] == 'text') { ?>
									  <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										  <label><?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <?php echo $option['name']; ?>:</label>
										  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
									  </div>
									  <?php } ?>
									  <?php if ($option['type'] == 'textarea') { ?>
									  <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										  <label><?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <?php echo $option['name']; ?>:</label>
										  <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
									  </div>
									  <?php } ?>
									  <?php if ($option['type'] == 'file') { ?>
									  <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										  <label><?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <?php echo $option['name']; ?>:</label>
										  <a id="button-option-<?php echo $option['product_option_id']; ?>" class="btn"><?php echo $button_upload; ?></a>
										  <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
									  </div>
									  <br />
									  <?php } ?>
									  <?php if ($option['type'] == 'date') { ?>
									  <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										  <label><?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <?php echo $option['name']; ?>:</label>
										  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
									  </div>
									  <br />
									  <?php } ?>
									  <?php if ($option['type'] == 'datetime') { ?>
									  <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										  <label><?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <?php echo $option['name']; ?>:</label>
										  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
									  </div>
									  <br />
									  <?php } ?>
									  <?php if ($option['type'] == 'time') { ?>
									  <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										  <label><?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <?php echo $option['name']; ?>:</label>
										  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
									  </div>
									  <br />
									  <?php } ?>
									  <?php } ?>
									  <button type="submit" class="btn shopping-text shopping product-icon" ></button>
								  </div>
							  </form>
						  </div>
					  </div>
					  <div class="caption col-xs-7 col-md-12">
						  <p class="description"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></p>
						  <?php if ($product['model']) { ?>
						  <div class="model">
							  <span>Артикул <?php echo $product['model']; ?></span>
						  </div>
						  <?php } ?>
						  <?php if ($product['rating']) { ?>
						  <div class="rating">
							  <?php for ($i = 1; $i <= 5; $i++) { ?>
							  <?php if ($product['rating'] < $i) { ?>
							  <span class="fa fa-stack"><i class="fa fa-star empty-star"></i></span>
							  <?php } else { ?>
							  <span class="fa fa-stack"><i class="fa fa-star full-star"></i></span>
							  <?php } ?>
							  <?php } ?>
						  </div>
						  <?php } ?>
						  <?php if ($product['price']) { ?>
						  <p class="price">
							  <?php if (!$product['special']) { ?>
							  <span class="price-current"><?php echo $product['price']; ?></span>
							  <?php } else { ?>
							  <span class="price-old"><?php echo $product['price']; ?></span>
							  <span class="price-new"><?php echo $product['special']; ?></span>
							  <?php } ?>
						  </p>
						  <?php } ?>
					  </div>
				  </div>
			  </div>
		  </div>
		  <?php } ?>
		  </div>
	<div class="col-md-offset-6 col-md-6 col-lg-6 text-right sort-bottom">
		<?php if (isset($pagination)) { ?>
		<?php echo $pagination; ?>
		<?php } ?>
	</div>
  <?php } ?>

  <?php if (!$categories && !$products) { ?>
  <div class="box-container">
      <div class="category-empty"><?php echo $text_empty; ?></div>
  </div>
  <?php } ?>
	</div>

  <?php echo $content_bottom; ?>
  </div>
  


<?php echo $column_right; ?>

<script type="text/javascript"><!--

	$(window).resize(function(){
		checkWindowSize();

	});

	$(document).ready(function () {

		checkWindowSize();



		function checkWindowSize(){
			console.log('sf');
			currWindowWidth = $( window ).width();
			if(currWindowWidth > 767) {
				$('.category-item').hover(
						function () {
							$(this).find('img').addClass('image-hover');
							$(this).find('.product-icon').css({'display' : 'block'});
							$(this).find('.model').css({'display' : 'block'});
							$(this).find('.rating').css({'display' : 'block'});
						},
						function (){
							$(this).find('img').removeClass('image-hover');
							$(this).find('.product-icon').css({'display' : 'none'});
							$(this).find('.model').css({'display' : 'none'});
							$(this).find('.rating').css({'display' : 'none'});
						});

			}
			else{
				$( ".category-item" ).unbind( "hover" );
			}
		}

	});

	$(document).on('cbox_closed', function () {
		$('.category-item').each(function(index) {
			var quantity;
			var item = $(this);
			var id = $(this).attr('id');
			$.ajax({
				url: 'index.php?route=checkout/cart/getProductQuantity&product_id=' + id,
				type: 'get',
				dataType: 'text',
				success: function (data) {
					quantity = data;
					var btn = item.find($('.shopping-text'));
					if(btn.hasClass('shopping')) {
						btn.removeClass('shopping').addClass('empty-gold');
					}
					if(!$.isEmptyObject(data)) {
						btn.removeClass('shopping').addClass('empty-gold');
						$(btn).html(quantity);
					}
					else{
						$(btn).removeClass('empty-gold').addClass('shopping');
						$(btn).html("");
					}

				}
			});

		});
		$('#ajaxcartloadimg').hide();
	});
	var curQuantity;
	$(document).on("mouseenter", '.empty-gold', function() {
		$(this).removeClass('empty-gold').addClass('plus');
		curQuantity = $(this).html();
		$(this).html('');
	});

	$(document).on("mouseleave", '.plus', function() {
		$(this).removeClass('plus').addClass('empty-gold');
		$(this).html(curQuantity);
	});

	filter = [];

	$('#ajaxcartloadimg').hide().ajaxStart( function() {
		$(this).show();
	});

	function filterChanged(url, checkbox) {
		if($(checkbox).prop('checked')) {
			filter.push($(checkbox).prop('value'));
			$('.row-wrapper').load(url + '&filter=' + filter.join(',') + ' .row-wrapper', function () {
				$.getScript("catalog/view/javascript/category.js");
				$('#ajaxcartloadimg').hide();

			});
		}
		else {
			for(var i=0; i<= filter.length; i++){
				if(filter[i] == $(checkbox).prop('value')) filter.splice(i, 1);
			}
			$('.row-wrapper').load(url + '&filter=' + filter.join(',') + ' .row-wrapper', function () {
				$.getScript("catalog/view/javascript/category.js");
				$('#ajaxcartloadimg').hide();

			});
		}

	}

	function filterButtonClicked(url) {
		filter = [];
		$('input[name^=\'filter\']').each(function(element) {
			$(this).prop('checked', false);
		});
		$('.row-wrapper').load(url + '&filter= .row-wrapper', function () {
			$.getScript("catalog/view/javascript/category.js");
			$('#ajaxcartloadimg').hide();
		});
	}


		$('#input-sort').styler({
			onSelectOpened: function () {
				$('li.sel').css({'display' : 'none'});
			}
		});
		$('.jq-selectbox__trigger-arrow').html('<i class="fa fa-angle-right" aria-hidden="true"></i>');






$('.add_to_cart').submit(function(e){
	e.preventDefault();
	var select_siz = $(this).closest("form").find('select option:selected').val();

	if(select_siz === '0'){
		//alert('Выберите опции товара, пожалуйста.');
		$('.various').click();
	}else{
		$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $(this).serialize(),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
				if (json['error']['profile']) {
                    $('select[name="profile_id"]').after('<span class="error">' + json['error']['profile'] + '</span>');
                }
			}


			if ($.browser.msie && ($.browser.version == 7 || $.browser.version == 8)) {
  if (json['success']) {
    $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
    $('.success').fadeIn('slow');

    $('#cart-total').html(json['total']);

    $('html, body').animate({ scrollTop: 0 }, 'slow');
  }
} else {

  if (json['success']) {
    $('#showcart').trigger('click');
    $('#cart-total').html(json['total']);
  }
}
			setTimeout(function() {$('.success').fadeOut(1000)},3000)
		}
	});
	}

	return false;
});



//--></script> 
<!--<script type="text/javascript">
		(function($){$.fn.equalHeights=function(minHeight,maxHeight){tallest=(minHeight)?minHeight:0;this.each(function(){if($(this).height()>tallest){tallest=$(this).height()}});if((maxHeight)&&tallest>maxHeight)tallest=maxHeight;return this.each(function(){$(this).height(tallest)})}})(jQuery)
	$(window).load(function(){
		if($(".cat-height").length){
		$(".cat-height").equalHeights()}
	})
</script>-->
 
<?php echo $footer; ?>