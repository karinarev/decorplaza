<div class="jcarousel-wrapper categories">
    <div class="jcarousel">
    <?php foreach($categories as $category) { ?>
    <div class="item">
        <div class="image">
            <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>" title="<?php echo $category['name']; ?>" />
            <div class="image-background"></div>
        </div>
        <div class="caption">
            <div class="catalog-name"><?php echo $category['name']; ?></div>
            <div class="description"><?php echo $category['description']; ?></div>
        </div>
        <div class="button-area">
            <a class="btn btn-more" href="<?php echo $category['parent_url']; ?>"><span>Подробнее</span></a>
        </div>
    </div>
    <?php } ?>
    </div>

<a class="jcarousel-control-prev"></a>
<a class="jcarousel-control-next"></a>

</div>



<script type="text/javascript"><!--

    $(document).ready(function () {

        var count = 0;

        checkWindowSize();

    });

    $(window).resize(function(){
        checkWindowSize();
    });

    function checkWindowSize() {
        currWindowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

        if (currWindowWidth <= 767) {
            var jcarousel = $('.jcarousel');

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

            $('.jcarousel .item').hover(
                    function () {
                        $(this).find('img').addClass('image-hover');
                        $(this).find('.featured-icon').css({'display' : 'block'});
                        $(this).find('.sku').css({'display' : 'block'});
                        $(this).find('.rating').css({'display' : 'block'});
                    },
                    function (){
                        $(this).find('img').removeClass('image-hover');
                        $(this).find('.featured-icon').css({'display' : 'none'});
                        $(this).find('.sku').css({'display' : 'none'});
                        $(this).find('.rating').css({'display' : 'none'});

                    });
        }


    }



    --></script>
