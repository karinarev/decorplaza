<?php echo $header; ?>
<?php echo $column_left; ?>
		<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
  <?
if(isset($_GET['catId'])){
$breadcrumbs[2]["text"]=$heading_title;
}
  ?>
  
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php
	if(isset($breadcrumb['href'])){
	echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
	<?}else{
	echo $breadcrumb['separator']; ?><?php echo $breadcrumb['text']; ?>
	<?}?>
    <?php } ?>
  </div>
  <?php echo $content_top; ?>
  <h1><?php echo $heading_title; ?></h1> 
  <div class="description">
		
	</div>
  <?php if ($products) { ?>
  <div class="product-filter">
    <div class="display"><b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display('grid');"><?php echo $text_grid; ?></a></div>
      <div class="sort"><b><?php echo $text_sort; ?></b>
      <select onchange="location = this.value;">
        <?php foreach ($sorts as $sorts) { ?>
        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
        <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
      <?/*<div class="sort cat_arr"><b>Категории: </b>
     
	  <? // var_dump($this->data['manArr']);?>
      <select onchange="location = this.value;">
		<option value="<?php echo $linkmanufacturer; ?>">Все категории</option>	
        <?php foreach ($catArr as $item) { ?>		
			<? if ($item['countproduct']>0) { ?>
			<option <?php if($item['category_id'] == $this->request->get['catId']) echo 'selected="selected"' ?> value="<?php echo $item['href']; ?>"><?php echo $item['name']; ?></option>	
			<?php foreach ($item['children'] as $value) { ?>
				<? if ($value['countproduct']>0) { ?>
					<option <?php if($value['category_id'] == $this->request->get['catId']) echo 'selected="selected"' ?> value="<?php echo $value['href']; ?>"><?php echo $value['name']; ?></option>		   
				<?php } ?>
			<?php } ?>
			<? }?>
        <?php } ?>
      </select>
    </div>  */?>

    <div class="sort man_arr"><b>Фильтрация:</b> 
   
	  <? //var_dump($this->data['$manArr']);?>
      <select onchange="location = this.value;">
		<option value="<?php echo $linkcategory; ?>">Все производители</option>	
        <?php foreach ($manArr as $item) { ?>		
			
			<option <?php if($item['manufacturer_id'] == $this->request->get['manufacturer_id']) echo 'selected="selected"' ?> value="<?php echo $item['href']; ?>"><?php echo $item['name']; ?></option>	
			
			
        <?php } ?>
      </select>
    </div> 

	
	<div class="limit"><?php echo $text_limit; ?>
      <select onchange="location = this.value;">
        <?php foreach ($limits as $limits) { ?>
        <?php if ($limits['value'] == $limit) { ?>
        <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
<div class="product-compare"><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></div>
  </div>
  
  <div class="product-grid">
	<ul class="row">
		<?php $i=0; foreach ($products as $product) { $i++; ?>
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
		<script type="text/javascript">
				$(document).ready(function(){
					$("a.colorbox<?php echo $i?>").colorbox({
					rel: 'colorbox',
					inline:true,
					html: true,
					width:'58%',
					maxWidth:'780px',
					height:'70%',
					open:false,
					returnFocus:false,
					fixed: false,
					title: false,
					href:'.quick-view<?php echo $i;?>',
					current:'Product {current} of {total}'
					});
					});
				</script> 

		<li class="col-sm-4 <?php echo $a?>">
		<div class="quickview">
			<div style="display:none;">
				<div  class="quick-view<?php echo $i;?> preview">
					<div class="wrapper marg row">
						<div class="left col-sm-4">
							<?php if ($product['thumb']) { ?>
								<div class="image3">
									<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a>
									
								</div>
							<?php } ?>
						</div>
						<div class="right col-sm-8">
							<p class="my_h2"><?php echo $product['name']; ?></p>
							<div class="inf">
								<?php if ($product['author']) {?>
									<span class="manufacture"><?php echo "Брэнд:"; ?> <a href="<?php echo $product['manufacturers'];?>"><?php echo $product['author']; ?></a></span>
								<?php }?>
								<?php if ($product['model']) {?>
									<span class="model"><?php echo $text_model; ?><?php echo $product['model']; ?></span>
								<?php }?>
								<span class="prod-stock-2"><?php echo "Наличие:"; ?></span>
									
									<?php
									   if ($product['text_availability'] > 0) { ?>
									 <span class="prod-stock"><?php echo $product['text_instock']; ?></span>
									<?php } else { ?>
										   <span class="prod-stock"><?php echo $text_outstock; ?></span>
									 <?php
									 }	
									 ?>
								<?php if ($product['price']) { ?>
									<div class="price">
								  <span class="text-price"><?php echo $text_price; ?></span>
								  <?php if (!$product['special']) { ?>
								  <?php echo $product['price']; ?>
								  <?php } else { ?>
								  <span class="price-new"><?php echo $product['special']; ?></span><span class="price-old"><?php echo $product['price']; ?></span>
								  <?php } ?>
								  
								</div>
								<?php } ?>
							</div>
							<div class="cart-button">
								<div class="cart">
									<a href="<?php echo $product['href']; ?>" title="<?php echo $button_cart; ?>" data-id="<?php echo $product['product_id']; ?>;" class="button  ">
										<!--<i class="fa fa-shopping-cart"></i>-->
										<span><?php echo $button_cart; ?></span>
									</a>
								</div>
								
								<div class="wishlist">
									<a class="tooltip-1" title="<?php echo $button_wishlist; ?>"  onclick="addToWishList('<?php echo $product['product_id']; ?>');">
										<i class="fa fa-star"></i>
										<span><?php echo $button_wishlist; ?></span>
									</a>
								</div>
								<div class="compare">
									<a class="tooltip-1" title="<?php echo $button_compare; ?>"  onclick="addToCompare('<?php echo $product['product_id']; ?>');">
										<i class="fa fa-bar-chart-o"></i>
										<span><?php echo $button_compare; ?></span>
									</a>
								</div>
								<span class="clear"></span>
							</div>
							<div class="clear"></div>
							<!--<div class="rating">
								<img height="18" src="catalog/view/theme/theme331/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" />
							</div>-->
						</div>
					</div>
					<div class="description">
						<?php echo $product['description_poln'];?>
					</div>
					
				</div>
			</div>
			<a href="<?php echo $product['href']; ?>"   rel="colorbox" class="colorbox<?php echo $i;?> quick-view-button"><i class=" fa fa-search "></i></a>
		</div>

		<div class="padding">
		
		<?php if ($product['thumb']) { ?>
		<div class="image"><a href="<?php echo $product['href']; ?>"><img id="img_<?php echo $product['product_id']; ?>" src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a>
		
		<?php if($product['newItem']) { ?>
			<div class="newItem"><img width="75" src="/image/new.png"></div>
		<?php } ?>
		
		<?php if($product['special']) { ?>
			<div class="specialItem"><img width="75" src="/image/sale.png"></div>
		<?php } ?>
	
		<?php if($product['bestSeller']) { ?>
			<div class="best_seller"><img width="75" src="/image/best_seller.png"></div>
		<?php } ?>
		
		</div>
	    <?php } ?>
	    
		








		<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name'];?></a></div>
		<div class="description"><?php echo $product['description']; ?>
				<!-- OCFilter start -->
				<?php if ($product['ocfilter_products_options']) { ?>
			  <?php if (is_array($product['ocfilter_products_options'])) { ?>
			  <ul class="product-ocfilter-options">
			    <?php foreach ($product['ocfilter_products_options'] as $ocfilter_option) { ?>
			    <li><span class="product-ocfilter-option"><?php echo $ocfilter_option['name']; ?>:</span> <span class="product-ocfilter-value"><?php echo $ocfilter_option['values']; ?></span></li>
			    <?php } ?>
			  </ul>
			  <?php } else { ?>
			  <?php echo $product['ocfilter_products_options']; ?>
			  <?php } ?>
			  <?php } ?>
				<!-- OCFilter end -->
			</div>
						<div class="prod-stock" style="margin-bottom:10px;">
			<?php if($product['text_instock'] == "Есть в наличии" || $product['text_instock'] == 'В наличии'){ $color = '#3079ED';} if($product['text_instock'] == "Нет в наличии" || $product['text_instock'] == "Предзаказ" || $product['text_instock'] == "Ожидание 2-3 дня"){ $color = '#9d9d9d';}?>
				<span style="color:<?=$color;?>;">
					<?php echo $product['text_instock'];?>
				</span>
			</div>
			<style>
			.prod-stock span {
				font-size: 15px;				
				font-weight: bold;
				font-style:normal;
			}
			</style>
		<?php if ($product['price']) { ?>
		<div class="price">
		<?php if ($product['tax']) { ?>
		<span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
		<?php } ?>
		<?php if (!$product['special']) { ?>
		<?php echo $product['price']; ?>
		<?php } else { ?><span class="price-new"><?php echo $product['special']; ?></span>
		<span class="price-old"><?php echo $product['price']; ?></span> 
		<?php } ?>
		</div>
		<?php } ?>
	
		<div class="cart-button">
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

		
	
		</div>
			<div class="cart"><input type="submit" class="button ajax_add" value="<?php echo $button_cart; ?>" /></div>
			</form>
			<div class="wishlist"><a class="tooltip-1 " title="<?php echo $button_wishlist; ?>"  onclick="addToWishList('<?php echo $product['product_id']; ?>');"><i class="fa fa-star"></i></a></div>
			<div class="compare"><a class="tooltip-1" title="<?php echo $button_compare; ?>"  onclick="addToCompare('<?php echo $product['product_id']; ?>');"><i class="fa fa-bar-chart-o"></i></a></div>
			<div class="clear"></div>
		</div>
		<div class="rating">
			<?php if ($product['rating']) { ?>
			<img height="13" src="catalog/view/theme/theme331/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" />
			<?php } ?>
		</div>
		</div>
	</li>
		<?php } ?>
	 </ul>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } else { ?>
  <div class="box-container">
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a></div>
  </div>
  
  </div>
  
  <?php }?>
  

<?php echo $content_bottom; ?></div>

 <a class="various" href="#inline" style="display:none;"> </a>
<div id="inline" style="display:none;"><span style="color:red">Выберите размер</span></div>

<div class="manufacturer-info">
	<!--<?php if ($thumb) { ?>
	<div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
	<?php } ?>-->

	<?php if ($description) { ?>
	<?php echo $description; ?>
	<?php } ?>

<? if (!$this->request->get['catId']) { ?>
	<br>
	<div >
	<?php foreach ($catArr as $item) { ?>		
		<? if ($item['countproduct']>0) { ?>
		
		<? echo('<a href="'.$item['href'].'">'.$item['name'].'</a><br>'); ?>
		<?php foreach ($item['children'] as $value) { ?>
			<? if ($value['countproduct']>0) { ?>
				<? echo('<a href="'.$value['href'].'">'.$value['name'].'</a><br>'); ?>
				
			<?php } ?>
		<?php } ?>
		
		
		
		<? }?>
	<?php } ?>
	</div>
<?php } ?>
  </div>



<?php echo $column_right; ?>

<script type="text/javascript"><!--
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


        
			<?php echo $ocscroll; ?>
		
      
<?php echo $footer; ?>