<?php if ($products){ ?>
<div class="box">
    <div class="box-heading"><?php echo $heading_title; ?></div>
    <div class="box-content">
        <div class="box-product">
        <!-- 
        <?php print_r($products)?>
         -->
            <?php foreach ($products as $product) { ?>
            <div style="width:272px; margin-right:7px; float:left;">
                <?php if ($product['thumb']) { ?>
                <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
                <?php } ?>
                <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                <?php if ($product['price']) { ?>
                <div class="price">
                    <?php if (!$product['special']) { ?>
                    <?php echo $product['price']; ?>
                    <?php } else { ?>
                    <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php if ($product['rating']) { ?>
                <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                <?php } ?>
                <div class="cart">
				
				
				
				<form class="add_to_cart" method="post">
				<div class="container_list_product" style="width:70px;">
				<input class="q-mini" type="hidden" name="product_id" size="2" value="<?php echo $product['product_id']; ?>" />
											<input class="q-mini" type="hidden" name="quantity" size="2" value="1" />
											<input id="product_name" type="hidden" value="<?php echo $product['name']; ?>">
														<input id="product_price" type="hidden" value="<?php echo ($product['special'] ? $product['special'] : $product['price']); ?>">
														<input type="hidden" id="product_url" value="<? echo($this->url->link('product/product&product_id=' . $product['url']));?>"/>
														<!--<div id="option-<?php echo $product['product_id']; ?>" class="option">-->
														<select class="selectare" name="option[<?php echo $product['option'][0]['product_option_id']; ?>]">

														<option value="0">Выберите <?echo $product['option'][0]['name'];?></option>
														<?php
															foreach($product['option'][0]['product_option_value'] as $option) {
																?>
																	
																	<option value="<?php echo $option['product_option_value_id']; ?>"><?php echo $option['name']; ?>
																	<?php /*if ($size['price']) { ?>
																	(<?php echo $size['price_prefix']; ?><?php echo $size['price']; ?>)
																	<?php } */?>
																	</option>
																<?
															}
																						
														?>
														</select>
				</div>
				
											<div class="cart"><input type="submit" class="button ajax_add" value="Купить" /></div>
											</form>
				</div>
				
			 </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>