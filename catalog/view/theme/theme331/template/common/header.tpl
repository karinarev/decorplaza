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

	<link href="catalog/view/javascript/jquery/formstyler/jquery.formstyler.css" rel="stylesheet" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/stylesheet/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/cloud-zoom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/stylesheet.css" />
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/fonts.css" />
	<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/slideshow.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/jquery.prettyPhoto.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/camera.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/superfish.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/responsive.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/photoswipe.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/jquery.bxslider.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/colorbox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/fast_order.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<link href='//fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
	<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/jquery/jquery-migrate-1.2.1.min.js"></script>
<!--<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>-->
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<script  type="text/javascript" src="catalog/view/javascript/jquery/jqall.js"></script> 
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<!--<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />-->

<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fancybox3/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fancybox3/jquery.fancybox.css" media="screen" />


<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.cycle.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.maskedinput-1.3.min.js"></script>
	<script src="catalog/view/javascript/jquery/formstyler/jquery.formstyler.min.js"></script>

<!--[if IE]>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/html5.js"></script>
<![endif]-->
<!--[if lt IE 8]><div style='clear:both;height:59px;padding:0 15px 0 15px;position:relative;z-index:10000;text-align:center;'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div><![endif]-->
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/bootstrap/bootstrap.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>

<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/jQuery.equalHeights.js"></script>
<script type="text/JavaScript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/elevate/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/jscript_zjquery.anythingslider.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/common.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/nivo-slider/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/jquery.mobile-events.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/superfish.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/script.js"></script>
<script type="text/javascript" src="catalog/view/javascript/fast_order.js"></script>

<!--[if IE]>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/sl/jscript_zjquery.anythingslider.js"></script>
<![endif]-->
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/sl/camera.js"></script>

<!-- bx-slider -->
<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/bxslider/jquery.bxslider.js"></script>
<!-- photo swipe -->
<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/photo-swipe/klass.min.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/photo-swipe/code.photoswipe.jquery-3.0.5.js"></script>

<script type="text/javascript" language="javascript" src="/seo/we-found-cheaper/we-found-cheaper.js"></script>

<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if  IE 8]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/ie8.css" />
<![endif]-->
<!--[if  IE 8]>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/respond.js"></script>
<![endif]-->
<!--[if  IE 8]>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/matchmedia.polyfill.js"></script>
<![endif]-->
<!--[if  IE 8]>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/matchmedia.addListener.js"></script>
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/livesearch.css"/>
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
			<li class="last"><a href="#feedbackForm" class="feedbackForm"><i class="fa fa-obrzvonok"></i>Заказать обратный звонок</a></li>
			
			
			
			<!--<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="account/wishlist") {echo "active";} ?>" href="<?php echo $wishlist; ?>" id="wishlist-total"><i class="fa fa-star"></i><?php echo $text_wishlist; ?></a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="account/account") {echo "active";} ?>" href="<?php echo $account; ?>"><i class="fa fa-user"></i><?php echo $text_account; ?></a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="checkout/cart") {echo "active";} ?>" href="<?php echo $shopping_cart; ?>"><i class="fa fa-shopping-cart"></i><?php echo $text_shopping_cart; ?></a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="checkout/checkout") {echo "active";} ?>" href="<?php echo $checkout; ?>"><i class="fa fa-check"></i><?php echo $text_checkout; ?></a></li>
			-->
		</ul>
	</div>
</div>
<div class="header">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $currency; ?>
				<?php echo $language; ?>
			</div>
		</div>
	</div>
</div>
<div id="page">
<div id="shadow">
<div class="shadow"></div>

