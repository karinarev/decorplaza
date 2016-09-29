<?php echo $header; ?>
<?php echo $column_left; ?>
	<div class="<?php if ($column_left ) { ?>col-sm-9 col-md-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?>" id="content"><?php echo $content_top; ?>
	<ul class="breadcrumb breadcrumb-product">
			<?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
		   <?php if($i+1<count($breadcrumbs)) { ?><li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li> <?php } else { ?><?php echo '<li><span>' . $breadcrumb['text'] . '</li></span>' ?><?php } ?>
			<?php } ?>
		</ul>

		<div class="product-info" itemscope itemtype="http://schema.org/Product">
			<div class="row">
				<div class="col-sm-4">
					<h2 itemprop="name" class="myHeader mobileHeader"> <?php echo $heading_title; ?></h2>
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
					<h2 itemprop="name" class="myHeader"> <?php echo $heading_title; ?></h2>
					<div class="description">
						<div class="row">
							<div class="col-sm-6">
						<div class="product-section">
							<div class="rating">
							<?php for ($i = 1; $i <= 5; $i++) { ?>
							<?php if ($rating < $i) { ?>
							<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x lightStar"></i></span>
							<?php } else { ?>
							<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
							<?php } ?>
							<?php } ?>
							</div><br/>
							<?php if ($manufacturer) { ?>
							<span><?php echo $text_manufacturer; ?></span><br/> <a style="text-decoration:underline;" href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a><br />
							<?php } ?><br/>
							<span><?php echo $text_model; ?></span><br/> <?php echo $model; ?><br /><br/>
							<span><?php echo $text_stock; ?></span><br/>
							<div class="prod-stock">
							<?php if($stock == "Есть в наличии" || $stock == "В наличии"){ $color = 'rgb(34, 103, 1)';} if($stock == "Нет в наличии" || $stock == "Предзаказ" || $stock == "Ожидание 2-3 дня"){ $color = 'rgb(142, 0, 0)';}?>
								<span class="<?=$product_info['source']?>" style="color:<?=$color;?>!important;">
									<?php echo $stock;?>
								</span>
							</div>
						</div>
							</div>
							<div class="col-sm-6">
								<?php if ($price) { ?>
									<?php if (!$special) { ?>
									<span class="price-new ">
                                       <span itemprop="offers" itemscope itemtype="http://schema.org/Offer"  class="opprice">
                                                <span itemprop="price">
                                                   <?php echo str_replace('р.', ' </span>р.', $price); ?>
					   					    	</span>
                                             </span>
										<?php } else { ?>
										<span class="price-new ">
                                       <span itemprop="offers" itemscope itemtype="http://schema.org/Offer"  class="opprice">
                                                <span itemprop="price">
                                                   <?php echo str_replace('р.', ' </span>р.', $special); ?>
					   					    	</span>
                                             </span>
											<?php } ?>
								<?php } ?>
										<div class="form-group">
											<div class="quantity">
                  <button class="buttonMinus plusminus" onclick="onMinusProduct();"></button>
                  <input type="text" name="quantity" maxlength="3" disabled="disabled" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
                  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                  <button class="buttonPlus plusminus" onclick="onPlusProduct(<?php echo $quantity; ?>);"></button>
												</div>
                  <br />
											<?php if ($isInCart) echo '<button type="button" id="button-cart" data-loading-text='.$text_loading.' class="btn productInCartButton btn-primary btn-lg btn-block button-cart"><span class="icon cartIcon cartIconProduct"></span><span>В корзине</span></button>'; else echo '<button type="button" id="button-cart" data-loading-text='.$text_loading.' onmouseover="changeCartWhite()" onmouseout="changeCartBlack()" onclick="changeButtonBrown()" class="btn productCartButton btn-primary btn-lg btn-block button-cart"><span class="icon cartIcon cartIconProduct"></span><span> В корзину<span></button>';?>
                </div>
							</div>
						</div>
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
					<?php if ($tags) { ?>
					<div class="tagsPlaza">
					<p class="textTags">ТЕГИ:</p>
					<span class="tags">
						<?php for ($i = 0; $i < count($tags); $i++) { ?>
						<?php if ($i < (count($tags) - 1)) { ?>
						<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
						<?php } else { ?>
						<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
						<?php } ?>
						<?php } ?>
						</div>
            </span>
					<?php } ?>
				</div>
			</div>

			<div class="tabs">
    <input id="tab11" type="radio" name="tabs" checked onchange="$('#form-review').css('display', 'block')">
    <label for="tab11" title="ОПИСАНИЕ">ОПИСАНИЕ</label>
    <input id="tab22" type="radio" name="tabs" onchange="$('#form-review').css('display', 'none')">
    <label for="tab22" title="ДОСТАВКА">ОТЗЫВЫ</label>
    <input id="tab33" type="radio" name="tabs" onchange="$('#form-review').css('display', 'none')">
    <label for="tab33" title="ОПЛАТА">ВИДЕО</label>
    <section id="content11">
		<?php echo $description."<br>".$description2; ?>
    </section>
    <section id="content22">
        <div class="tab-pane" id="tab-review">
            <div class="review-area"></div>
        </div>
    </section>
    <section id="content33">
		<?php if (empty($video_description)) echo 'Для данного товара отсутствует видео.'; ?>
		<?php echo $video_description; ?>
        <?php if (!empty($video)) echo	'<iframe width="825" height="460" src= "' . $video . '" frameborder="0" allowfullscreen></iframe>'; ?>
    </section>

