<?php 
if($_SERVER['REQUEST_URI'] == '/dostavka?_route_=dostavka-i-oplata'){

header("HTTP/1.1 301 Moved Permanently"); 
header("Location: http://italy-sumochka.ru/dostavka"); 
exit(); 

}
?>
<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>"><head>

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>-->

<meta name="robots" content="index">
<meta charset="UTF-8" />
<title><?php echo $title;  ?></title>
<link href="/image/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
<base href="<?php echo $base; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, , initial-scale=1.0">
<?php if ($description) { 

$description = str_replace(array("&nbsp",";","\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $description);?>
<meta name="description" content="<?php echo $description ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<meta property="og:title" content="<?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<meta property="og:url" content="<?php echo $og_url; ?>" />
<meta property="og:type" content="website" />

<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>

<script>
    if (navigator.userAgent.match(/Android/i)) {
        var viewport = document.querySelector("meta[name=viewport]");
    }
 if(navigator.userAgent.match(/Android/i)){
    window.scrollTo(0,1);
 }
</script> 
 

<link href="catalog/view/theme/theme331/stylesheet/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/theme331/stylesheet/cloud-zoom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/theme331/stylesheet/stylesheet.css" />
<link href="catalog/view/javascript/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/theme331/stylesheet/slideshow.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/theme331/stylesheet/jquery.prettyPhoto.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/theme331/stylesheet/camera.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/theme331/stylesheet/superfish.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/theme331/stylesheet/responsive.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/theme331/stylesheet/photoswipe.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/theme331/stylesheet/jquery.bxslider.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/theme331/stylesheet/colorbox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/fast_order.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<link href='//fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

<link href="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/stylesheet/fonts.css" rel="stylesheet" type="text/css" />


	<link href="catalog/view/javascript/jquery/formstyler/jquery.formstyler.css" rel="stylesheet" />
	<script type="text/javascript" src="catalog/view/theme/theme331/js/jquery/jquery-1.10.2.min.js"></script>
	<script src="catalog/view/javascript/jquery/formstyler/jquery.formstyler.min.js"></script>
	<script type="text/javascript" src="catalog/view/theme/theme331/js/jquery/jquery-migrate-1.2.1.min.js"></script>
<!--<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>-->
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<script  type="text/javascript" src="catalog/view/javascript/jquery/jqall.js"></script> 
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<!--<script type="text/javascript" src="catalog/view/theme/theme331/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/theme331/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />-->

<script type="text/javascript" src="catalog/view/theme/theme331/js/fancybox3/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/theme331/js/fancybox3/jquery.fancybox.css" media="screen" />


<script type="text/javascript" src="catalog/view/theme/theme331/js/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.cycle.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.maskedinput-1.3.min.js"></script>


<!--[if IE]>
<script type="text/javascript" src="catalog/view/theme/theme331/js/html5.js"></script>
<![endif]-->
<!--[if lt IE 8]><div style='clear:both;height:59px;padding:0 15px 0 15px;position:relative;z-index:10000;text-align:center;'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div><![endif]-->
<script type="text/javascript" src="catalog/view/theme/theme331/js/bootstrap/bootstrap.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>

<script type="text/javascript" src="catalog/view/theme/theme331/js/jQuery.equalHeights.js"></script>
<script type="text/JavaScript" src="catalog/view/theme/theme331/js/elevate/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="catalog/view/theme/theme331/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="catalog/view/theme/theme331/js/jscript_zjquery.anythingslider.js"></script>
<script type="text/javascript" src="catalog/view/theme/theme331/js/common.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/nivo-slider/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="catalog/view/theme/theme331/js/jquery.mobile-events.js"></script>
<script type="text/javascript" src="catalog/view/theme/theme331/js/superfish.js"></script>
<script type="text/javascript" src="catalog/view/theme/theme331/js/script.js"></script>
<script type="text/javascript" src="catalog/view/javascript/fast_order.js"></script>

<!--[if IE]>
<script type="text/javascript" src="catalog/view/theme/theme331/js/sl/jscript_zjquery.anythingslider.js"></script>
<![endif]-->
<script type="text/javascript" src="catalog/view/theme/theme331/js/sl/camera.js"></script>

<!-- bx-slider -->
<script type="text/javascript" language="javascript" src="catalog/view/theme/theme331/js/bxslider/jquery.bxslider.js"></script>
<!-- photo swipe -->
<script type="text/javascript" language="javascript" src="catalog/view/theme/theme331/js/photo-swipe/klass.min.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/theme/theme331/js/photo-swipe/code.photoswipe.jquery-3.0.5.js"></script>

<script type="text/javascript" language="javascript" src="/seo/we-found-cheaper/we-found-cheaper.js"></script>

<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if  IE 8]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/theme331/stylesheet/ie8.css" />
<![endif]-->
<!--[if  IE 8]>
<script type="text/javascript" src="catalog/view/theme/theme331/js/respond.js"></script>
<![endif]-->
<!--[if  IE 8]>
<script type="text/javascript" src="catalog/view/theme/theme331/js/matchmedia.polyfill.js"></script>
<![endif]-->
<!--[if  IE 8]>
<script type="text/javascript" src="catalog/view/theme/theme331/js/matchmedia.addListener.js"></script>
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/theme331/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="catalog/view/theme/theme331/stylesheet/livesearch.css"/>
<?php if (!empty($stores)) { ?>

<script type="text/javascript"><!--
$(document).ready(function() {
	
	
	 

<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>
<?php echo $google_analytics; ?>
</head>
<body class="<?php echo empty($this->request->get['route']) ? 'common-home' : str_replace('/', '-', $this->request->get['route']); ?>"><a id="hidden" href="<?php echo $base; ?>"></a>

<!-- Yandex.Metrika counter -->


<!-- /Yandex.Metrika counter -->

<div class="swipe-left"></div>
<div id="body">

<div class="swipe">
	<div class="swipe-menu">
		<ul class="links">
			<?php if (!isset($this->request->get['route'])) { $route='active'; }  else {$route='';}?> <li class="first"><a class="<?php echo $route; if (isset($this->request->get['route']) && $this->request->get['route']=="common/home") {echo "active";} ?>" href="<?php echo $home; ?>"><i class="fa fa-home"></i><?php echo $text_home; ?></a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="account/wishlist") {echo "active";} ?>" href="/o-nas" id="wishlist-total"><i class="fa fa-star"></i>О нас</a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="account/account") {echo "active";} ?>" href="/dostavka-i-oplata"><i class="fa fa-user"></i>Доставка и оплата</a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="checkout/cart") {echo "active";} ?>" href="/novosti/"><i class="fa fa-news"></i>Новости</a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="checkout/checkout") {echo "active";} ?>" href="/contact-us/"><i class="fa fa-check"></i>Контакты</a></li>
			<li><a class href="/optovikam"><i class="fa fa-optovikam"></i>Оптовикам</a></li>

		</ul>
	</div>
</div>
	<div class="navbarFullWidth">

	</div>
	<div class="headerFullWidth">

		</div>
	<div class="searchFullWidth">

	</div>

<div id="page">
<div id="shadow">
<div class="shadow"></div>

<header id="header">
	<div class="container-fluid">
		<!-- Вот тут начинается все-->
		<div class="row">
			<div class="col-sm-12">
				<div class="toprow">
					<ul class="links list-inline">
						<div class="hamburger"><a class="hamburger-btn"><img src="catalog/view/theme/theme331/image/hamburger.png"/></a> </div>
						<?php if (!isset($this->request->get['route'])) { $route='active'; }  else { $route=''; }?>
						<li><a class="" id="header-back-link"><img src="catalog/view/theme/theme331/image/header-back.png"/></a></li>
						<li class="first"><a class="<?php echo $route; if (isset($this->request->get['route']) && $this->request->get['route']=="common/home") ?>" href="<?php echo $home; ?>"><i class="fa fa-home"></i><?php echo $text_home; ?></a>
                        </li>
						<li><a class="" href="/o-nas"><i class="fa fa-optovikam"></i>О нас</a></li>
						<li><a class="" href="/dostavka"><i class="fa fa-optovikam"></i>Доставка и оплата</a></li>

						<li><a class="" href="/garantii"><i class="fa fa-optovikam"></i>Гарантии и сертификаты</a></li>
						
                		<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="news/news") ?>" href="/novosti/"><i class="fa fa-star"></i>Новости</a>
                        </li>
						<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="information/contact") ?>" href="<?php echo $contact; ?>"><i class="fa fa-star"></i><?php echo $text_contact; ?></a>
                        </li>
						<li><a class="" id="header-more-link"><img src="catalog/view/theme/theme331/image/dots.png"/></a></li>
						<div class="headerBrownPanel">
							<a href="/login" class="icon enterIcon"></a>
							<a href="/create-account" class="icon accountIcon"></a>
							<div class="cart-position">
								<div class="cart-inner"><?php echo $cart; ?></div>
							</div>
							<!--a href="/" id="cartIcon" class="icon cartIcon"><?php if($productsNumber) echo'<span id="cart-total">', $productsNumber, '</span>';?></a-->
						</div>
						<div class="justifyHelper">
						</div>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	<!--ВСТАВЛЯТЬ СЮДА-->

<div class="hamburger-content">
	<ul class="hamburger-list">
		<li class="first"><a class="<?php echo $route; if (isset($this->request->get['route']) && $this->request->get['route']=="common/home") ?>" href="<?php echo $home; ?>"><?php echo $text_home; ?></a>
		</li>
		<li><a class="" href="/o-nas">О нас</a></li>
		<li><a class="" href="/dostavka">Доставка и оплата</a></li>

		<li><a class="" href="/garantii">Гарантии и сертификаты</a></li>

		<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="news/news") ?>" href="/novosti/">Новости</a>
		</li>
		<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="information/contact") ?>" href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a>
		</li>
	</ul>
