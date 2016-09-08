$(document).ready(function () {

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

    $('.category-item').hover(
        function () {
            $(this).find('img').addClass('image-hover');
            $(this).find('.product-icon').css({'display' : 'block'});
            $(this).find('.model').css({'display' : 'block'});
            $(this).find('.rating').css({'display' : 'block'});
        },
        function (){
            $(this).find('img').removeClass('image-hover');
            $(this).find('.product-icon').css({'display' : 'none'});
            $(this).find('.model').css({'display' : 'none'});
            $(this).find('.rating').css({'display' : 'none'});

        });

    $('#input-sort').styler({
        onSelectOpened: function () {
            $('li.sel').css({'display' : 'none'});
        }
    });
    $('.jq-selectbox__trigger-arrow').html('<i class="fa fa-angle-right" aria-hidden="true"></i>');

});