<header id="header">
	<div class="container">
		<div class="toprow-1">
			<div class="row">
				<div class="col-sm-12">
					<a class="swipe-control" href="#"><i class="fa fa-align-justify"></i></a>
					<div class="top-search">
						<i class="fa fa-search"></i>
					</div>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<?php if ($logo) { ?>
					<div id="logo"><a style="display:block;" href="<?php echo $home; ?>">
					<img class="img" style="vertical-align:top;max-width:100%;width:100%;" src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="Итальянские сумки в Москве" /></a>
					<div class="rightsearch block">
					<div class="top-search1">
						<i class="fa fa-search"></i>
					</div>
					<div id="search">
						<div class="inner">
							<div class="button-search"><i class="fa fa-search"></i><i class="fa fa-angle-right"></i></div>
							<input type="search" name="search" placeholder="<?php echo $text_search; ?>" value="" />
						</div>
					</div>
					</div>
					
					</div>
				<?php } ?>
				<div class="cart-position" onclick="location.href='/shopping-cart/'">
					<div class="cart-inner"><?php echo $cart; ?></div>
				</div>
				<div class="rightsearch">
					
					<a href="#feedbackForm" class="feedbackForm feedbackForm2">Заказать обратный звонок</a>
				</div>
				
				 <div class="phone">
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
				</div>
				<!--<div class="phonemobil">
				 <div style="font-size:12px; font-weight:bold;   color: #EC1313;">Бесплатный звонок по России</div>
					<ul>
						 <li>
							<a style="font-size: 22px;   color: #EC1313;" href="tel:+78005008978" >8 (800) 500-89-78</a>
						</li>
						<li>
                	        <a style="font-size: 22px;" href="tel:+74954907474" >8 (495) 490-74-74</a>
						</li>
						<li>
                     	    <a style="font-size: 22px;" href="tel:+79260250008" >8 (926) 025-00-08</a>
						</li>
						
                    </ul>
				</div>-->
				
				<div class="grafik-addres">
					<span class="dostavka">Доставка по всей России</span>
					<a class="feedbackForm" href="#grafikmodal"><div class="grafik" >
						Пн-Пт: 10.00 - 21.00, Сб-Вс: 10.00 - 20.00
					</div></a> 
					<a class="feedbackForm" href="#yandexmetromodal"><div class="metro" >
						Планерная
					</div></a>
					<a class="feedbackForm" href="#yandexmapmodal"><div class="addres" >
						ул. Свободы, д. 89, корпус 5
					</div></a>
				
				
				</div>
                
               
               
				
				<div class="toprow">
					<ul class="links">
						<?php if (!isset($this->request->get['route'])) { $route='active'; }  else {$route='';}?> 
                        <li class="first"><a class="<?php echo $route; if (isset($this->request->get['route']) && $this->request->get['route']=="common/home") {echo "active";} ?>" href="<?php echo $home; ?>"><i class="fa fa-home"></i><?php echo $text_home; ?></a>
                        </li>

                        <?php foreach ($informations as $information) { ?>
				        <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a>
                        </li>
				<?php } ?>
						<li><a class="" href="/garantii"><i class="fa fa-optovikam"></i>Гарантии</a></li>
						
                		<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="news/news") {echo "active";} ?>" href="/novosti/"><i class="fa fa-star"></i>Новости</a>
                        </li>
						<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="information/contact") {echo "active";} ?>" href="<?php echo $contact; ?>"><i class="fa fa-star"></i><?php echo $text_contact; ?></a>
                        </li>
						
						

					</ul>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php if ($categories) { ?>
		<div class="row">
			<div class="col-sm-12">
				
				<div id="menu-gadget">
					<div id="menu-icon"><?php echo $text_category; ?></div>
					<ul id="nav" class="sf-menu-phone">
						<li style="background-color: #666161;"><a href="/brands/">Производители</a>
						<?php foreach ($mobilecategories as $mobilecategorie) { ?>
						<li <?php if ($mobilecategorie['children']) { ?>class="parent"<?php } ?>><a href="<?php echo $mobilecategorie['href']; ?>"><?php echo $mobilecategorie['name']; ?></a>
							<?php if ($mobilecategorie['children']) { ?>
					
								<?php for ($i = 0; $i < count($mobilecategorie['children']);) { ?>
								<ul>
								<?php $j = $i + ceil(count($mobilecategorie['children']) / $mobilecategorie['column']); ?>
								<?php for (; $i < $j; $i++) { ?>
								<?php if (isset($mobilecategorie['children'][$i])) { ?>
								<?php $id=$mobilecategorie['children'][$i]['category_id'];?>
								<?php if ( $id == $child_id) { ?>
								<li class="active<?php if ($mobilecategorie['children'][$i]['children3']) {?> parent<?php } ?>">
									<?php } else { ?>
								<li <?php if ($mobilecategorie['children'][$i]['children3']) {?>class="parent"<?php } ?>>
									<?php } ?>
									<?php if ($mobilecategorie['children'][$i]['children3']) {?>
									<a href="<?php echo $mobilecategorie['children'][$i]['href']; ?>"><?php echo $mobilecategorie['children'][$i]['name'];?></a>
									<ul>
									<?php foreach ($mobilecategorie['children'][$i]['children3'] as $ch3) { ?>
									<li>
										<?php if ($ch3['category_id'] == $ch3_id) { ?>
										<a href="<?php echo $ch3['href']; ?>" class="active"><?php echo $ch3['name']; ?></a>
										<?php } else { ?>
										<a href="<?php echo $ch3['href']; ?>"><?php echo $ch3['name']; ?></a>
										<?php } ?>
									</li>
									<?php } ?>
									</ul>
									<?php } else {?>
									<a href="<?php echo $mobilecategorie['children'][$i]['href']; ?>"><?php echo $mobilecategorie['children'][$i]['name'];?></a>
								<?php }?>
								</li>
								<?php } ?>
								<?php } ?>
								</ul>
								<?php } ?>
						<?php } ?>
						</li>
						<?php } ?>
					</ul>
				</div>
				
			</div>
		</div>
		<?php } ?>
	</div>
	<?php if ($categories) { ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="menu">
					<ul  class="sf-menu">
						<?php $cv=0;?>
						<?php foreach ($categories as $category) { $cv++; ?>
						<?php if ($category['category_id'] == $category_id) { ?>
						<li class="current cat_<?php echo $cv ?>">
						<?php } else { ?>
						<li class="cat_<?php echo $cv ?>">
						<?php } ?>
						<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
						<?php if ($category['children']) { ?>
								<div class="sf-mega" id="style-1">
								<?php for ($i = 0; $i < count($category['children']);) { ?>
										<ul class="sf-mega-section">
											<?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
											<?php for (; $i < $j; $i++) { ?>
											<?php if (isset($category['children'][$i])) { ?>
											<?php $id=$category['children'][$i]['category_id'];?>
											<?php if ( $id == $child_id) { ?>
											<li class="current">
											<?php } else { ?>
											<li>
											<?php } ?>
											<?php if ($category['children'][$i]['children3']) {?>
											<a class="screenshot1"  href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name'];?></a>
											<!--<ul>
											<?php foreach ($category['children'][$i]['children3'] as $ch3) { ?>
												<li>
												<?php if ($ch3['category_id'] == $ch3_id) { ?>
												<a href="<?php echo $ch3['href']; ?>" class="current"><?php echo $ch3['name']; ?></a>
												<?php } else { ?>
												<a href="<?php echo $ch3['href']; ?>"><?php echo $ch3['name']; ?></a>
												<?php } ?>
											</li>
											<?php }?>
											</ul>-->
											<?php } else {?>
											<a class="screenshot1"  href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name'];?></a>
											<?php }?>
											</li>
											<?php } ?>
											<?php } ?>
										</ul>
								<?php } ?>
								</div>
						<?php } ?>
						</li>
						<?php } ?>
						
						
						<li class="cat_5"><a href="/brands/">Бренды</a>	
						<div class="sf-mega" id="style-1">																								
							<ul class="sf-mega-section">
									<?php foreach ($brands as $brand) { ?>
									<li>
									<?php if($brand['brand_id'] == $brand_id) {?>
									<a class="active" href="<?php echo $brand['href']; ?>" title="<?php echo $brand['seo_title']; ?>"><?php echo $brand['name']; ?></a>
									<?php } else {?>
									<a href="<?php echo $brand['href']; ?>" title="<?php echo $brand['seo_title']; ?>"><?php echo $brand['name']; ?></a>
									<?php }?>
									</li>
									<?php }?>
							</ul></div>
						</li>
		
						<li class="cat_6"><a href="/discount-form/">Получить скидку</a>	
					
						<li class="cat_7"><a href="/index.php?route=discount/discountcart">Дисконтная карта</a>	
						
						<li class="account_link"><a  href="<?php echo $account; ?>">Личный кабинет</a></li>
					</ul>
					
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
	</div>
	<?php } ?>
</header>
<section>
<?php if ($header_top) {?>
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
<?php }?>

<div id="container">
<div class="container">
<?php if (!empty($error)) { ?>
    <div class="warning"><?php echo $error ?><img src="catalog/view/theme/theme331/image/close-1.png" alt="" class="close" /></div>
<?php } ?>
<div id="notification"></div>
<div class="row">
