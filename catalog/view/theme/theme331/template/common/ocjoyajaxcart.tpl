<div id="ajaxcartmodal">
    <?php if (!empty($products)) { ?>
        <div class="mini-cart-infos">
	    <div id="headajaxcart" style="padding-left:20px;"><?php echo $text_ajaxcart_head; ?></div>
	    <br /><br />
	    <img src="image/ocjoyajaxcart/loading.gif" id="ajaxcartloadimg"/>
	    <div class="ajaxtable_table">
	        <div class="ajaxtable_thead">
	       		<div class="ajaxtable_tr">
		        	<div class="ajaxtable_td image"><?php echo $column_image; ?></div>
					<div class="ajaxtable_td name"><?php echo $column_name; ?></div>
					<?php if($config_ocjoyajaxcart_showmodel == 1) { ?>
					<div class="ajaxtable_td model"><?php echo $column_model; ?></div>
					<?php } ?>
					<?php if($config_ocjoyajaxcart_showsku == 1) { ?>
					<div class="ajaxtable_td sku"><?php echo $column_sku; ?></div>
					<?php } ?>
		            <div class="ajaxtable_td price"><?php echo $column_price; ?></div>
		            <div class="ajaxtable_td quantity"><?php echo $column_quantity; ?></div>
		            <div class="ajaxtable_td subtotal"><?php echo $column_subtotal; ?></div>
		            <div class="ajaxtable_td delete"></div>
	          	</div>
	        </div>
        	<div class="ajaxtable_tbody">
    			<?php foreach ($products as $product) { ?>	
    			<?php $op = explode(":", $product['key']); ?>
            	<div id="pid-<?=$product['key'] ?>" class="ajaxtable_tr">
            		<div class="ajaxtable_td image">
            			<?php if ($product['thumb']) { ?>
           					<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
            			<?php } ?>
            		</div>
		    		<div class="ajaxtable_td name">
						<?php echo $product['name']; ?> <br>
		    			<a href="<?=$product['href'] ?>">Подробнее</a>
		    			<div class="ajaxcartoptionname">
			                <?php foreach ($product['option'] as $option) { ?>
			                <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
			                <?php } ?>
			                <?php if ($product['reward']) { ?>
				              <small><?php echo $product['reward']; ?></small>
				            <?php } ?>
			            </div> 
		    		</div>
		    		<?php if($config_ocjoyajaxcart_showmodel == 1) { ?>
		    		<div class="ajaxtable_td model">
		    			<?php echo $product['model']; ?>
		    		</div>
		    		<?php } ?>
		    		<?php if($config_ocjoyajaxcart_showsku == 1) { ?>
		    		<div class="ajaxtable_td sku">
		    			<?php echo $product['sku']; ?>
		    		</div>
		    		<?php } ?>
		            <div class="ajaxtable_td price" id="price-<?=$product['key'] ?>"><?=$product['price']; ?></div>
		    		<div class="ajaxtable_td quantity">
						<input hidden class="product_id" value="<?=$product['key']; ?>" style="display:none;"/>
		                <a onclick="minus(this);" type="button" class="btn btn-minus quantity-m"><span>&ndash;</span></a>
						<span class="cart-amount-text qt" name="quainty"><?php echo $product['quantity']; ?></span>
		            <a onclick="plus(this);"  type="button" class="btn btn-plus quantity-p"><span>+</span></a>
		            </div>
		            <div class="ajaxtable_td subtotal"><?php echo $product['total']; ?></div>		
		    		<div class="ajaxtable_td delete">
						<input hidden class="product_id" value="<?=$product['key']; ?>"/>
						<a type="button" class="btn btn-delete" onclick="del(this);"><span>&times;</span></a></td>
		            </div>
    			</div> 
	          	<?php } ?>
      		</div>
      		</div>
    </div>


    <div id="ajaxcheckout">
    	<a onclick="$.colorbox.close();" id="gotoshopping" type="button" class="btn"><?php echo $text_gotoshipping; ?></a>
    	<a href="<?php echo $checkout; ?>" id="gotoorder" type="button" class="btn"><?php echo $text_gotoorder; ?></a>
    </div>

    <?php if (!empty($ajaxcartproducts)) { ?>  
	<div id="ajaxheadproducts"><?php echo $this->config->get('config_textforproducts'); ?></div>
	<div class="carousel-ajcart"> 
		<div class="carousel-button-left-ajcart"><a href="javascript:void(0);"><img src="image/ocjoyajaxcart/carousel-left.png"/></a></div> 
		<div class="carousel-button-right-ajcart"><a href="javascript:void(0);"><img src="image/ocjoyajaxcart/carousel-right.png"/></a></div> 
		<div class="carousel-wrapper-ajcart"> 
		    <div class="carousel-items-ajcart"> 
			    <?php foreach ($ajaxcartproducts as $product) { ?>
			     	<div class="carousel-block-ajcart">
			            <div class="name"><a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>"><?php $pname = mb_substr(strip_tags(html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8')),0,$config_ocjoyajaxcart_countname, 'utf-8'); echo $pname . ' ...'; ?></a></div>
			            <?php if ($product['thumb']) { ?>
			            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
			            <?php } ?>
			            <?php if ($product['description']) { ?>
			            <div class="description"><?php $pdesc = mb_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')),0,$config_ocjoyajaxcart_countdesc, 'utf-8'); echo $pdesc . ' ...'; ?></div>
			            <?php } ?>
			            <div class="block">
			              <?php if ($product['price']) { ?>
			              <div class="price">
			                <?php if (!$product['special']) { ?>
			                <?php echo $product['price']; ?>
			                <?php } else { ?>
			                <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
			                <?php } ?>
			              </div>
			              <?php } ?>
			              <div class="cart"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div>
			            </div>
			            <div class="block2">
			              <a onclick="addToWishList('<?php echo $product['product_id']; ?>');" class="link"><?php echo $button_wishlist; ?></a>
			              <a onclick="addToCompare('<?php echo $product['product_id']; ?>');" class="link"><?php echo $button_compare; ?></a>
			            </div>
			            <?php if ($product['rating']) { ?>
			            <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
			            <?php } ?>
			        </div>
			    <?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>

    <?php } else { ?>

    <div class="mini-cart-infos">
      <div id="headajaxcart"><?php echo $text_ajaxcart_empty; ?></div>
		<img src="image/ocjoyajaxcart/loading.gif" id="ajaxcartloadimg"/>
	       <div class="cart-empty">
				<a onclick="$.colorbox.close();" id="gotoshopping" type="button" class="btn"><?php echo $text_gotoshipping; ?></a>
		   </div>
    </div>
    <?php } ?>

<script type="text/javascript">


function updateCart(id) {
	$('#ajaxcartloadimg').show();
	$('.quantity-p').click();
}

function plus(id){
	var textSpan = $(id).siblings('.cart-amount-text');
	var quantity = +(textSpan.text());
	quantity = quantity + 1;
	var pid = $(id).parent().children('.product_id').val();
	$.ajax({
		url: 'index.php?route=common/ocjoyajaxcart&update='+pid+'&qty='+quantity,
		type: 'post',
		dataType: 'html',
		success:function(data) {	
	        $.colorbox({
		       	href:'index.php?route=common/ocjoyajaxcart',
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
	   		$('#cart').load('index.php?route=module/cart #cart > *');
		}		
	});
}
function minus(id){
	var textSpan = $(id).siblings('.cart-amount-text');
	var quantity = +(textSpan.text());
	if(quantity > 0) {
		quantity = quantity - 1;
	}
	var pid = $(id).parent().children('.product_id').val();
	$.ajax({
		url: 'index.php?route=common/ocjoyajaxcart&update='+pid+'&qty='+quantity,
		type: 'post',
		dataType: 'html',
		success:function(data) {
	        $.colorbox({
		       	href:'index.php?route=common/ocjoyajaxcart',
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
	   		$('#cart').load('index.php?route=module/cart #cart > *');
		}		
	});
}
function del(id){
	pid = $(id).parent().children('.product_id').val();
	quantity = 0;
	$.ajax({
		url: 'index.php?route=common/ocjoyajaxcart&update='+pid+'&qty='+quantity,
		type: 'post',
		dataType: 'html',
		success:function(data) {	
	        $.colorbox({
		       	href:'index.php?route=common/ocjoyajaxcart',
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
	   		$('#cart').load('index.php?route=module/cart #cart > *');
		}		
	});
}
</script>
</div>