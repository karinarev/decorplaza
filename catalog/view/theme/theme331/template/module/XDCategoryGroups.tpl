<div class="categories categories-jcarousel-wrapper jcarousel-wrapper">
    <div class="categories-jcarousel jcarousel">
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
            <!--<li class="li-helper"></li> -->
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
                    .on('jcarousel:createend', function() {
                        //$(this).jcarousel('scroll', 1, false);
                        var ul = $('.categories-jcarousel ul');
                        ul.css('left', '-210px');
                        ul.find('li').eq(1).addClass('target');

                    })
                    .jcarousel();

            $('.categories-jcarousel-control-prev')
                    .on('jcarouselcontrol:active', function () {
                        $(this).removeClass('inactive');
                    })
                    .on('jcarouselcontrol:inactive', function () {
                        $(this).addClass('inactive');
                    })
                    .jcarouselControl({
                        //target: "-=1"
                        method: function() {
                            var index = $('li.target').index();
                            if(index == 1) {
                                //this.carousel().jcarousel('scroll', $('.categories-jcarousel li:eq(0)'));
                                $('li.target').removeClass('target');
                                var ul = $('.categories-jcarousel ul');
                                ul.css('left', '0');
                                ul.find('li').eq(0).addClass('target');
                            }
                            else if(index == 2){
                                $('li.target').removeClass('target');
                                var ul = $('.categories-jcarousel ul');
                                ul.css('left', '-210px');
                                ul.find('li').eq(1).addClass('target');
                            }

                        }
                    });

            $('.categories-jcarousel-control-next')
                    .on('jcarouselcontrol:active', function () {
                        $(this).removeClass('inactive');
                    })
                    .on('jcarouselcontrol:inactive', function () {
                        $(this).addClass('inactive');
                    })
                    .jcarouselControl({
                        method: function() {
                            var index = $('li.target').index();
                            if(index == 0) {
                                //this.carousel().jcarousel('scroll', $('.categories-jcarousel li:eq(5)'));
                                $('li.target').removeClass('target');
                                var ul = $('.categories-jcarousel ul');
                                ul.css('left', '-210px');
                                ul.find('li').eq(1).addClass('target');
                            }
                            else if(index == 1){
                                $('li.target').removeClass('target');
                                var ul = $('.categories-jcarousel ul');
                                ul.find('li').eq(2).addClass('target');
                                this.carousel().jcarousel('scroll', $('.categories-jcarousel li:eq(2)'));
                            }

                        }
                    });
        }



    }



    --></script>
