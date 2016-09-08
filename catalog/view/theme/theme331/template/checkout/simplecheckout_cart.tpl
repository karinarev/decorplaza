<h2>Корзина покупок</h2>
<div class="cart-area">
<?php if ($attention) { ?>
<div class="simplecheckout-warning-block"><?php echo $attention; ?></div>
<?php } ?>
<?php if ($error_warning) { ?>
<div class="simplecheckout-warning-block"><?php echo $error_warning; ?></div>
<?php } ?>
<table class="simplecheckout-cart table">
    <colgroup>
        <col class="image">
        <col class="name">
        <col class="price">
        <col class="quantity">
        <col class="total">
        <col class="remove">
    </colgroup>
    <thead>
    <tr>
        <th class="image"><?php echo $column_image; ?></th>
        <th class="name"><?php echo $column_name; ?></th>
        <th class="price"><?php echo $column_price; ?></th>
        <th class="quantity"><?php echo $column_quantity; ?></th>
        <th class="total"><?php echo $column_total; ?></th>
        <th class="remove"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product) { ?>
    <?php if (!empty($product['recurring'])) { ?>
    <tr>
        <td class="simplecheckout-recurring-product" style="border:none;"><image src="catalog/view/theme/default/image/reorder.png" alt="" title="" style="float:left;" /><span style="float:left;line-height:18px; margin-left:10px;">
                    <strong><?php echo $text_recurring_item ?></strong>
                <?php echo $product['profile_description'] ?>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <td class="image">
            <?php if ($product['thumb']) { ?>
            <img class="cart-image"  src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
            <a class="more product-icon" href="<?php echo $product['href']; ?>"></a>
            <?php } ?>
        </td>
        <td class="name">
            <p class="product-name"><?php echo $product['name']; ?></p>
            <p class="product-model">Артикул <?php echo $product['model']; ?> </p>
            <a href="<?php echo $product['href']; ?>" class="cart-link-more">Подробнее</a>
            <?php if (!$product['stock'] && ($config_stock_warning || !$config_stock_checkout)) { ?>
            <span class="product-warning">***</span>
            <?php } ?>
            <div class="options">
                <?php foreach ($product['option'] as $option) { ?>
                &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                <?php } ?>
                <?php if (!empty($product['recurring'])) { ?>
                - <small><?php echo $text_payment_profile ?>: <?php echo $product['profile_name'] ?></small>
                <?php } ?>
            </div>
            <? $existcoupon = false; ?>
            <?php foreach ($totals as $total) { ?>
            <? if ($total['code'] == 'coupon') { ?>
            <? $existcoupon = true; ?>
            <?php } ?>
            <? } ?>
            <? if ($product['rasprodaga'] && $existcoupon) { ?>
            <div class="not_coupon">Скидка не распространяется на товары, находящиеся в разделе Распродажа</div>
            <? } ?>
            <?php if ($product['reward']) { ?>
            <small><?php echo $product['reward']; ?></small>
            <?php } ?>
        </td>
        <td class="price"><nobr><?php echo $product['price']; ?></nobr></td>
        <td class="quantity">
            <input hidden class="product_id" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" style="display:none;"/>
            <a <?php if ($quantity > 1) { ?>onclick="minus(this)"<?php } ?> type="button" class="btn btn-minus"><span>&ndash;</span></a>
            <span class="cart-amount-text qt" name="quainty"><?php echo $product['quantity']; ?></span>
            <a onclick="plus(this)"  type="button" class="btn btn-plus"><span>+</span></a>
       </td>
        <td class="total"><nobr><?php echo $product['total']; ?></nobr></td>
        <td class="remove">
            <a type="button" class="btn btn-delete" onclick="jQuery('#simplecheckout_remove').val('<?php echo $product['key']; ?>');simplecheckout_reload('product_removed');"><span>&times;</span></a>
        </td>
    </tr>
    <?php } ?>
    <?php foreach ($vouchers as $voucher_info) { ?>
    <tr>
        <td class="image"></td>
        <td class="name"><?php echo $voucher_info['description']; ?></td>
        <td class="model"></td>
        <td class="quantity">1</td>
        <td class="price"><nobr><?php echo $voucher_info['amount']; ?></nobr></td>
        <td class="total"><nobr><?php echo $voucher_info['amount']; ?></nobr></td>
        <td class="remove">
            <img style="cursor:pointer;" src="<?php echo $simple->tpl_joomla_path() ?>catalog/view/image/close.png" onclick="jQuery('#simplecheckout_remove').val('<?php echo $voucher_info['key']; ?>');simplecheckout_reload('product_removed');" />
        </td>
    </tr>
    <?php } ?>
    <tr class="last-tr">
        <td></td>
        <td colspan="2" class="cart-promo">
            <?php if (isset($modules['coupon'])) { ?>
            <div class="simplecheckout-cart-promo">
                <label for="input-promo" class="cart-promo-label">Введите промокод:</label>
                <input type="text"  id="input-promo" class="form-control input-promo" name="coupon" value="<?php echo $coupon; ?>" onchange="simplecheckout_reload('coupon_changed')"  />
                <br><button class="btn-promo btn">Применить промокод</button>
            </div>
            <?php } ?>
            <?php if (isset($modules['reward']) && $points > 0) { ?>
            <div class="simplecheckout-cart-promo">
                <label for="input-promo" class="cart-promo-label">Введите промокод:</label>
                <input type="text" id="input-promo" class="form-control input-promo" name="reward" value="<?php echo $reward; ?>" onchange="simplecheckout_reload('reward_changed')"  />
                <br><button class="btn-promo btn">Применить промокод</button>
            </div>
            <?php } ?>
            <?php if (isset($modules['voucher'])) { ?>
            <div class="simplecheckout-cart-promo">
                <label for="input-promo" class="cart-promo-label">Введите промокод:</label>
                <input type="text"  id="input-promo" class="form-control input-promo" name="voucher" value="<?php echo $voucher; ?>" onchange="simplecheckout_reload('voucher_changed')"  />
                <br><button class="btn-promo btn">Применить промокод</button>
            </div>
            <?php } ?>
              </td>
        <td colspan="3" class="cart-total">
            <table class="table total-table">
                <?php foreach ($totals as $total) { ?>
                <tr>
                    <th class="text-left"><?php echo $total['title']; ?>:</th>
                    <td class="text-left"><?php echo $total['text']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
    </tbody>
</table>


<input type="hidden" name="remove" value="" id="simplecheckout_remove">
<div style="display:none;" id="simplecheckout_cart_total"><?php echo $cart_total ?></div>

</div>
<script type="text/javascript">

    function plus(info) {
        var textSpan = $(info).siblings('.cart-amount-text');
        var currentNumber = +(textSpan.text());
        currentNumber = currentNumber + 1;
        textSpan.text(currentNumber);

        $(info).siblings('.product_id').val(currentNumber);

        simplecheckout_reload('cart_value_increased');
    }

    function minus(info) {
        var textSpan = $(info).siblings('.cart-amount-text');
        var currentNumber = +(textSpan.text());
        if(currentNumber > 0) {
            currentNumber = currentNumber - 1;
            textSpan.text(currentNumber);
        }

        $(info).siblings('.product_id').val(currentNumber);

        simplecheckout_reload('cart_value_decreased');
    }


    jQuery(function(){
        jQuery('#cart_total').html('<?php echo $cart_total ?>');
        jQuery('#cart-total').html('<?php echo $cart_total ?>');
        jQuery('#cart_menu .s_grand_total').html('<?php echo $cart_total ?>');
        <?php if ($simple_show_weight) { ?>
            jQuery('#weight').text('<?php echo $weight ?>');
        <?php } ?>
        <?php if ($template == 'shoppica2') { ?>
            jQuery('#cart_menu div.s_cart_holder').html('');
            $.getJSON('index.php?<?php echo $simple->tpl_joomla_route() ?>route=tb/cartCallback', function(json) {
                if (json['html']) {
                    jQuery('#cart_menu span.s_grand_total').html(json['total_sum']);
                    jQuery('#cart_menu div.s_cart_holder').html(json['html']);
                }
            });
        <?php } ?>
        <?php if ($template == 'shoppica') { ?>
            jQuery('#cart_menu div.s_cart_holder').html('');
            jQuery.getJSON('index.php?<?php echo $simple->tpl_joomla_route() ?>route=module/shoppica/cartCallback', function(json) {
                if (json['output']) {
                    jQuery('#cart_menu span.s_grand_total').html(json['total_sum']);
                    jQuery('#cart_menu div.s_cart_holder').html(json['output']);
                }
            });
        <?php } ?>
    });
</script>
<?php if ($simple->get_simple_steps() && $simple->get_simple_steps_summary()) { ?>
<div id="simple_summary" style="display: none;margin-bottom:15px;">
    <table class="simplecheckout-cart">
        <colgroup>
            <col class="image">
            <col class="name">
            <col class="model">
            <col class="quantity">
            <col class="price">
            <col class="total">
        </colgroup>
        <thead>
        <tr>
            <th class="image"><?php echo $column_image; ?></th>
            <th class="name"><?php echo $column_name; ?></th>
            <th class="model"><?php echo $column_model; ?></th>
            <th class="quantity"><?php echo $column_quantity; ?></th>
            <th class="price"><?php echo $column_price; ?></th>
            <th class="total"><?php echo $column_total; ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product) { ?>
        <tr>
            <td class="image">
                <?php if ($product['thumb']) { ?>
                <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                <?php } ?>
            </td>
            <td class="name">
                <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                <?php if (!$product['stock'] && ($config_stock_warning || !$config_stock_checkout)) { ?>
                <span class="product-warning">***</span>
                <?php } ?>
                <div class="options">
                    <?php foreach ($product['option'] as $option) { ?>
                    &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                    <?php } ?>
                </div>
                <?php if ($product['reward']) { ?>
                <small><?php echo $product['reward']; ?></small>
                <?php } ?>
            </td>
            <td class="model"><?php echo $product['model']; ?></td>
            <td class="quantity"><?php echo $product['quantity']; ?></td>
            <td class="price"><nobr><?php echo $product['price']; ?></nobr></td>
            <td class="total"><nobr><?php echo $product['total']; ?></nobr></td>
        </tr>
        <?php } ?>
        <?php foreach ($vouchers as $voucher_info) { ?>
        <tr>
            <td class="image"></td>
            <td class="name"><?php echo $voucher_info['description']; ?></td>
            <td class="model"></td>
            <td class="quantity">1</td>
            <td class="price"><nobr><?php echo $voucher_info['amount']; ?></nobr></td>
            <td class="total"><nobr><?php echo $voucher_info['amount']; ?></nobr></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

    <?php foreach ($totals as $total) { ?>
    <div class="simplecheckout-cart-total" id="total_<?php echo $total['code']; ?>">
        <span><b><?php echo $total['title']; ?>:</b></span>
        <span class="simplecheckout-cart-total-value"><nobr><?php echo $total['text']; ?></nobr></span>
    </div>
    <?php } ?>

    <?php if ($summary_comment) { ?>
    <table class="simplecheckout-cart simplecheckout-summary-info">
        <thead>
        <tr>
            <th class="name"><?php echo $text_summary_comment; ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $summary_comment; ?></td>
        </tr>
        </tbody>
    </table>
    <?php } ?>
    <?php if ($summary_payment_address || $summary_shipping_address) { ?>
    <table class="simplecheckout-cart simplecheckout-summary-info">
        <thead>
        <tr>
            <th class="name"><?php echo $text_summary_payment_address; ?></th>
            <?php if ($summary_shipping_address) { ?>
            <th class="name"><?php echo $text_summary_shipping_address; ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $summary_payment_address; ?></td>
            <?php if ($summary_shipping_address) { ?>
            <td><?php echo $summary_shipping_address; ?></td>
            <?php } ?>
        </tr>
        </tbody>
    </table>
    <?php } ?>
</div>
<?php } ?>

<script type="text/javascript"><!--
    $('.product-icon').css({'display' : 'none'});

    $('td.image').hover(
            function () {
                $(this).find('img').addClass('image-hover');
                $(this).find('.product-icon').css({'display' : 'block'});
            },
            function (){
                $(this).find('img').removeClass('image-hover');
                $(this).find('.product-icon').css({'display' : 'none'});

            });

--></script>