</div>

			<div class="panel-group product-panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							Описание
						</a>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in">
						<div class="panel-body">
							<?php echo $description."<br>".$description2; ?>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
							Отзывы
						</a>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="tab-pane" id="tab-review">
								<div class="review-area"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
							Видео
						</a>
					</div>
					<div id="collapseThree" class="panel-collapse collapse">
						<div class="panel-body">
							<?php if (empty($video_description)) echo 'Для данного товара отсутствует видео.'; ?>
							<?php echo $video_description; ?>
							<?php if (!empty($video)) echo	'<iframe width="825" height="460" src= "' . $video . '" frameborder="0" allowfullscreen></iframe>'; ?>
						</div>
					</div>
				</div>
			</div>

			<form id="form-review" method="post">
				<h2 class="myHeader">Оставить отзыв</h2>
				<div class="tab-content">
					<div class="row">
						<div class="col-sm-6">
							<label><span class="colorRed">*</span>Имя:</label>
							<input type="text" name="name" value="" id="input-name" class="form-control" />
						</div>
						<div class="col-sm-6">
							<label><span class="colorRed">*</span>E-mail:</label>
							<input type="text" name="email" value="" id="input-email" class="form-control" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label class="control-label" for="input-review"><span class="colorRed">*</span>Комментарий:</label>
							<textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group required">
						<div class="col-sm-12">
							<label class="productRateLabel">Оценка:</label>
							<input type="radio" name="rating" value="1" />
							<input type="radio" name="rating" value="2" />
							<input type="radio" name="rating" value="3" />
							<input type="radio" name="rating" value="4" />
							<input type="radio" name="rating" value="5" />
							<span class="colorRed necessaryFields" style="float:right;">*Поля, обязательные для заполнения.</span>
						</div>
					</div>
					<button type="submit" id="button-review" name="submit" data-loading-text="<?php echo $text_loading; ?>" class="callBackSend">Отправить</button>
				</div>
			</form>



			


		</div>

		<div id="after-product-info"></div>


		<!--быстрый заказ-->
	<a onclick="one_klick_close();" class="one_klick_close" href="javascript:void(0);">
		<div style="display:none;" id="absolutes"></div>
	</a>
	<div id="one_klick" class="ui-draggable" style="border-radius: 0px; display: none;">
		<a onclick="one_klick_close();" id="сloses"  href="javascript:void(0);"></a>
		<?php echo $column_right; ?>
	</div>
	</div>

	<!--быстрый заказ-->