</div>
</header>
	<div id="decorPlazaHeader">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 col-sm-12 col-xs-12">
					<div id="logo">
						<?php if ($logo) { ?>
						<a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
						<?php } else { ?>
						<h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-1 col-sm-1 col-xs-3">
					<img src="/image/call.png" id="callIcon">
				</div>
				<div class="col-md-2 col-sm-3 col-xs-9">
					<!--div class="phone">                                                                       Это телефонные номера, по которым можно звонить
            <div style="font-size:12px; font-weight:bold;   color: #EC1313;">Бесплатный звонок по России</div>
               <ul>
                    <li>
                       <span><a style="font-size: 22px;   color: #EC1313;" href="tel:88005008978">8 (800) 500-89-78</a></span>
                   </li>
                   <li>
                       <span><a style="font-size: 22px;"  href="tel:84954907474">8 (495) 490-74-74</a></span>
                   </li>
                   <li>
                        <span><a style="font-size: 22px;"  href="tel:89260250008">8 (926) 025-00-08</a></span>
                   </li>

               </ul>
           </div-->
					<a href="tel:84993977912" class="headerBigText headerText telephoneNumber" id="firstNumber">8 (499) 397-79-12</a><br/>
					<a href="tel:89253977912" class="headerText telephoneNumber" id="secondNumber">8 (925) 397-79-12</a><br/>
					<a href="tel:89253977914" class="headerText telephoneNumber" id="thirdNumber">8 (925) 397-79-14</a>
				</div>
				<div class="col-md-1 col-sm-1 col-xs-3">
					<img src="/image/callBack.png">
				</div>
				<div class="col-md-2 col-sm-3 col-xs-9">
					<a href="/" onclick="callBack(event);" name="callback" class="headerBigText">Обратный звонок</a><br/>
					<input type="tel" id="callBackInput" class="callBackStuff"/><button id="callBackButton" class="callBackStuff" onmousedown="callBackSend();"><span class="callBackStuff glyphicon glyphicon-phone-alt"></span></button>
					<span class="headerText">Режим работы:</span><br/>
					<span class="headerText">Пн-Пт с 10 до 19</span><br/>
				</div>
				<div class="col-md-1 col-sm-1 col-xs-3">
					<img src="/image/location.png">
				</div>
				<div class="col-md-2 col-sm-3 col-xs-9">
					<a href="https://yandex.ru/maps/10716/balashiha/?z=15&ll=37.887561%2C55.750140&l=map&origin=jsapi_2_1_41&from=api-maps&um=constructor%3AsXf1ofePV3VE-_X4NL8Z2zh8nC9LIRLe&mode=search&ol=biz&oid=1099254618">
						<span class="headerBigText" id="ourAdress">Наш адрес:</span><br/>
						<span class="headerText">г. Москва, м. "Новокосино",</span><br/>
						<span class="headerText">Носовихинское шоссе вл., 4.</span><br/>
						<span class="headerText">ТЦ "Никольский Парк"</span><br/>
					</a>
				</div>
			</div>
			<div class="row header-menu">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="panel panel-default nomargin">
						<a data-toggle="collapse" href="#catalogCollapse" onclick="wallpapersCatalogCollapse(0)">
							<div class="panel-heading">
								Каталог товаров
							</div>
						</a>
						<div id="catalogCollapse" class="panel-collapse collapse headerCollapse">
							<ul class="list-group categoryUl">
								<?php $i=0; ?>
								<?php foreach ($categories as $category) if ($i<6){ if (!empty($category['children'])){ ?>
								<?php echo ("<a class='categoryA' href='". $category['href'] ."' onmouseover='subcategoryBlockShow(". $i .");'><li class='categoryLi'>" . $category['name'] . "<span class='pointerSpan'></span></li></a>"); ?>
								<?php } else { ?>
								<?php echo ("<a class='categoryA' href='". $category['href'] ."' ><li class='categoryLi'>" . $category['name'] . "</li></a>"); }?>
								<?php $i++; ?>
								<?php } ?>
								<!--li class="list-group-item" onclick="wallpapersCatalogCollapse(1);">Каталоги обоев<span id="1"/></li>
								<li class="list-group-item" onclick="wallpapersCatalogCollapse(2);">Лучшие фрески от фабрики affresco<span id="2"/></li>
								<li class="list-group-item" onclick="wallpapersCatalogCollapse(3);">Напольные покрытия<span id="3"/></li-->
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="panel panel-default nomargin">
						<a href="/brands">
							<div class="panel-heading">
								Производители
							</div>
						</a>
					</div>
					<div class="collapseHorizontal invisibleElement" id="firstSubcategoryCollapse">
						<ul class="subcategoryUl">
						</ul>

					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="panel panel-default">
						<a href="<?php echo $special; ?>">
							<div class="panel-heading">
								Акции и скидки
							</div>
						</a>
					</div>
					<div class="collapseHorizontal invisibleElement" id="secondSubcategoryCollapse">
						<ul class="subcategoryUl">
						</ul>
					</div>
				</div>
			</div>
				<div id="search" name="search" class="container-fluid">
					<div class="button-search"><img src="/image/search.png"/></div>
					<input type="text" name="search" placeholder="Поиск по сайту..." value="<?php echo $search; ?>" />
				</div>
		</div>
	</div>
<section>
<?php if ($header_top) { ?>
<div class="header-modules">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $header_top; ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php } ?>

<div class="container">
<?php if (!empty($error)) { ?>
    <div class="warning"><?php echo $error ?><img src="catalog/view/theme/theme331/image/close-1.png" alt="" class="close" /></div>
<?php } ?>
<div id="notification"></div>
<div class="row">
	<script>
		var categories = <?php echo json_encode($categories); ?>;
	</script>

	<script><!--

		$(document).ready(function () {
			var backLink = $("#header-back-link").parent('li');
			var moreLink = $("#header-more-link").parent('li');
			backLink.css('display', 'none');
			moreLink.css('display', 'none');
			checkWindowSize();
		});

		$(window).resize(function(){
			checkWindowSize();
		});

		function checkWindowSize(){
			currWindowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
			var items = $('#header .toprow .links li');
			var backLink = $("#header-back-link").parent('li');
			var moreLink = $("#header-more-link").parent('li');

			if(currWindowWidth > 767 && currWindowWidth < 1280) {

				if(backLink.css('display') == 'none' && moreLink.css('display') == 'none'){
					moreLink.css('display', 'inline-block');

					for(var i = 6; i > 3; i--){
						items.eq(i).css('display', 'none');
					}
					for(var i = 3; i >= 1; i--){
						items.eq(i).css('display', 'inline-block');
					}
				}


				$(document).on("click", '#header-more-link', function() {
					if(backLink.css('display') == 'none')
						backLink.css('display', 'inline-block');

					for (var i = 6; i > 3; i--) {
						items.eq(i).css('display', 'inline-block');
					}
					for (var i = 3; i >= 1; i--) {
						items.eq(i).css('display', 'none');
					}
					moreLink.css('display', 'none');
				});

				$(document).on("click", '#header-back-link', function() {
					if(moreLink.css('display') == 'none')
						moreLink.css('display', 'inline-block');

					for(var i = 6; i > 3; i--){
						items.eq(i).css('display', 'none');
					}
					for(var i = 3; i >= 1; i--){
						items.eq(i).css('display', 'inline-block');
					}
					backLink.css('display', 'none');
				});

			}

			else if(currWindowWidth <= 767){
				backLink.css('display', 'none');
				moreLink.css('display', 'none');
				items.each(function () {
					items.css('display', 'none');
				});
				$('.hamburger').click(function() {
					var content = $('.hamburger-content');
					if(content.css('display') == 'none') {
						content.css('display', 'block');
						$(this).find('img').attr('src', 'catalog/view/theme/theme331/image/hamburgerClose.png');
					}
					else {
						content.css('display', 'none');
						$(this).find('img').attr('src', 'catalog/view/theme/theme331/image/hamburger.png');
					}
				});
			}

			else if(currWindowWidth >= 1280){
				for(var i = 1; i <= 6; i++){
					items.eq(i).css('display', 'inline-block');
				}
				backLink.css('display', 'none');
				moreLink.css('display', 'none');
			}
		}



	--></script>