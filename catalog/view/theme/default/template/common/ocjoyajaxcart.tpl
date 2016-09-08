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
					<?php //if($config_ocjoyajaxcart_showmodel == 1) { ?>
					<!--div class="ajaxtable_td model"><?php echo 'Модель'; ?></div-->
					<?php //} ?>
					<?php //if($config_ocjoyajaxcart_showsku == 1) { ?>
					<!--div class="ajaxtable_td sku"><?php //echo $column_sku; ?></div-->
					<?php //} ?>
		            <div class="ajaxtable_td price"><?php echo $column_price; ?></div>
		            <div class="ajaxtable_td quantity"><?php echo $column_quantity; ?></div>
		            <div class="ajaxtable_td subtotal"><?php echo $column_subtotal; ?></div>
		            <div class="ajaxtable_td delete"><?php echo $column_delete; ?></div>
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
		    			<a href="<?=$product['href'] ?>"><?php echo $product['name']; ?></a>
		    			<div class="ajaxcartoptionname">
			                <?php foreach ($product['option'] as $option) { ?>
			                <small>Option <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
			                <?php } ?>
			                <?php if ($product['reward']) { ?>
				              <small><?php echo $product['reward']; ?></small>
				            <?php } ?>
			            </div> 
		    		</div>
		    		<?php //if($config_ocjoyajaxcart_showmodel == 1) { ?>
		    		<!--div class="ajaxtable_td model">
		    			<?php //echo $product['model']; ?>
		    		</div-->
		    		<?php //} ?>
		    		<?php //if($config_ocjoyajaxcart_showsku == 1) { ?>
		    		<!--div class="ajaxtable_td sku">
		    			<?php //echo $product['sku']; ?>
		    		</div-->
		    		<?php //} ?>
		            <div class="ajaxtable_td price" id="price-<?=$product['key'] ?>"><?=$product['price']; ?></div>
		    		<div class="ajaxtable_td quantity">
						<input hidden class="product_id" value="<?=$product['key']; ?>" style="display:none;"/>
		                <a onclick="minus(this);" class="quantity-m">-</a>
		                <input value="<?php echo $product['quantity']; ?>" name="quainty"   class="qt" onchange="return validate(this); updateCart();" maxlength="4" onkeyup="return validate(this);">
		            <a onclick="plus(this);"  class="quantity-p">+</a>
		            </div>
		            <div class="ajaxtable_td subtotal"><?php echo $product['total']; ?></div>		
		    		<div class="ajaxtable_td delete">
						<input hidden class="product_id" value="<?=$product['key']; ?>" style="display:none;"/>
		                <a onclick="del(this);" style="text-align:center;margin:0 auto;"><img src="image/ocjoyajaxcart/ajaxdelateproduct.png" ></a>
		            </div>
    			</div> 
	          	<?php } ?>
      		</div>
      		<div id="hideproducts" onclick="$(this).colorbox.resize();"><span>Показать <b></b> <i></i></span><span style="display:none;">Скрыть <b></b> <i></i></span></div>
      	</div>
    </div>
    
	<div class="ajaxtable_table2">
		<div class="ajaxtable_tbody2">
    		<?php foreach ($totals as $total) { ?>
            <div id="ajaxtotal" class="ajaxtable_tr2">
            	<div class="ajaxtable_td2 price" style="text-align:right;width:90%;"><b><?php echo $total['title']; ?></b> <b>:</b></div>
            	<div class="ajaxtable_td2 total" style="text-align:left;padding-left:8px;" ><nobr><?php echo $total['text']; ?></nobr></div>
            </div>
        	<?php } ?>
  		</div>
    </div>

    <div id="ajaxcheckout">
    	<a onclick="$.colorbox.close();" id="gotoshopping"><?php echo $text_gotoshipping; ?></a>
    	<a href="<?php echo $checkout; ?>" id="gotoorder"><?php echo $text_gotoorder; ?></a>
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
			            <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
			            <?php if ($product['thumb']) { ?>
			            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
			            <?php } ?>
			            <?php if ($product['description']) { ?>
			            <div class="description"><?php echo $product['description']; ?></a></div>
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
      <div id="headajaxcart" style="padding-left:20px;"><?php echo $text_ajaxcart_empty; ?></div>
		<img src="image/ocjoyajaxcart/loading.gif" id="ajaxcartloadimg"/>
		<table class="ajaxtotaltable">
	          <tr id="ajaxtotal">
	            <td>
	            	<div id="ajaxcartempty"><a onclick="$.colorbox.close();"><?php echo $text_ajaxcart_continue; ?></a></div>
	            </td>
	          </tr>
      	</table>
    </div>
    <?php } ?>
<script type="text/javascript">
$('.ajaxtable_tbody .ajaxtable_tr').css('display', 'none');
for (i=0;i<3;i++){
    $(".ajaxtable_tbody .ajaxtable_tr:eq(" + i + ")").css('display', 'table-row');
}
var hidethis = false,
show_tr = function () {
	for (i=3;i<100;i++){
    	$(".ajaxtable_tbody .ajaxtable_tr:eq(" + i + ")").css('display', 'table-row');
	}
	},
hide_tr = function() {
	for (i=100;i>2;i--){
    	$(".ajaxtable_tbody .ajaxtable_tr:eq(" + i + ")").css('display', 'none');
	}
};
$("#hideproducts span").click(function(){
	if(!hidethis){
		show_tr();
	} else {
		hide_tr();
	}
	hidethis = !hidethis;
	$('#hideproducts span').toggle();
});
</script>
<script type="text/javascript">
function updateCart(id) {
	$('#ajaxcartloadimg').show();
	$('.quantity-p').click();
}
function validate(input) {
    input.value = input.value.replace(/[^\d,]/g, '');
};
function plus(id){
	var quantity = parseInt($(id).parent().children('.qt').val());
	quantity = quantity + 1;
	pid = $(id).parent().children('.product_id').val();
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
	var quantity = parseInt($(id).parent().children('.qt').val());
	quantity = quantity - 1;
	pid = $(id).parent().children('.product_id').val();
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