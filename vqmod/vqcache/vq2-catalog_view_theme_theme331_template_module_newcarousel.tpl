<!--<script>
	jQuery(function(){
		jQuery('#camera_wrap_<?php echo $module; ?>').camera({
			fx: 'stampede',
			navigation: true,
			playPause: false,
			thumbnails: false,
			navigationHover: false,
			barPosition: 'top',
			loader: false,
			time: 3000,
			transPeriod:800,
			alignment: 'center',
			autoAdvance: true,
			mobileAutoAdvance: true,
			barDirection: 'leftToRight', 
			barPosition: 'bottom',
			easing: 'easeInOutExpo',
			fx: 'simpleFade',
			height: '42.5287%',
			minHeight: '90px',
			hover: true,
			pagination: false,
			loaderColor			: '#1f1f1f', 
			loaderBgColor		: 'transparent',
			loaderOpacity		: 1,
			loaderPadding		: 0,
			loaderStroke		: 3
			});
	});
</script>
<div class="fluid_container" >
	<div id="camera_wrap_<?php echo $module; ?>">
	<?php foreach ($banners as $banner) { ?>
		<div title="<?php echo $banner['title']; ?>" data-thumb="<?php echo $banner['image']; ?>" <?php if ($banner['link']) { ?> data-link="<?php echo $banner['link']; ?>"<?php } ?> data-src="<?php echo $banner['image']; ?>">

            <?php if ($banner['description']) { ?>
			<div class="camera_caption fadeIn">
				<?php echo $banner['description']; ?>
			</div>
			<?php } ?>
            
		</div>
	<?php } ?>
	</div>
	<div class="clear"></div>
</div> -->

<div id="slideshow-carousel" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<?php foreach ($banners as $banner) { ?>
		<div class="item">
			<img class="slide-img" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" />
			<div class="image-background"></div>
			<div class="carousel-caption">
				<div class="name"><?php echo $banner['title']; ?></div>
				<div class="divider"></div>
				<div class="description"><?php echo $banner['second_title']; ?></div>
				<div class="year"><?php echo $banner['third_title']; ?></div>
				<div class="button-area">
					<a class="btn btn-more" href="<?php echo $banner['link']; ?>">Подробнее</a>
				</div>
			</div>
		</div>
		<?php }?>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#slideshow-carousel" data-slide="prev">
		<i class="chevron-left chevron-white"></i>
	</a>
	<a class="right carousel-control" href="#slideshow-carousel" data-slide="next">
		<i class="chevron-right chevron-white"></i>
	</a>

</div>

<script type="text/javascript">

	$(document).ready(function(){
		var carousel = $('#slideshow-carousel');

		var $item = $('#slideshow-carousel .item');
		var $wWidth = $(window).width();
		$item.eq(0).addClass('active');
		$item.width($wWidth);
		$item.height(450);
		$item.addClass('full-screen');

		$('#slideshow-carousel img').each(function() {
			var $src = $(this).attr('src');
			$(this).parent().css({
				'background-image' : 'url(' + $src + ')'
			});
			$(this).remove();
		});

		$(window).on('resize', function (){
			$wWidth = $(window).width();
			$item.width($wWidth);
		});

		$('#slideshow-carousel').carousel({
			interval: 6000,
			pause: "false"
		});


	});
</script>