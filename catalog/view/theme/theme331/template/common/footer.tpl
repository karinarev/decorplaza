<div class="clear"></div>
</div>
</div>
</div>
<div class="clear"></div>
</section>
<footer>
	<div class="container">
		<div class="row">
			<?php if ($informations) { ?>
			<div class="col-sm-2">
				<p class="my_h3"><?php echo $text_information; ?></p>
				<ul>
				<?php foreach ($informations as $information) { ?>
				<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
				<?php } ?>
				<li><a href="/novosti/">Новости</a></li>
				<li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
				
				</ul>
				<br><br>
				&copy; 2015 Italy-Sumochka
			</div>
			<?php } ?>
			
			<div class="col-sm-2">
				<p class="my_h3"><?php echo $text_extra; ?></p>
				<ul>
				<li class="last"><a href="#feedbackForm" class="feedbackForm">Заказать обратный звонок</a></li>
				<li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
				<li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
				<li><a href="/search/">Поиск</a></li>
			<!--	<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
				<li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>-->
				<!--	<li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>-->
				</ul>
			</div>
			<div class="col-sm-2">
				<p class="my_h3"><?php echo $text_account; ?></p>
				<ul>
				<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
				<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
				<li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
				<!--<li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>-->
				</ul>
			</div>
			<div class="col-sm-2">
				<p class="my_h3"><?php echo $text_follow; ?></p>
				<ul>
<li><span class="external-reference" data-link="https://www.facebook.com/italy-sumochka"><i class="fa fa-facebook-square"></i><?php echo $text_fb; ?></span></li>
<li><span class="external-reference" data-link="https://twitter.com/italy-sumochka"><i class="fa fa-twitter-square"></i><?php echo $text_twi; ?></span></li>
<li><span class="external-reference" data-link="https://instagram.com/italy-sumochka/"><i class="fa fa-instagram"></i><?php echo $text_instagram; ?></span></li>
<li><span class="external-reference" data-link="http://vk.com/italy-sumochka"><i class="fa fa-vk"></i><?php echo $text_vk; ?></span></li>
                    
				</ul>
			</div>
			<div class="col-sm-2">
				<p class="my_h3">График работы</p>
				<ul>
				<li>Понедельник - Пятница</li>
				<li>с 10.00 до 21.00</li>
				<li>Суббота - Воскресенье</li>
				<li>с 10.00 до 20.00</li>
				<li>Заказы через сайт принимаются круглосуточно и без выходных</li>
				
				</ul>
			</div>
			<div class="col-sm-2">
				<!--<h3><?php echo $text_support; ?></h3>-->
				<div class="foot-phone">
					<div class="extra-wrap">
						
						<p class="my_h3"><?php echo $text_call; ?></p>
						<div style="font-size:10px; font-weight:bold; color: #fff;">Бесплатный звонок по России</div>
						<div style="color: #fff;">8 (800) 555-55-55</div>
						<div><?php echo $telephone; ?></div>
						<div><?php echo $fax; ?></div>
						<div>8 (926) 555-55-55</div>
						
					</div>
				</div>
				<ul>
					
				</ul>
			</div> 
		</div>
		
	</div>
	
	
</footer>
<script type="text/javascript" 	src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/livesearch.js"></script>
</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div id="powered">
				<?php echo $powered; ?><!-- [[%FOOTER_LINK]] --><br>
				
			</div>
		</div>
	</div>
</div>
</div>
<div class="grafik-addres grafik-addres2">
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
<div class="phonemobil">
		<ul>
			 <li>
				<div style="font-size:12px; font-weight:bold; color: #f00;">Бесплатный звонок по России</div>
				<a style="font-size: 22px; color: #f00;" href="tel:+78005555555" >8 (800) 555-55-55</a>
			</li>
			<li>
				<a style="font-size: 22px;" href="tel:+74955555555" >8 (495) 555-55-55</a>
			</li>
			<li>
				<a style="font-size: 22px;" href="tel:+79265555555" >8 (926) 555-55-55</a>
			</li>
			
		</ul>
	</div>

<div style="display: none;" >

	<div id="grafikmodal" >
		<p>В указанное время Вы можете осуществлять звонки для оформления заказа или уточнения информации, а также посетить наш магазин, примерить и выбрать все необходимое.<br> Заказ через сайт можно осуществлять в любое время – 24 часа в сутки, 7 дней в неделю и без выходных.</p>
	</div>
	<div id="feedbackForm" >
	<form action="" method="post" enctype="multipart/form-data" id="feedbackFormItem" class="form-horizontal">
	<input type="hidden" name="mode" value="feedbackForm">
		<div class="content contact-f form-horizontal">
			<h2>Заказать обратный звонок</h2>
			<div class="form-group">
				<label class="control-label col-sm-5" for="name">Ваше имя</label>
				<div class="col-sm-7">
					<input  type="text" name="name" value="" required="required" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-5" for="email">Телефон: </label>
				<div class="controls col-sm-7">
					<input  type="text" name="phone" value="" required="required" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-5" for="email">Email: </label>
				<div class="controls col-sm-7">
					<input  type="email" required="required" name="email" value="" />
				</div>
			</div>
			
				<div class="form-group">			
					<div class="buttons"><button type="submit" class="button"><span>Отправить</span></button></div>
				</div>
			</div>
		</div>
	</form>
	<div id="we-found-cheaper"></div>
	
	<script type="text/javascript">
		// <![CDATA[
			if (document.getElementById('feedbackFormItem'))
			{
				if (document.createTextNode)
				{
					var placeToAdd = document.getElementById('feedbackFormItem');
		 
					var cId = document.createElement('input');
					cId.type  = 'hidden';
					cId.name  = 'ch';
					cId.value = 'y';
		 
					document.getElementById('feedbackFormItem').appendChild(cId);
				}
			}
		// ]]>
		</script>

	</div>
</div>

<!-- LiveTex {literal} -->

<!-- LiveTex {/literal} -->
<script>$('.external-reference').replaceWith (function (){return'<a onclick="return !window.open(this.href)" href="'+$(this).data ('link')+'" title="'+$(this).text ()+'">'+$(this).html ()+'</a>';})</script>
</body></html>