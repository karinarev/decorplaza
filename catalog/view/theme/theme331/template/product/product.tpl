<?php echo $header; ?>
<?php echo $column_left; ?>
	<div class="<?php if ($column_left ) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?>" id="content"><?php echo $content_top; ?>
		<div class="breadcrumb">
			<?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
			<?php echo $breadcrumb['separator']; ?><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><?php echo $breadcrumb['text']; ?><?php } ?>
			<?php } ?>
		</div>  
  
		<div class="product-info" itemscope itemtype="http://schema.org/Product">
			<div class="row">
				<div class="col-sm-4">
					<!--<h1 class="view"><?php echo $heading_title; ?></h1>-->
					<script type="text/javascript">
						jQuery(document).ready(function(){
						var myPhotoSwipe = $("#gallery a").photoSwipe({ enableMouseWheel: false , enableKeyboard: false, captionAndToolbarAutoHideDelay:0 });
						});
					</script>
   	
					<?php $i=0; if ($thumb || $images) { $i++  ?>
					<div id="full_gallery">
						<ul id="gallery">
							<?php if (!empty($thumb1)) { ?><li><a href="<?php echo $thumb1; ?>" data-something="something" data-another-thing="anotherthing"><img src="<?php echo $thumb1; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li><?php } ?>
							<?php foreach ($images as $image) { ?>
							<li><a href="<?php echo $image['popup']; ?>" data-something="something<?php echo $i?>" data-another-thing="anotherthing<?php echo $i?>"><img src="<?php echo $image['popup']; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
								<?php } ?>
						</ul>
						
					</div>
					<?php } ?>

					<?php if ($thumb || $images) { ?>
					<div id="default_gallery" class="left spacing">
						<?php if ($thumb) { ?>
						<div class="image"> 
							<img id="zoom_01"  data-zoom-image="<?php echo $popup; ?>" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
							
							<?php if($newItem) { ?>
							<div class="newItem"><img width="75" src="/image/new.png"></div>
							<?php } ?>
					
							<?php if($special) { ?>
								<div class="specialItem"><img width="75" src="/image/sale.png"></div>
							<?php } ?>
						
							<?php if($bestSeller) { ?>
								<div class="best_seller"><img width="75" src="/image/best_seller.png"></div>
							<?php } ?>
						</div>
						<?php } ?>
						<?php if ($images) { ?>
							<div class="image-additional">
								<ul id="image-additional">
									<?php if (!empty($thumb1)) { ?>
									<li>
										<a href="#" data-image="<?php echo $thumb1; ?>" data-zoom-image="<?php echo $thumb1; ?>">
											<img id="img_01" src="<?php echo $thumb1; ?>" />
										</a>
									</li>
									<?php } ?>
									<?php foreach ($images as $image) { ?>
									
									 <li>
										<a href="#" data-image="<?php echo $image['popup']; ?>" data-zoom-image="<?php echo $image['popup']; ?>">
											<img id="img_01" src="<?php echo $image['thumb']; ?>" />
										</a>
									</li>
									<?php } ?>
								</ul>
								<div class="clear"></div>
							</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<div class="col-sm-8">
					<h1 itemprop="name"> <?php echo $heading_title; ?></h1>
					<div class="description">
						<div class="product-section">
							<?php if ($manufacturer) { ?>
							<span><?php echo $text_manufacturer; ?></span> <a style="text-decoration:underline;" href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a><br />
							<?php } ?>
							<span><?php echo $text_model; ?></span> <?php echo $model; ?><br />
							<?php if ($reward) { ?>
							<span><?php echo $text_reward; ?></span> <?php echo $reward; ?><br />
							<?php } ?>
							<span><?php echo $text_stock; ?></span>
							<div class="prod-stock">
							<?php if($stock == "Есть в наличии" || $stock == "В наличии"){ $color = '#3079ED';} if($stock == "Нет в наличии" || $stock == "Предзаказ" || $stock == "Ожидание 2-3 дня"){ $color = '#9d9d9d';}?>
								<span class="<?=$product_info['source']?>" style="color:<?=$color;?>;">
									<?php echo $stock;?>
								</span>
							</div>
						</div>
					
					
						<?php if ($price) { ?>
						<div class="price">
							<span class="text-price"><?php echo $text_price; ?></span>
							<?php if (!$special) { ?>
							<span class="price-new ">
								<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"  class="opprice">
								<span itemprop="price">
								<?php echo str_replace('р.', ' </span>р.', $price); ?>
							</span>
							</span>
							<?php } else { ?>
							<span class="price-new">
							<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"  class="opprice"><?php echo $special; ?></span></span><span class="price-old">
							<span itemprop="price">
							<?php echo str_replace('p.', 'p.</span>', $price); ?></span> 
							<?php } ?>
							<?php if ($tax) { ?>
							<span class="price-tax"><span class="opprice"><?php echo $text_tax; ?> <?php echo $tax; ?></span></span>
							<?php } ?>
							<?php if ($points) { ?>
							<span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span>
							<?php } ?>
							<?php if ($discounts) { ?>
							<div class="discount">
								<?php foreach ($discounts as $discount) { ?>
									<?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?><br />
								<?php } ?>
							</div>
							<?php } ?>
						</div>
						<?php } ?>
						
						<?php if (!empty($profiles)): ?>
						<div class="option">
							<h2><span class="required">*</span><?php echo $text_payment_profile ?></h2>
							<br />
							<select name="profile_id">
								<option value=""><?php echo $text_select; ?></option>
								<?php foreach ($profiles as $profile): ?>
								<option value="<?php echo $profile['profile_id'] ?>"><?php echo $profile['name'] ?></option>
								<?php endforeach; ?>
							</select>
							<br />
							<br />
							<span id="profile-description"></span>
							<br />
							<br />
						</div>
						<?php endif; ?>
						<a class="various" href="#inline" style="display:none;"> </a>
						<div id="inline" style="display:none;"><span style="color:red">Выберите размер</span></div>

						<?php if ($options) { ?>
						<div class="options">
							<h2><?php echo $text_option; ?></h2>
							<table>
								<?php foreach ($options as $option) { ?>
									<?php if ($option['type'] == 'select') { ?>
									<tr>
										<!--<div id="option-<?php echo $option['product_option_id']; ?>" class="option">-->
										<td>
											<label><?php if ($option['required']) { ?>
											<span class="required">*</span>
											<?php } ?>
											<b><?php echo $option['name']; ?>:</b></label>
										</td>
										<td>
											<select name="option[<?php echo $option['product_option_id']; ?>]">
											<option value="0"><?php echo $text_select; ?></option>
											<?php foreach ($option['option_value'] as $option_value) { ?>
											<option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
											<?php if ($option_value['price']) { ?>
											(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
											<?php } ?>
											</option>
											<?php } ?>
											</select>
										</td>
									</tr>
									<!--</div>-->
									<?php } ?>
									
									<?php if ($option['type'] == 'radio') { ?>
									<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										<label>
											<?php if ($option['required']) { ?>
												<span class="required">*</span>
											<?php } ?>
											<b><?php echo $option['name']; ?>:</b>
										</label>
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
										<label>
											<?php if ($option['required']) { ?>
												<span class="required">*</span>
											<?php } ?>
											<b><?php echo $option['name']; ?>:</b>
										</label>
										<?php foreach ($option['option_value'] as $option_value) { ?>
											<label class="checkbox" for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
												<input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /><?php echo $option_value['name']; ?>
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
										<label>
											<?php if ($option['required']) { ?>
												<span class="required">*</span>
											<?php } ?>
											<?php echo $option['name']; ?>:
										</label>
										<table class="option-image">
											<?php foreach ($option['option_value'] as $option_value) { ?>
												<tr>
													<td style="width: 1px;">
														<input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
													</td>
													<td>
														<label for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
															<img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" />
														</label>
													</td>
													<td>
														<label for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
															<?php echo $option_value['name']; ?>
															<?php if ($option_value['price']) { ?>
																(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
															<?php } ?>
														</label>
													</td>
												</tr>
											<?php } ?>
										</table>
									</div>
									<?php } ?>
									
									<?php if ($option['type'] == 'text') { ?>
									<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										<label>
											<?php if ($option['required']) { ?>
												<span class="required">*</span>
											<?php } ?>
											<?php echo $option['name']; ?>:
										</label>
										<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
									</div>
									<?php } ?>
									
									<?php if ($option['type'] == 'textarea') { ?>
									<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										<label>
											<?php if ($option['required']) { ?>
												<span class="required">*</span>
											<?php } ?>
											<?php echo $option['name']; ?>:
										</label>
										<textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5">
											<?php echo $option['option_value']; ?>
										</textarea>
									</div>
									<?php } ?>
									
									<?php if ($option['type'] == 'file') { ?>
									<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										<label>
											<?php if ($option['required']) { ?>
												<span class="required">*</span>
											<?php } ?>
											<?php echo $option['name']; ?>:
										</label>
										<a id="button-option-<?php echo $option['product_option_id']; ?>" class="btn"><?php echo $button_upload; ?></a>
										<input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
									</div>
									<br />
									<?php } ?>
									
									<?php if ($option['type'] == 'date') { ?>
									<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										<label>
											<?php if ($option['required']) { ?>
												<span class="required">*</span>
											<?php } ?>
											<?php echo $option['name']; ?>:
										</label>
										<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
									</div>
									<br />
									<?php } ?>
									
									<?php if ($option['type'] == 'datetime') { ?>
									<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										<label>
											<?php if ($option['required']) { ?>
												<span class="required">*</span>
											<?php } ?>
											<?php echo $option['name']; ?>:
										</label>
										<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
									</div>
									<br />
									<?php } ?>
									
									<?php if ($option['type'] == 'time') { ?>
									<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
										<label>
											<?php if ($option['required']) { ?>
											<span class="required">*</span>
											<?php } ?>
											<?php echo $option['name']; ?>:
										</label>
										<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
									</div>
									<br />
									<?php } ?>
								<?php } ?>
							</table>
							<?php if($image_thumb) { ?>
							<!--div class="image_size">
							<a class="colorbox" href="/image/<?php echo $image_thumb; ?>" ><span>Таблица размеров</span></a>
							</div-->
							<?php } else { ?>
							<!--div class="image_size">
							<a  href="/table_size" ><span>Таблица размеров</span></a>
							</div-->
							<?php } ?>
			
						</div>
						<?php } ?>
	  
						<div id="content2">
							<span id="closedeliv" onclick="hideDelivery()">Закрыть (x)</span>
							<p>
								<?php if(isset($this->request->get['path'])) {
								$path = $this->request->get['path'];
								$cats = explode('_', $path);
								$cat_id = $cats[count($cats) - 1];
								} 
								?>
								<?php
								$this->load->model('catalog/category');
								$query = $this->db->query("SELECT sizetable
								FROM oc_category_description
								WHERE category_id = '".$cat_id."'");
								$prodcategories = $query->rows;

								foreach($prodcategories as $prodcategory){
									$sizetable = $prodcategory['sizetable'];
									$category_info = $this->model_catalog_category->getCategory($category_id);
									$caturl = (HTTP_SERVER . 'index.php?route=product/category&path=' . $category_id); 
									?>
   
									<?php if ($sizetable) { ?>
										<div style="margin-bottom: 15px;"><?php echo html_entity_decode($sizetable, ENT_QUOTES, 'UTF-8'); ?></div>
										<a onclick="displayDelivery()">Таблица размеров</a>
									<?php } ?>
								<?php } ?>
							</p>
						</div>
						
						<script type="text/javascript">
							function scrollToElement(theElement) {
								if (typeof theElement === "string") theElement = document.getElementById(theElement);
								var selectedPosX = 0;
								var selectedPosY = 0;
								while (theElement != null) {
									selectedPosX += theElement.offsetLeft;
									selectedPosY += theElement.offsetTop;
									theElement = theElement.offsetParent;
								}
								window.scrollTo(selectedPosX, selectedPosY);
							}
						</script>
						
						<? if ($quantity > 0) { ?>
						<div class="cart">
							<div class="prod-row">
								<div class="cart-top">
									<div class="cart-top-padd form-inline">
										<label>
											<?php echo $text_qty; ?>
											<input id="bc" class="q-mini" type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" />
											<input class="q-mini" type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
										</label>
										<a id="button-cart" class="button-prod" ><i class="fa fa-shopping-cart"></i><?php echo $button_cart; ?></a>
										<a id="one_klick_anchor" onclick="one_klick_show(); " href="javascript:void(0);" class="button feedbackForm fast_order">Быстрый заказ</a> 
										<a class="we-found-cheaper"><p class="find_1">Нашли дешевле? Мы снизим цену!</p></a>

									</div>
									<div class="extra-button">
										<div class="wishlist">
											<a onclick="addToWishList('<?php echo $product_id; ?>');" title="<?php echo $button_wishlist; ?>"><i class="fa fa-star"></i><span><?php echo $button_wishlist; ?></span></a>
										</div>
										<div class="compare">
											<a onclick="addToCompare('<?php echo $product_id; ?>');" title="<?php echo $button_compare; ?>"><i class="fa fa-bar-chart-o"></i><span><?php echo $button_compare; ?></span></a>
										</div>
									</div>
									<div class="clear"></div>
									<?php if ($minimum > 1) { ?>
										<div class="minimum"><?php echo $text_minimum; ?></div>
									<?php } ?>
								</div>
							</div>
						</div>
						<? } else {?>
						<div class="cart">
							<div class="prod-row">
								<div class="cart-top">
									<div class="cart-top-padd form-inline">
										<a onclick="scrollToElement('analog_product')" id="button-cart" class="button-prod" >Подобрать аналоги</a>
									</div>
									<div class="clear"></div>
									<?php if ($minimum > 1) { ?>
									<div class="minimum"><?php echo $text_minimum; ?></div>
									<?php } ?>
								</div>
							</div>
						</div>
						<? } ?>
						<div class="clear"></div>
						
						<?php if ($review_status) { ?>
						<div class="review">
							<div>
								<img src="catalog/view/theme/theme331/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;
								<div class="btn-rew">
									<a onclick="document.getElementById('tab-review').scrollIntoView();"><?php echo $reviews; ?></a>
									<a onclick="document.getElementById('tab-review').scrollIntoView();"><i class="fa fa-pencil"></i><?php echo $text_write; ?></a>
									<div class="clear"></div>
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<?php } ?>
						<div class="clear"></div>
						
						<?php if ($review_status) { ?>
						<div class="review">
							<div>
								<img src="catalog/view/theme/theme331/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;
								<div class="btn-rew">
									<a onclick="document.getElementById('tab-review').scrollIntoView();"><?php echo $reviews; ?></a>
									<a onclick="document.getElementById('tab-review').scrollIntoView();"><i class="fa fa-pencil"></i><?php echo $text_write; ?></a>
									<div class="clear"></div>
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<?php } ?>
						<div class="clear"></div>
						<!--<div class="share">
							
							<span class='st_facebook_hcount' displayText='Facebook'></span>
							<span class='st_twitter_hcount' displayText='Tweet'></span>
							<span class='st_googleplus_hcount' displayText='Google +'></span>
							<span class='st_pinterest_hcount' displayText='Pinterest'></span>
							<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
							<script type="text/javascript">stLight.options({publisher: "00fa5650-86c7-427f-b3c6-dfae37250d99", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
							
						</div>-->
					</div>
					
					<div class="other_links">
						<i class="fa fa-truck"></i> <a id="dostavka_2" href="http://italy-sumochka.ru/dostavka">Информация о доставке</a>
						<i class="fa fa-credit-card"></i> <a id="info_2" href=" http://italy-sumochka.ru/oplata">Информация об оплате</a>
					</div>
				</div>
			</div>
 
			<div class="tabs">
    <input id="tab11" type="radio" name="tabs" checked>
    <label for="tab11" title="ОПИСАНИЕ">ОПИСАНИЕ</label>
    <input id="tab22" type="radio" name="tabs">
    <label for="tab22" title="ДОСТАВКА">ДОСТАВКА</label>
    <input id="tab33" type="radio" name="tabs">
    <label for="tab33" title="ОПЛАТА">ОПЛАТА</label>
    <section id="content11">
        <?php echo $description."<br>".$description2; ?>
    </section>
    <section id="content22">
        <strong>Самовывоз</strong>
<p>
	Самовывоз осуществляется из нашего магазина по адресу: г. Москва, ул. Свободы, дом 89, корпус 5.</p>
<p>
	График работы магазина: по-пт 10-00 - 21-00, сб-вс с 10-00 -20-00.</p>
<strong>Курьерская доставка по Москве</strong>
<p>
	В пределах МКАД ежедневно с 10.00 до 24.00, стоимость составляет 350 рублей.<br />
	Стоимость доставки за МКАД - 700 рублей.</p>
<p>
	Курьерская доставка оплачивается даже в случае отказа от покупки выбранного Вами товара (за исключением ситуаций, в которых была привезена не та вещь по вине магазина).</p>
<strong>Доставка по России</strong>
<p>Доставка Почтой России</p>
<p>
	Данный способ доставки возможен только после предоплаты за тариф доставки (рассчитывается автоматически при оформлении заказа), сам товар отправляется наложенным платежом (Почта России взимает комиссию за пересылку денежных средств отправителю в размере 1-3% от суммы наложенного платежа).&nbsp;<strong>Внимание! Оплату производить только после того, как с Вами свяжется наш менеджер по указанному в заказе телефону или e-mail и подтвердит наличие товара.</strong></p>
<p>
	Примерные сроки доставки - от 4 до 14 дней (более подробную информацию можно получить на официальном сайте Почты России).</p>
<p>
	Доставка в любую другую страну мира также осуществляется Почтой России. Стоимость рассчитывается по тарифам Почты России в зависимости от ценности, веса посылки, а также Вашего местоположения.</p>
<strong>
	&nbsp;Доставка курьерской службой EMS (при Почте России)&nbsp;
	</strong>
<p>
	&nbsp;Данный способ доставки возможен только после предоплаты за тариф доставки (рассчитывается автоматически при оформлении заказа), сам товар отправляется наложенным платежом (Почта России взимает комиссию за пересылку денежных средств отправителю в размере 1-3% от суммы наложенного платежа).&nbsp;Вниман<wbr>ие! Оплату производить только после того, как с Вами свяжется наш менеджер по указанному в заказе телефону или e-mail и подтвердит наличие товара.</wbr></p>
<p>

	<p>
		Курьер службы EMS доставит Ваш заказ до дверей. В момент получения заказа Вы оплачиваете его стоимость курьеру.</p>
	<p>
	<p>
		Стоимость услуги экспресс-доставк<wbr>и рассчитывается с учетом нескольких параметров:&nbsp;<br />
		<br />
		1) местонахождение населенных пунктов отправителя и получателя (вся территория России и зарубежья разделена на тарифные зоны EMS);&nbsp;<br />
		2) вес отправления (максимальный вес отправления &ndash; 31,5 кг.);&nbsp;<br />
		3) наличие дополнительных платных услуг и сервисов (наложенный платеж, страхование, таможенные услуги).&nbsp;</wbr></p>
    </section>
    <section id="content33">
        <p>
		1) Непосредственно в магазине наличными или банковской картой. <br>
		2) Наличными курьеру при получении товара. <br>
		3) Банковский перевод на карту Сбербанка.</p>
    </section>
</div>
			
			<?php if ($attribute_groups) { ?>
			<div class="tabs">
				<div class="tab-heading">
					<?php echo $tab_attribute; ?>
				</div>
				<div class="tab-content">
					<table class="attribute table table-bordered" >
						<?php foreach ($attribute_groups as $attribute_group) { ?>
							<thead>
								<tr>
									<td colspan="2"><?php echo $attribute_group['name']; ?></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($attribute_group['attribute'] as $attribute) { ?>
								<tr>
									<td><?php echo $attribute['name']; ?></td>
									<td><?php echo $attribute['text']; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						<?php } ?>
					</table>
				</div>
			</div>
			<?php } ?>
			
			<?php if ($review_status) { ?>
			<div class="tabs" id="tab-review">
				<div class="tab-heading">
					<?php echo $tab_review; ?>
				</div>
				<div class="tab-content">
					<div id="review"></div>
					<h2 id="review-title"><?php echo $text_write; ?></h2>
					<label><?php echo $entry_name; ?></label>
					<input type="text" name="name" value="" />
					<br />
					<br />
					<label><?php echo $entry_review; ?></label>
					<textarea name="text" cols="40" rows="8" style="width: 93%;"></textarea>
					<div class="clear"></div>
					<span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
					<br />
					<label class="inline"><?php echo $entry_rating; ?></label>
					<div class="form-inline border">
						<span class="radio"><?php echo $entry_bad; ?></span>&nbsp;
						<input type="radio" name="rating" value="1" />
						&nbsp;
						<input type="radio" name="rating" value="2" />
						&nbsp;
						<input type="radio" name="rating" value="3" />
						&nbsp;
						<input type="radio" name="rating" value="4" />
						&nbsp;
						<input type="radio" name="rating" value="5" />
						&nbsp; <span class="radio"><?php echo $entry_good; ?></span><br />
					</div>
					
					<label><?php echo $entry_captcha; ?></label>
					<input type="text" name="captcha" value="" />
					<img src="index.php?route=product/product/captcha" alt="" id="captcha" />
					<br />
					<div class="buttons">
						<div><a id="button-review" class="button-cont-right"><?php echo $button_continue; ?><i class="fa fa-arrow-circle-right"></i></a></div>
					</div>
				</div>
			</div>
			<?php } ?>
			
			<?php /* if ($tags) { ?>
			<div class="tabs">
				<div class="tab-heading">
					<?php echo $text_tags; ?>
				</div>
				<div class="tab-content">
					<div class="tags">
						<b><?php echo $text_tags; ?></b>
						<?php for ($i = 0; $i < count($tags); $i++) { ?>
							<?php if ($i < (count($tags) - 1)) { ?>
								<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
							<?php } else { ?>
								<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } */?>
			
		</div>

		<div id="after-product-info"></div>
		<? 
		
		
		if (isset($products_analog)) {
			if (count($products_analog) > 0) {
				echo('<a id="analog_product"></a>');
				echo('<div class="box-product analog_product">');
				echo('<div class="box"><div class="box-heading">Похожие товары</div></div>');
					foreach ($products_analog as $product_analog) {
						echo('<div class="analog">');
							echo('<a href="'.$product_analog['url'].'"><img src="'.$product_analog['image'].'"></a>');
							echo('<div class="name zzz"><a href="'.$product_analog['url'].'">'.$product_analog['name'].'</a></div>');
							echo('<div class="priceanalog">'.$product_analog['price'].' р.</div>');
							?>
							
							<?echo '<!-- ***';
							print_r($products_analog_arr);
							foreach($product_analog as $option) {
								foreach($option as $size) {
									echo $size['name'] . '-';
								}
							}
							echo '-->';?>
							
							<!-------размер и кнопка купить---->
							<style>
							.cart-button {
								display:block;
								margin-top:10px;
							}
							</style>
							<div class="cart-button">
									<form class="add_to_cart" method="post">
										<div class="container_list_product" style="width:70px;">
										
										<input class="q-mini" type="hidden" name="product_id" size="2" value="<?php echo $product_analog['product_id']; ?>" />
											<input class="q-mini" type="hidden" name="quantity" size="2" value="1" />
											<input id="product_name" type="hidden" value="<?php echo $product_analog['name']; ?>">
														<input id="product_price" type="hidden" value="<?php echo ($product_analog['special'] ? $$product['special'] : $product_analog['price']); ?>">
														<input type="hidden" id="product_url" value="<? echo($this->url->link('product/product&product_id=' . $product_analog['url']));?>"/>
														<!--<div id="option-<?php echo $product_analog['product_id']; ?>" class="option">-->
														<select class="selectare" name="option[<?php echo $product_analog['product_option_id']; ?>]">

														<option value="0">Выберите <?echo $analog_option['type'];?></option>
														<?php
															foreach($product_analog as $option) {
																foreach($option as $size) {?>
																	
																	<option value="<?php echo $size['product_option_value_id']; ?>"><?php echo $size['name']; ?>
																	<?php /*if ($size['price']) { ?>
																	(<?php echo $size['price_prefix']; ?><?php echo $size['price']; ?>)
																	<?php } */?>
																	</option>
																<?}
															}
																						
														?>
														</select>
														
											<?php foreach ($product['options'] as $option) { ?>
										
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

										
									
										</div>
											<div class="cart"><input type="submit" class="button ajax_add" value="<?php echo $button_cart; ?>" /></div>
											</form>
											<div class="wishlist"><a class="tooltip-1 " title="<?php echo $button_wishlist; ?>"  onclick="addToWishList('<?php echo $product['product_id']; ?>');"><i class="fa fa-star"></i></a></div>
											<div class="compare"><a class="tooltip-1" title="<?php echo $button_compare; ?>"  onclick="addToCompare('<?php echo $product['product_id']; ?>');"><i class="fa fa-bar-chart-o"></i></a></div>
											<div class="clear"></div>
										</div>
							
							<!-------размер и кнопка купить---->
							
							
						<?echo('</div>');
					}
				echo('</div>');
			}
		}
		?>

		<?php if ($products) { ?>
		<h1 class="style-1 mt0"><?php echo $tab_related;?></h1>
		<div  class="related">
			<div class="box-product"> 
				<ul class="related-slider">
					<?php foreach ($products as $product) { ?>
						<li class="related-info">
							<?php if ($product['thumb']) { ?>
							<div class="image">
								<a href="<?php echo $product['href']; ?>"><img id="img_<?php echo $product['product_id']; ?>" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a>
							</div>
							<?php } ?>
							
							<div class="name">
								<a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
							</div>
							
							<?php if ($product['price']) { ?>
							<div class="price">
								<?php if (!$product['special']) { ?>
									<?php echo $product['price']; ?>
								<?php } else { ?>
									<span class="price-new"><?php echo $product['special']; ?></span><span class="price-old"><?php echo $product['price']; ?></span>
								<?php } ?>
							</div>
							<?php } ?>
							
							<div class="cart-button">
								<div class="cart">
									<a title="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button ">
										<!--<i class="fa fa-shopping-cart"></i>-->
										<span><?php echo $button_cart; ?></span>
									</a>
								</div>
								<!--<a href="<?php// echo $product['href']; ?>" class="button details"><span><?php// echo $button_details; ?></span></a>-->
								<div class="wishlist">
									<a class="tooltip-2" title="<?php echo $button_wishlist; ?>"  onclick="addToWishList('<?php echo $product['product_id']; ?>');"><i class="fa fa-star"></i><span><?php echo $button_wishlist; ?></span></a>
								</div>
								<div class="compare">
									<a class="tooltip-2" title="<?php echo $button_compare; ?>"  onclick="addToCompare('<?php echo $product['product_id']; ?>');"><i class="fa fa-bar-chart-o"></i><span><?php echo $button_compare; ?></span></a>
								</div>
								<span class="clear"></span>
							</div>
							<div class="rating">
								<?php if ($product['rating']) { ?>
									<img height="13" src="catalog/view/theme/theme331/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" />
								<?php } ?>
							</div>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<?php echo $content_bottom; ?>
	</div>
  
	<!--быстрый заказ-->
	<a onclick="one_klick_close();" class="one_klick_close" href="javascript:void(0);">
		<div style="display:none;" id="absolutes"></div>
	</a>
	<div id="one_klick" class="ui-draggable" style="border-radius: 0px; display: none;">
		<a onclick="one_klick_close();" id="сloses"  href="javascript:void(0);"></a>
		<?php echo $column_right; ?>
	</div> 
	<!--быстрый заказ-->
	
	<style>
		#сloses{
			background: url(../image/fancybox_sprite.png);
			position: absolute;
			top: -18px;
			right: -18px;
			width: 36px;
			height: 36px;
			cursor: pointer;
			z-index: 8040;
		}
	</style>
	
	<script>
		function one_klick_close(){
			$('#one_klick').hide();
			$('#absolutes').hide();
			return false;
		}
	
		function one_klick_show(){
			margin_top = -$('#one_klick').height()/2;
			margin_left= -$('#one_klick').width()/2;
			$('#one_klick').css({'margin-left': margin_left, 'margin-top': margin_top });
			$('#one_klick').show();
			$('#absolutes').show();
		
			return false;
		}
	</script>
	
	<script type="text/javascript"><!--
	$(document).ready(function() {
		$('.colorbox').colorbox({
			overlayClose: true,
			opacity: 0.5,
			rel: "colorbox"
		});
		
		/*$('#dostavka_2').click(function(){
			
			$('#tab22').click();
			$('html, body').animate({ scrollTop: $('.tabs').offset().top }, 500);
			return false;
		});
		$('#info_2').click(function(){
			
			$('#tab33').click();
			$('html, body').animate({ scrollTop: $('.tabs').offset().top }, 500);
			return false;
		});*/
		
		
	});
	//--></script> 
	
	<script type="text/javascript"><!--
	  
	  $('select[name="profile_id"], input[name="quantity"]').change(function(){
		$.ajax({
			url: 'index.php?route=product/product/getRecurringDescription',
			type: 'post',
			data: $('input[name="product_id"], input[name="quantity"], select[name="profile_id"]'),
			dataType: 'json',
			beforeSend: function() {
				$('#profile-description').html('');
			},
			success: function(json) {
				$('.success, .warning, .attention, information, .error').remove();
				
				if (json['success']) {
					$('#profile-description').html(json['success']);
				}	
			}
		});
	});
	  jQuery(function($){
	   $("#customer_phone").mask("+7(999) 999-9999");
	});
	  
	$('#button-cart').bind('click', function() {
		var select_siz = $('.product-info select option:selected').val();
		if(select_siz === '0'){
			$('.various').click();
		}else{
			
			$.ajax({
			url: 'index.php?route=checkout/cart/add',
			type: 'post',
			data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
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
		
	});
	//--></script>
	
<?php if ($options) { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
	action: 'index.php?route=product/product/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/theme331/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
	},
	onComplete: function(file, json) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
		
		$('.error').remove();
		
		if (json['success']) {
			alert(json['success']);
			
			$('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
		}
		
		if (json['error']) {
			$('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
		}
		
		$('.loading').remove();	
	}
});
//--></script>
<?php } ?>
<?php } ?>
<?php } ?>
<script>
							$('.add_to_cart').submit(function(e){
								e.preventDefault();
								var select_siz = $(this).closest("form").find('select option:selected').val();
								
								if(select_siz === '0'){
									//alert('Выберите опции товара, пожалуйста.');
									$('.various').click();
								}else{

									//product_id=1546&quantity=1&option%5B1546%5D=12011
									
									
									$.ajax({
									url: 'index.php?route=checkout/cart/add',
									type: 'post',
									data: $(this).serialize(),
									dataType: 'json',
									success: function(json) {
										
										$('.success, .warning, .attention, information, .error').remove();
										//{"error":{"option":{"1000":"Поле Размер должно быть заполнено!"}},"redirect":"http://italy-sumochka.ru/venum-amazonia-boxing-gloves"}
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
							</script>
<script type="text/javascript"><!--
$('#review .pagination a').live('click', function() {
	$('#review').fadeOut('slow');
		
	$('#review').load(this.href);
	
	$('#review').fadeIn('slow');
	
	return false;
});			

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/theme331/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('#review-title').after('<div class="warning">' + data['error'] + '</div>');
			}
			
			if (data['success']) {
				$('#review-title').after('<div class="success">' + data['success'] + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
function a(){ 
	$.ajax({
		url: 'index.php?route=product/product/add',
		type: 'post',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
			} 
			if (json['success']) {
				$('.opprice').html(json['total']);
                                $('.price-tax').html(json['tax']);
                            html = '';
                            $.each(json.oprice, function(i, object) {   
                                                           html += object;
                                                                 });
                              $('.pandc').html(html);
		                          }
	    }
	});
} 
$(document).on("change", ".option", a);
//$(document).on("keyup", "#bc", a);    
	
$( document ).ready(function() { 
	$.ajax({
		url: 'index.php?route=product/product/add',
		type: 'post',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
			} 
			if (json['success']) {
			   html = '';
                            $.each(json.oprice, function(i, object) {   
                                                           html += object;
                                                                 });
                              $('.pandc').html(html);
		                          }
	    }
	});
});
//--></script>
<script type="text/javascript"><!--
$('#tabs a').tabs();

$('#dostavka_2').click(function(){
	
	$('#tab22').click();
	$('html, body').animate({ scrollTop: $('.tabs').offset().top }, 500);
	return false;
});
$('#info_2').click(function(){
	
	$('#tab33').click();
	$('html, body').animate({ scrollTop: $('.tabs').offset().top }, 500);
	return false;
});
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}

	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	$('.datetime').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'h:m'
	});
	$('.time').timepicker({timeFormat: 'h:m'});
	
	
	
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
//-->

function displayDelivery()
	{
		$('#content2').css('display','block');	
		
	}
function hideDelivery()
	{  
		$('#content2').css('display','none');	
		
	}
</script> 


<?php echo $footer; ?>