<?php echo $header; ?>
<?php echo $column_left; ?>
		<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content"><?php echo $content_top; ?>

  <h3 class="header"><?php echo $heading_title; ?></h3>
  <div class="box-container">
	   <div class="content">
	<div>
		
		<div class="form-group">
			<?php if ($search) { ?>
			<input type="text" name="search" class="searchInput" value="<?php echo $search; ?>" />
			<?php } else { ?>
			<input type="text" name="search" class="searchInput" value="<?php echo $search; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" />
			<?php } ?>
		</div>
		<div class="form-group">
			<div class="checkbox">
				<label for="description">
				<?php if ($description) { ?>
					<input type="checkbox" name="description" value="1" id="description" checked="checked" />
					<?php } else { ?>
					<input type="checkbox" name="description" value="1" id="description" />
					<?php } ?>
				<?php echo $entry_description; ?>
				</label>
			</div>
		</div>
	</div>
	
	
  </div>
	  <div class="buttons">
		<a id="button-search" class="button"><span><?php echo $button_search; ?></span></a>
	  </div>
  </div>

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
						<?php } else { ?>
						<div class="rating">
							<?php for ($i = 1; $i <= 5; $i++) { ?>
							<span class="fa fa-stack"><i class="fa fa-star empty-star"></i></span>
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
  <?php } else { ?>
  <div class="content"><h3 class="header"><?php echo $text_empty; ?></h3></div>
  <?php }?>
 
  <?php echo $content_bottom; ?></div>
 <a class="various" href="#inline" style="display:none;"> </a>
<div id="inline" style="display:none;"><span style="color:red">Выберите размер</span></div>

   <div class="category-info">
	<!--<?php if ($thumb) { ?>
	<div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
	<?php } ?>-->
	<?php if ($description) { ?>
	<?php echo $description; ?>
	<?php } ?>
  </div>

<?php echo $column_right; ?>
  
<script type="text/javascript"><!--
$('#content input[name=\'search\']').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'category_id\']').bind('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').attr('disabled', 'disabled');
		$('input[name=\'sub_category\']').removeAttr('checked');
	} else {
		$('input[name=\'sub_category\']').removeAttr('disabled');
	}
});

$('select[name=\'category_id\']').trigger('change');

$('#button-search').bind('click', function() {
	url = 'index.php?route=product/search';
	
	var search = $('#content input[name=\'search\']').attr('value');
	
	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}

	var category_id = $('#content select[name=\'category_id\']').attr('value');
	
	if (category_id > 0) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}
	
	var sub_category = $('#content input[name=\'sub_category\']:checked').attr('value');
	
	if (sub_category) {
		url += '&sub_category=true';
	}
		
	var filter_description = $('#content input[name=\'description\']:checked').attr('value');
	
	if (filter_description) {
		url += '&description=true';
	}

	location = url;
});

function display(view) {
	if (view == 'list') {
		$('.product-grid ').attr('class', 'product-list');
		$('.product-list ul').removeClass('row');
		$('.product-list ul li').removeClass('col-sm-4');
		$('.product-list ul li').each(function(index, element) {
			var quickviewbutton = $(element).find('.quickview').html();	
			html = '';
			html += '<div class="quickview">' + quickviewbutton + '</div>';
					html += '<div class="row">';
			var image = $(element).find('.image').html();
			
			if (image != null) {
				html += '<div class="image col-sm-3">' + image + '</div>';
			}
			html += '<div class="left col-sm-9">';
				html += '<div class="name">' + $(element).find('.name').html() + '</div>';
				html += '<div class="description">' + $(element).find('.description').html() + '</div>';
				var price = $(element).find('.price').html();
				if (price != null) {
					html += '<div class="price">' + price  + '</div>';
				}
				html += '<div class="cart-button">';
				html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
				html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
				html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
				html += '<div class="clear">' + $(element).find('.clear').html() + '</div>';
				html += '</div>';
				var rating = $(element).find('.rating').html();
				if (rating != null) {
					html += '<div class="rating">' + rating + '</div>';
				}
				html += '</div>';
				html += '</div>';
			

						
			$(element).html(html);
		});		
		
		$('.display').html('<b><?php echo $text_display; ?></b> <div id="list_b"><i class="fa fa-list"></i></div> <a id="grid_a" onclick="display(\'grid\');"><i class="fa fa-th"></i></a>');
		
		$.totalStorage('display', 'list'); 
	} else {
		$('.product-list').attr('class', 'product-grid');
		$('.product-grid ul').addClass('row');
		$('.product-grid ul li').addClass('col-sm-4');
		/*
		$('.product-grid ul li').each(function(index, element) {
			html = '';
			var quickviewbutton = $(element).find('.quickview').html();		
			var image = $(element).find('.image').html();
			html += '<div class="quickview">' + quickviewbutton + '</div>';
			if (image != null) {
			
			html += '<div class="padding">';
				html += '<div class="image">' + image + '</div>';
			}
			html += '<div class="left">';
		
			
			
			
			html += '<div class="name">' + $(element).find('.name').html() + '</div>';
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
			html += '<div class="description">' + $(element).find('.description').html() + '</div>';
			
			
			html += '<div class="cart-button">';
			html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
			html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
			html += '<div class="clear">' + $(element).find('.clear').html() + '</div>';
			html += '</div>';
			var rating = $(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
			
			html += '</div></div>';
			$(element).html(html);
		});	*/
					
		$('.display').html('<b><?php echo $text_display; ?></b> <a id="list_a" onclick="display(\'list\');"><i class="fa fa-list"></i></a>  <div id="grid_b"><i class="fa fa-th"></i></i></div>');
		
		$.totalStorage('display', 'grid');
	}
	if ($('body').width() > 940) {
	// tooltip demo
		$('.tooltip-toggle').tooltip({
		selector: "a[data-toggle=tooltip]"
		})
		$('.tooltip-1').tooltip({
			placement:'bottom'
		})
		$('.tooltip-2').tooltip({
			placement:'top'
		})
		}
	
}

view = $.totalStorage('display');

if (view) {
	display(view);
} else {
	display('grid');
}

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

							$('#cart-total2').html(json['total']);

							$('html, body').animate({ scrollTop: 0 }, 'slow');
						}
					} else {

						if (json['success']) {
							$('#showcart').trigger('click');
							$('#cart-total2').html(json['total']);
						}
					}
					setTimeout(function() {$('.success').fadeOut(1000)},3000)
				}
			});
		}

		return false;
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


$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 150,
		maxHeight	: 30,
		fitToView	: false,
		width		: '150px',
		height		: '30px',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
//--></script> 
<?php echo $footer; ?>