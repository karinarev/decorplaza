<div class="clear"></div>
</div>
</div>
</div>
<div class="clear"></div>
</section>

<?php if (!$column-left) echo '<div class=footerSpacer></div>'; ?>
<div class="producersBlockFullWidth">
	</div>
<div class="container-fluid producersBlock">
	<h2 class="myHeader">Производители</h2>
	<div class="flex-container">
		<?php foreach ($manufacturersF as $manufacturer) echo ('<a href="'.$this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id']).'">'. $manufacturer['name'] .' </a>'); ?>
	</div>
</div>
<div class="footerFullWidth">
    <hr>
</div>
<footer>
	<div class="container-fluid">
		<div class="row">
			<?php if ($informations) { ?>
			<div class="col-md-2 col-sm-4 col-xs-6">
				<p class="my_h3"><?php echo $text_information; ?></p>
				<ul>
				<?php foreach ($informations as $information) { ?>
				<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
				<?php } ?>
				<li><a href="/novosti/">Новости</a></li>
				
				</ul>
			</div>
			<?php } ?>
			
			<div class="col-md-2 col-sm-4 col-xs-6">
				<p class="my_h3"><?php echo $text_extra; ?></p>
				<ul>
				<li><a href="#callback">Обратный звонок</a></li>
				<li><a href="/brands"><?php echo $text_manufacturer; ?></a></li>
				<li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
				<li><a href="#search">Поиск</a></li>
			<!--	<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
				<li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>-->
				<!--	<li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>-->
				</ul>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6">
				<p class="my_h3"><?php echo $text_account; ?></p>
				<ul>
				<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
				<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
				<li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
				<!--<li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>-->
				</ul>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6">
				<p class="my_h3">Мы в соцсетях</p>
				<ul>
<li><span class="external-reference" data-link="https://www.facebook.com/decor-plaza">Facebook</span></li>
					<li><span class="external-reference" data-link="http://vk.com/decor-plaza">Вконтакте</span></li>
<li><span class="external-reference" data-link="https://instagram.com/decor-plaza/">Instagram</span></li>
                    
				</ul>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6">
				<p class="my_h3">График работы</p>
				<ul>
				<li>Пн-Пт с 10.00 до 19.00 <br/>
				Сб-Вс с 10.00 до 20.00</li>
				<li>Заказы через сайт - круглосуточно и без <br/> выходных</li>
				
				</ul>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6">
				<!--<h3><?php echo $text_support; ?></h3>-->
						<p class="my_h3">Телефоны</p>
				<ul>
						<li>Бесплатно по России:<br/>
							8 (925) 397-79-13.</li>
						<li>8 (925) 397-79-14;<br/>
							8 (499) 397-79-12.</li>
						</ul>

				<ul>
					
				</ul>
			</div> 
		</div>
		<br><br>
		<span class=footerInfo>2013-2016 Декор-плаза.<br/>
		Дизайн сайта Соседова Екатерина</span>
		
	</div>
	
	
</footer>
<script type="text/javascript" 	src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/livesearch.js"></script>
</div>
</div>

<!--div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div id="powered">
				<?php echo $powered; ?><!-- [[%FOOTER_LINK]] --><!--br>
				
			</div>
		</div>
	</div>
</div-->
</div>


<div style="display: none;" >
	<div id="grafikmodal" >
		<p>В указанное время Вы можете осуществлять звонки для оформления заказа или уточнения информации, а также посетить наш магазин, примерить и выбрать все необходимое.<br> Заказ через сайт можно осуществлять в любое время – 24 часа в сутки, 7 дней в неделю и без выходных.</p>
	</div>

	<div id="we-found-cheaper"></div>

	</div>
</div>

<!-- LiveTex {literal} -->

<!-- LiveTex {/literal} -->
<script>$('.external-reference').replaceWith (function (){return'<a onclick="return !window.open(this.href)" href="'+$(this).data ('link')+'" title="'+$(this).text ()+'">'+$(this).html ()+'</a>';})
        $(".producersBlockFullWidth").css("height", (String(Number($(".producersBlock").css("height").substr(0, 3))+160)+"px"));
</script>
</body></html>