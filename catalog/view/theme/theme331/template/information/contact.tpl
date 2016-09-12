<?php echo $header; ?>
<?php echo $column_left; ?>
		<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content"><?php echo $content_top; ?>
    <div class="breadcrumb">
			<?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
			<?php echo $breadcrumb['separator']; ?><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>">
			<?php echo $breadcrumb['text']; ?></a> <?php } else { ?><?php echo $breadcrumb['text']; ?><?php } ?>
			<?php } ?>
		</div>
  <h1>Наши контакты</h1>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="contact" class="form-horizontal">
	<h2 style="display:none"><?php echo $text_location; ?></h2>
	<div class="contact-info">
		<div class="content row">
			<div class="map-left col-sm-6"  style="width: 100%;"> 
				<div class="contact-box" >
					<span style="margin-left: 0px;" class="dostavka">Доставка по всей России</span>
				</div>
				<div class="contact-box" >
					<b>Магазин в Москве:</b><br>
				<div class="contact-box" style="width: 100%;"><i class="fa fa-home"></i><b><?php echo $text_address; ?></b>
					<?php echo $address; ?>
				</div>
				</div>

				<div style="display: inline-block; width: 45%; vertical-align: top;">
					<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=sXf1ofePV3VE-_X4NL8Z2zh8nC9LIRLe&width=100%&height=350&lang=ru_RU&sourceType=constructor"></script>
				</div>
				<div style="display: inline-block; width: 45%; vertical-align: top;"><img src="/catalog/view/image/kartinka_dlya_kontaktov.JPG"  style="height: 350px; margin-left:30px;"></div>

				<div style="clear:both;"></div>
				<div class="contact-box">
				<b>График работы:</b><br>
				Понедельник - Пятница<br>
				с 10.00 до 21.00<br>
				Суббота - Воскресенье<br>
				с 10.00 до 20.00<br>
				Заказы через сайт принимаются круглосуточно и без выходных.<br>
				</div>
				<div class="pcphone">
					<div style="font-size:12px; font-weight:bold; color: #EC1313;">Бесплатный звонок по России</div>
					<div class="contact-box" style="color: #EC1313;">
						<?php if ($telephone) { ?>
						<i class="fa fa-phone" style="color: #EC1313;"></i><b style="color: #EC1313;">Телефон: </b>
						8 (800) 500-89-78
						<?php } ?>
					</div>
					<div class="contact-box">
						<?php if ($telephone) { ?>
						<i class="fa fa-phone"></i><b><?php echo $text_telephone; ?></b>
						<?php echo $telephone; ?>
						<?php } ?>
					</div>
					
					<div class="contact-box">
						<?php if ($fax) { ?>
						<i class="fa fa-phone"></i><b><?php echo $text_fax; ?></b>
						<?php echo $fax; ?>
						<?php } ?>
					</div>
					
					<div class="contact-box">
						<?php if ($telephone) { ?>
						<i class="fa fa-phone"></i><b>Телефон: </b>
						8 (926) 025-00-08
						<?php } ?>
					</div>
				</div>
				<div class="mobilphone">
					<div style="font-size:12px; font-weight:bold; color: #EC1313;">Бесплатный звонок по России</div>
					<div class="contact-box" style="color: #EC1313;">
						<?php if ($telephone) { ?>
						<i class="fa fa-phone" style="color: #EC1313;"></i><b style="color: #EC1313;">Телефон: </b>
						<a style="color: #EC1313;" href="tel:+78005008978">8 (800) 500-89-78</a>
						<?php } ?>
					</div>
					<div class="contact-box">
						<?php if ($telephone) { ?>
						<i class="fa fa-phone"></i><b><?php echo $text_telephone; ?></b>
						<a href="tel:+74954907474"><?php echo $telephone; ?></a>
						<?php } ?>
					</div>
					
					<div class="contact-box">
						<?php if ($fax) { ?>
						<i class="fa fa-phone"></i><b><?php echo $text_fax; ?></b>
						<?php echo $fax; ?>
						<?php } ?>
					</div>
					
					<div class="contact-box">
						<?php if ($telephone) { ?>
						<i class="fa fa-phone"></i><b>Телефон: </b>
						<a href="tel:+79260250008">8 (926) 025-00-08</a>
						<?php } ?>
					</div>
				</div>
                
                <div class="contact-box">
					<?php if ($config_email) { ?>
					<i class="fa"></i><b>Email: </b>
					<?php echo $config_email; ?>
					<?php } ?>
				</div>
                
				<div class="clear"></div>
				<div class="share">
					<!-- AddThis Button BEGIN -->
					<span class='st_facebook_hcount' displayText='Facebook'></span>
					<span class='st_twitter_hcount' displayText='Tweet'></span>
					<span class='st_googleplus_hcount' displayText='Google +'></span>
					<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
					<script type="text/javascript">stLight.options({publisher: "00fa5650-86c7-427f-b3c6-dfae37250d99", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
					<!-- AddThis Button END -->
				</div>

<br><br>
				ИП Бидин Борис Алексеевич
<br><br>
				ОГРНИП  304770000588518
<br><br>
				Фактический адрес - 125481, г. Москва, ул. Свободы, д.89, к.5
<br><br>
				Юридический адрес - 125480, г. Москва, ул. Вилиса Лациса, д.42, кв. 375
			</div>

			</div>

		</div>
	</div>
	<div class="content contact-f form-horizontal col-sm-9 ">
		<h2>Заказать обратный звонок</h2>
		<div class="form-group">
			<label class="control-label col-sm-5" for="name"><?php echo $entry_name; ?></label>
			<div class="col-sm-7">
				<input  type="text" name="name" value="<?php echo $name; ?>" />
				<?php if ($error_name) { ?>
				<span class="error help-block"><?php echo $error_name; ?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5" for="email">Телефон: </label>
			<div class="controls col-sm-7">
				<input  type="text" name="phone" value="<?php echo $phone; ?>" />
				<?php if ($error_email) { ?>
				<span class="error help-block"><?php echo $error_phone; ?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5" for="email"><?php echo $entry_email; ?></label>
			<div class="controls col-sm-7">
				<input  type="text" name="email" value="<?php echo $email; ?>" />
				<?php if ($error_email) { ?>
				<span class="error help-block"><?php echo $error_email; ?></span>
				<?php } ?>
			</div>
		</div>
		<!-- <div class="form-group">
			<label class="control-label col-sm-5" for="enquiry"><?php echo $entry_enquiry; ?></label>
			<div class="controls col-sm-7">
				<textarea  name="enquiry" cols="40" rows="10" ><?php echo $enquiry; ?></textarea>
				<?php if ($error_enquiry) { ?>
				<span class="error help-block"><?php echo $error_enquiry; ?></span>
				<?php } ?>
			</div>
		</div> -->
		<div class="form-group">
			<label class="control-label col-sm-5" for="captcha"><?php echo $entry_captcha; ?></label>
			<div class="controls col-sm-7">
				<input type="text" class="capcha" name="captcha" value="<?php echo $captcha; ?>" />
				<div class="captcha"><img src="index.php?route=information/contact/captcha" alt="" /></div>
				<?php if ($error_captcha) { ?>
				<span class="error help-block"><?php echo $error_captcha; ?></span>
				<?php } ?>
				<div class="buttons"><a onclick="$('#contact').submit();" class="button"><span><?php echo $button_continue; ?></span></a></div>
			</div>
		</div>
	</div>
</form>
	<?php echo $content_bottom; ?></div>

<?php echo $column_right; ?>

<?php echo $footer; ?>