<link href="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/stylesheet/product.css" rel="stylesheet" type="text/css" />
<div class="clear"></div>
<div class="col-md-12 content-bottom">
	<?php if (isset($products_analog)) { ?>
	<?php if (count($products_analog) > 0) { ?>

	<div class="text-center featured-title">
		<h3>Похожие товары:</h3>
	</div>


	<div class="jcarousel-wrapper featured-jcarousel-wrapper">
		<div class="jcarousel featured-jcarousel">
			<ul>
				<?php foreach ($products_analog as $product_analog) { ?>
				<li class="item" id="<?php echo $product_analog['product_id']; ?>">
					<div class="product-layout featured-layout">
						<div class="product-thumb transition row">
							<div class="image col-md-12 col-xs-6">
								<img src="<?php echo $product_analog['image']; ?>" alt="<?php echo $product_analog['name']; ?>" title="<?php echo $product_analog['name']; ?>" class="img-responsive" />
								<a class="more featured-icon" href="<?php echo $product_analog['href']; ?>"></a>
								<div>
									<form class="add_to_cart" method="post">
										<div class="container_list_product">

											<input class="q-mini" type="hidden" name="product_id" size="2" value="<?php echo $product_analog['product_id']; ?>" />
											<input class="q-mini" type="hidden" name="quantity" size="2" value="1" />
											<input id="product_name" type="hidden" value="<?php echo $product_analog['name']; ?>">
											<input id="product_price" type="hidden" value="<?php echo ($product_analog['special'] ? $$product_analog['special'] : $product_analog['price']); ?>">
											<input type="hidden" id="product_url" value="<? echo($this->url->link('product/product&product_id=' . $product_analog['product_id']));?>"/>
											<?php foreach ($product_analog['options'] as $option) { ?>
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
							<div class="caption col-md-12 col-xs-6">
								<p class="description"><a href="<?php echo $product_analog['href']; ?>">
										<span class="short-name"><?php echo $product_analog['name']; ?></span>
										<span class="full-name"><?php echo $product_analog['fullName']; ?></span>
									</a></p>
								<?php if ($product_analog['model']) { ?>
								<div class="sku">
									<span>Артикул <?php echo $product_analog['model']; ?></span>
								</div>
								<?php } ?>
								<?php if ($product_analog['rating']) { ?>
								<div class="rating">
									<?php for ($i = 1; $i <= 5; $i++) { ?>
									<?php if ($product_analog['rating'] < $i) { ?>
									<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x empty-star"></i></span>
									<?php } else { ?>
									<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x full-star"></i></span>
									<?php } ?>
									<?php } ?>
								</div>
								<?php } else { ?>
								<div class="rating">
									<?php for ($i = 1; $i <= 5; $i++) { ?>
									<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x empty-star"></i></span>
									<?php } ?>
								</div>
								<?php } ?>
								<?php if ($product_analog['price']) { ?>
								<p class="price">
									<?php if (!$product_analog['special']) { ?>
									<span class="price-current"><?php echo $product_analog['price']; ?></span>
									<?php } else { ?>
									<span class="price-old"><?php echo $product_analog['price']; ?></span>
									<span class="price-new"><?php echo $product_analog['special']; ?></span>
									<?php } ?>
								</p>
								<?php } ?>
							</div>
						</div>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>

		<a class="jcarousel-control-prev"></a>
		<a class="jcarousel-control-next"></a>

	</div>


	<?php } ?>
	<?php } ?>

	<?php echo $content_bottom; ?> </div>
<?php echo $footer; ?>
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

		  $('#cart-total2').html(json['total'].split(' ')[1]);

		$('html, body').animate({ scrollTop: 0 }, 'slow');
	  }
	} else {

	  if (json['success']) {
		$('#showcart').trigger('click');
		  $('#cart-total2').html(json['total'].split(' ')[1]);
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
$('.review-area .pagination a').live('click', function() {
	$('.review-area').fadeOut('slow');

	$('.review-area').load(this.href);

	$('.review-area').fadeIn('slow');

	return false;
});

$('.review-area').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : ''),
		beforeSend: function() {
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/theme331/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				alert(data['error'])
			}

			if (data['success']) {
				alert(data['success']);

				$('input[name=\'name\']').val('');
				$('input[name=\'email\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
			}
		}
	});
});
//--></script>
<script type="text/javascript"><!--
	var starsArr = [];
	for (var i=0; i<5; i++){
		starsArr[i] = document.createElement("span");
		var ic = document.createElement("i");
		$(ic).addClass("fa fa-star fa-stack-1x lightStar");
		$(starsArr[i]).addClass("fa fa-stack").append(ic);
		$(".productRateLabel").after(starsArr[i]);
		$(starsArr[i]).on("click", function(event){
			var i = starsArr.indexOf(event.target.parentNode);
			$("#form-review input[type='radio'][value='"+(5-i)+"']").prop("checked", "true");
			for (var j=0; j<=5; j++)
				if (i<=j){
					$(starsArr[j]).children(".fa-stack-1x").css("color", "rgb(119, 119, 119)");
				} else {
					$(starsArr[j]).children(".fa-stack-1x").css("color", "rgb(204, 204, 204)");
				}
		});
	}


	var isInCart ="<?php if ($isInCart) echo 'true'; else echo 'false' ?>";


	function onPlusProduct(quantity){
		var i = Number($("#input-quantity").val())+1;
		if (i<=quantity) $("#input-quantity").val(i);
	}

	function onMinusProduct(){
		var i = Number($("#input-quantity").val())-1;
		if (i>0) $("#input-quantity").val(i);
	}

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

	function changeCartWhite(){
		$(".cartIconProduct").css("background-image", "url(/image/cartWhite.png)");
	}
	function changeCartBlack(){
		if (isInCart == 'false')
			$(".cartIconProduct").css("background-image", "url(/image/cart.png)");
	}

	function changeButtonBrown(){
		isInCart = "true";
		var cartSpan = document.createElement("span");
		var textSpan = document.createElement("span");
		cartSpan.className = "icon cartIcon cartIconProduct";
		$(textSpan).addClass("textInCart").text("В корзине");
		$(".productCartButton").empty().removeClass("productCartButton").addClass("productInCartButton").prepend(textSpan).prepend(cartSpan);
		$(".cartIconProduct").css("background-image", "url(/image/cartWhite.png)");
		plusProductNumber($("#input-quantity").val());
	}

	function reviewSubmit(){
		console.log(document.getElementById("form-review"));
		document.getElementById("form-review").submit();
	}

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

