<div class="simplecheckout-block-heading"><h2>Доставка и оплата</h2></div>
<?php if ($simple_show_errors && $error_warning) { ?>
<div class="simplecheckout-warning-block"><?php echo $error_warning ?></div>
<?php } ?>
<div class="simplecheckout-block-content">
    <span class="simplecheckout-header">Способ доставки:</span> <br>

    <?php if (!empty($shipping_methods)) { ?>
    <table class="simplecheckout-methods-table">
        <?php if (!empty($shipping_method['warning'])) { ?>
        <tr>
            <td colspan="3"><div class="simplecheckout-error-text"><?php echo $shipping_method['warning']; ?></div></td>
        </tr>
        <?php } ?>
        <?php if (empty($shipping_method['error'])) { ?>
        <select name="shipping_method" id="inputShippingMethod" required onchange="simplecheckout_reload('shipping_changed');">
            <?php foreach ($shipping_methods as $shipping_method) { ?>
            <?php foreach ($shipping_method['quote'] as $quote) { ?>
            <option value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" <?php if ($quote['code'] == $code) { ?>selected="selected"<?php } ?>><?php echo $quote['title']; ?></option>
            <?php } ?>
            <?php } ?>
        </select>

            <?php foreach ($shipping_methods as $shipping_method) { ?>
                <?php foreach ($shipping_method['quote'] as $quote) { ?>
                    <?php if ($quote['code'] == $code) { ?>
                        <?php if (!empty($shipping_method['description'])) { ?>
                            <div class="shipping-payment-description">
                                <?php echo $shipping_method['description']; ?>
                            </div>
                        <?php } ?>
                            <div class="shipping-total">
                                <?php echo $quote['text']; ?>
                                <?php if (!empty($quote['delivery_time'])) { ?>
                                <span class="delivery"><?php echo $quote['delivery_time']; ?></span>
                                <?php } ?>
                            </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

        <?php } ?>

    </table>
    <input type="hidden" name="shipping_method_current" value="<?php echo $code ?>" />
    <input type="hidden" name="shipping_method_checked" value="<?php echo $checked_code ?>" />
    <?php } ?>
    <?php if (empty($shipping_methods) && $address_empty && $simple_shipping_view_address_empty) { ?>
    <div class="simplecheckout-warning-text"><?php echo $text_shipping_address; ?></div>
    <?php } ?>
    <?php if (empty($shipping_methods) && !$address_empty) { ?>
    <div class="simplecheckout-warning-text"><?php echo $error_no_shipping; ?></div>
    <?php } ?>
</div>
<?php if ($simple_debug) print_r($address); ?>

<script type="text/javascript"><!--

    $('#inputShippingMethod').styler({
        onSelectOpened: function () {
            $('li.sel').css({'display' : 'none'});
        },
        onFormStyled: function () {
            if ($('#inputShippingMethod option').size() == 1) {
                var styler = $('#inputShippingMethod-styler');
                styler.css({'cursor' : 'auto'});
                styler.find('.jq-selectbox__trigger-arrow').css({'display' : 'none'});
            }
        }

    });
    $('.jq-selectbox__trigger-arrow').html('<i class="fa fa-angle-right" aria-hidden="true"></i>');


    --></script>
