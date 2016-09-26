<div class="jcarousel-wrapper categories categories-jcarousel-wrapper">
    <div class="jcarousel categories-jcarousel">
        <ul>
            <?php foreach($categories as $category) { ?>
            <li><div class="item">
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
            </div></li>
            <?php } ?>
        </ul>
    </div>

<a class="categories-jcarousel-control-prev"></a>
<a class="categories-jcarousel-control-next"></a>

</div>



<script type="text/javascript"><!--

    $(document).ready(function () {
        checkWindowSizeXD();
    });

    $(window).resize(function(){
        checkWindowSizeXD();
    });

    function checkWindowSizeXD() {
        currWindowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

        if (currWindowWidth <= 767) {
            $('.categories-jcarousel')
                    .jcarousel();

            $('.categories-jcarousel-control-prev')
                    .on('jcarouselcontrol:active', function () {
                        $(this).removeClass('inactive');
                    })
                    .on('jcarouselcontrol:inactive', function () {
                        $(this).addClass('inactive');
                    })
                    .jcarouselControl({
                        target: '-=1'
                    });

            $('.categories-jcarousel-control-next')
                    .on('jcarouselcontrol:active', function () {
                        $(this).removeClass('inactive');
                    })
                    .on('jcarouselcontrol:inactive', function () {
                        $(this).addClass('inactive');
                    })
                    .jcarouselControl({
                        target: '+=1'
                    });
        }


    }



    --></script>