$(document).on('cbox_closed', function () {
		$('.featured-jcarousel .item').each(function(index) {
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
	});


$( document ).ready(function() {
	$("#button-cart").on("mouseover", function(event){
		changeCartWhite();
	});



	$('.colorbox').colorbox({
		overlayClose: true,
		opacity: 0.5,
		rel: "colorbox"
	});

	if (isInCart=="true")
		$(".cartIconProduct").css("background-image", "url(/image/cartWhite.png)");


	checkWindowSizeProduct();

	$(window).resize(function(){
		checkWindowSizeProduct();
	});

	function checkWindowSizeProduct() {
		var currWindowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
		if(currWindowWidth < 768){
			$('#column-left').insertBefore('#content');
			$('.product-panel-group .panel').each(function () {
				var panelCollapse = $(this).find('.panel-collapse');
				if(!panelCollapse.hasClass('in')){
					$(this).css('display', 'none');
				}
				else if(panelCollapse.attr('id') == 'collapseOne'){
					$('#form-review').css('display', 'block');
				}
				else {
					$('#form-review').css('display', 'none');
				}

			});

			var productPanel = $('.product-panel-group');

			productPanel.on('hide.bs.collapse', function () {
				$(this).find('.panel').each(function () {
					$(this).css('display', 'block');
				});
				$('#form-review').css('display', 'none');
			});
			productPanel.on('show.bs.collapse', function (e) {
				$(this).find('.panel').each(function () {
					var panelCollapse = $(this).find('.panel-collapse');
					if(panelCollapse.attr('id') == $(e.target).attr('id')) {
						if (panelCollapse.attr('id') == 'collapseOne') {
							$('#form-review').css('display', 'block');
						}
						else {
							$('#form-review').css('display', 'none');
						}
						$(this).css('display', 'block');
					}
					else $(this).css('display', 'none');
				});
			});

			$('.featured-jcarousel')
					.jcarousel({
						vertical: true
					});

			$('.jcarousel-control-prev')
					.on('jcarouselcontrol:active', function() {
						$(this).removeClass('inactive');
					})
					.on('jcarouselcontrol:inactive', function() {
						$(this).addClass('inactive');
					})
					.jcarouselControl({
						target: '-=1'
					});

			$('.jcarousel-control-next')
					.on('jcarouselcontrol:active', function() {
						$(this).removeClass('inactive');
					})
					.on('jcarouselcontrol:inactive', function() {
						$(this).addClass('inactive');
					})
					.jcarouselControl({
						target: '+=1'
					});

		}
		else {

			var jcarousel = $('.featured-jcarousel');

			jcarousel
					.on('jcarousel:reload jcarousel:create', function () {
						var carousel = $(this),
								width = carousel.innerWidth();

						if (width >= 600) {
							width = width / 3;
						} else if (width >= 350) {
							width = width / 2;
						}

						carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');

						if($('.featured-jcarousel').find('li.item').length <= 5){
							$('.jcarousel-control-prev').css('display', 'none');
							$('.jcarousel-control-next').css('display', 'none');
						}
					})
					.jcarousel({
						wrap: 'circular'
					});





			$('.jcarousel-control-prev')
					.jcarouselControl({
						target: '-=1'
					});

			$('.jcarousel-control-next')
					.jcarouselControl({
						target: '+=1'
					});

			$(this).find('.featured-icon').css({'display' : 'none'});

			$('.featured-layout').hover(
					function () {
						$(this).find('img').addClass('image-hover');
						$(this).find('.featured-icon').css({'display' : 'block'});
						$(this).find('.sku').css({'display' : 'block'});
						$(this).find('.rating').css({'display' : 'block'});
						$(this).find('.short-name').css({'display' : 'none'});
						$(this).find('.full-name').css({'display' : 'block'});
					},
					function (){
						$(this).find('img').removeClass('image-hover');
						$(this).find('.featured-icon').css({'display' : 'none'});
						$(this).find('.sku').css({'display' : 'none'});
						$(this).find('.rating').css({'display' : 'none'});
						$(this).find('.full-name').css({'display' : 'none'});
						$(this).find('.short-name').css({'display' : 'block'});
					});

		}
	}

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

	function displayDelivery()
	{
		$('#content2').css('display','block');

	}
	function hideDelivery()
	{
		$('#content2').css('display','none');

	}


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


