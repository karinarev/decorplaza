<div class=" categories">
    <div class="categories-wrapper">
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

    <div class="customNavigation">
        <a class="prev"></a>
        <a class="next"></a>
    </div>
</div>


<script type="text/javascript"><!--

            $('#carousel<?php echo $module; ?>').owlCarousel({
                items: 3,
                itemsMobile: [767, 1],
                autoPlay: false,
                navigation: false,
                pagination: false,

            });

    $(document).on("click", '.customNavigation .next', function() {
        var number = parseInt($('.categories-wrapper').css('transform').split(',')[4]);
        //console.log(number);
        if(number == -200)
            $('.categories-wrapper').css({'transform' : 'translate3d(-405px, 0px, 0px)'});
        else if(number == 0)
            $('.categories-wrapper').css({'transform' : 'translate3d(-200px, 0px, 0px)'});
    });

    $(document).on("click", '.customNavigation .prev', function() {
        var number = parseInt($('.categories-wrapper').css('transform').split(',')[4]);
        if(number == -405)
            $('.categories-wrapper').css({'transform' : 'translate3d(-200px, 0px, 0px)'});
        else if(number == -200){
            $('.categories-wrapper').css({'transform' : 'translate3d(0px, 0px, 0px)'});
        }
    });




    --></script>
