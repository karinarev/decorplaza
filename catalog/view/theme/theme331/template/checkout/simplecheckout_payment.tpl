<div class="simplecheckout-block-heading"></div>
<?php if ($simple_show_errors && $error_warning) { ?>
    <div class="simplecheckout-warning-block"><?php echo $error_warning ?></div>
<?php } ?>  
<div class="simplecheckout-block-content">
    <span class="simplecheckout-header">Способ оплаты:</span> <br>
    <?php if (!empty($payment_methods)) { ?>
        <table class="simplecheckout-methods-table">
            <?php if (empty($payment_method['error'])) { ?>
            <select name="payment_method" id="inputPaymentMethod" required onchange="simplecheckout_reload('payment_changed')">
                <?php foreach ($payment_methods as $payment_method) { ?>
                <option value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" <?php if ($payment_method['code'] == $code) { ?>selected="selected"<?php } ?>><?php echo $payment_method['title']; ?></option>
                <?php } ?>
            </select>

            <?php foreach ($payment_methods as $payment_method) { ?>
            <?php if ($payment_method['code'] == $code) { ?>
            <?php if (!empty($payment_method['description'])) { ?>
            <div class="shipping-payment-description">
                <?php echo $payment_method['description']; ?>
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php } ?>

        </table>
        <input type="hidden" name="payment_method_current" value="<?php echo $code ?>" />
        <input type="hidden" name="payment_method_checked" value="<?php echo $checked_code ?>" />
    <?php } ?>
    <?php if (empty($payment_methods) && $address_empty && $simple_payment_view_address_empty) { ?>
        <div class="simplecheckout-warning-text"><?php echo $text_payment_address; ?></div>
    <?php } ?>
    <?php if (empty($payment_methods) && !$address_empty) { ?>
        <div class="simplecheckout-warning-text"><?php echo $error_no_payment; ?></div>
    <?php } ?>
</div>
<?php if ($simple_debug) print_r($address); ?>

<script type="text/javascript"><!--

    $('#inputPaymentMethod').styler({
        onSelectOpened: function () {
            $('li.sel').css({'display' : 'none'});
        },
        onFormStyled: function () {
            if ($('#inputPaymentMethod option').size() == 1) {
                var styler = $('#inputPaymentMethod-styler');
                styler.css({'cursor' : 'auto'});
                styler.find('.jq-selectbox__trigger-arrow').css({'display' : 'none'});
            }
        }
    });
    $('.jq-selectbox__trigger-arrow').html('<i class="fa fa-angle-right" aria-hidden="true"></i>');


    --></script>
