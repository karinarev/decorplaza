<div class="text-center featured-title">
	<h2><?php echo $heading_title; ?></h2>
	<div class="divider"></div>
	<h3>Мы рекомендуем:</h3>
</div>

<div id="carousel<?php echo $module; ?>" class="owl-carousel featured-carousel">
	<?php foreach ($products as $product) { ?>
	<div class="item" id="<?php echo $product['product_id']; ?>">
		<div class="product-layout">
			<div class="product-thumb transition">
				<div class="image">
					<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
					<a class="more featured-icon" href="<?php echo $product['href']; ?>"></a>
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


								<button type="submit" class="btn shopping-text shopping featured-icon" ></button>
							</div>
						</form>
						</div>
				</div>
				<div class="caption">
					<p class="description"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></p>
					<?php if ($product['model']) { ?>
					<div class="sku">
						<span>Артикул <?php echo $product['model']; ?></span>
					</div>
					<?php } ?>
					<?php if ($product['rating']) { ?>
					<div class="rating">
						<?php for ($i = 1; $i <= 5; $i++) { ?>
						<?php if ($product['rating'] < $i) { ?>
						<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x empty-star"></i></span>
						<?php } else { ?>
						<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x full-star"></i></span>
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








<script type="text/javascript"><!--

	$('#carousel<?php echo $module; ?>').owlCarousel({
		items: 5,
		itemsTablet: [1024, 3],
		autoPlay: false,
		navigation: true,
		navigationText: ['<i class="chevron-left chevron-gray"></i>', '<i class="chevron-right chevron-gray"></i>'],
		pagination: false
	});

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
					$('.success, .warning, .attention, .information, .error').remove();

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

	$(document).on('cbox_closed', function () {
		$('.featured-carousel .item').each(function(index) {
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
						$(btn).html(quantity);
					}
					else{
						$(btn).removeClass('empty-gold').addClass('shopping');
					}

				}
			});

		});
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


	$(document).ready(function () {

		var count = 0;
		$(this).find('.featured-icon').css({'display' : 'none'});

		$('.featured-carousel .item').hover(
				function () {
					$(this).find('img').addClass('image-hover');
					//$(this).find('.image').append('<a class="more featured-icon"></a><a class="shopping-text shopping featured-icon"></a> ');
					$(this).find('.featured-icon').css({'display' : 'block'});
					$(this).find('.sku').css({'display' : 'block'});
					$(this).find('.rating').css({'display' : 'block'});
				},
				function (){
					$(this).find('img').removeClass('image-hover');
					//$(this).find('.featured-icon').remove();
					$(this).find('.featured-icon').css({'display' : 'none'});
					$(this).find('.sku').css({'display' : 'none'});
					$(this).find('.rating').css({'display' : 'none'});

				});

	});


	--></script>
