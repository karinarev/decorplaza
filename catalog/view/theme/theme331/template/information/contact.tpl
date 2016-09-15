<?php echo $header; ?>
<?php echo $column_left; ?>
		<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content"><?php echo $content_top; ?>
  <h1 class="myHeader">Контакты</h1>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="contact" class="form-horizontal">
	<h2 style="display:none"><?php echo $text_location; ?></h2>
	<div class="contact-info">
		<div class="content row">
			<div class="map-left col-sm-6"  style="width: 100%;">
                <div class="row contactsFullRow">
                    <div style="display: inline-block; vertical-align: top;" class="col-sm-6">
                        <div class="col-sm-6">
                            <div class="row contactsRow">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <img class="contactsIcon" src="/image/adress.png">
                                </div>
                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                    <span class="headerText boldText firstParagraph">Адрес:</span><br/>
                                    <p class="contact-text"> Московская область, г.Балашиха, Носовихинское ш., владение 4, Торговый Центр "Никольский Парк", 1 этаж(проезд от м. Новокосино) </p>
                                </div>
                            </div>
                            <div class="row contactsRow">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <img class="contactsIcon" src="/image/schedule.png">
                                </div>
                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                    <span class="headerText boldText">График работы:</span><br/>
                                    <p class="contact-text">Понедельник - Пятница с 10.00 до 21.00<br/>
                                    Суббота - Воскресенье с 10.00 до 20.00<br/>
                                    Заказы через сайт принимаются круглосуточно и без выходных.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row contactsRow">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <img class="contactsIcon" src="/image/telephone.png">
                                </div>
                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                    <span class="headerText boldText">Телефоны:</span><br/>
                                    <p class="contact-text">8 (925) 397-79-13<br/>
                                    <?php if ($telephone) echo $telephone; ?><br/>
                                    8 (925) 397-79-12</p>
                                </div>
                            </div>
                            <div class="row contactsRow">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <img class="contactsIcon" src="/image/email.png">
                                </div>
                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                    <span class="headerText boldText lastParagraph">Email:</span>
                                    <?php echo $config_email; ?><br/>
                                    <p class="contact-text"><span class="spanOriginalSpaces">
                                        Наименование Общество с ограниченной ответственностью "МАРШАЛ ПЛЮС". <br/>
                                        ИНН 5001083150 КПП 500101001 ОГРН 1115001006218 ОКПО 90171834<br/>
                                        Мы будем признательны вам за любые замечания и отзывы о нашей работе, а также предложения по улучшению качества обслуживания.
                                    </span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: inline-block; vertical-align: top;" class="col-sm-6">
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=ekSFBwanpGIcv-Vv0cKpbygc1p_DeoyM&amp;width=560&amp;height=420&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
                    </div>
                </div>
				<div style="clear:both;"></div>
			</div>
			</div>
		</div>
	</div>
<hr class="contactHr">
<h2 class="myHeader">Свяжитесь с нами</h2>
	<div class="content contact-f form-horizontal">
        <?php echo $successMessage; ?>
		<div class="form-group col-sm-4">
			<label class="control-label" for="name"><span class="colorRed">*</span>Имя:</label>
			<div>
				<input  type="text" name="name" value="<?php echo $name; ?>" />
				<?php if ($error_name) { ?>
				<span class="error help-block colorRed"><?php echo $error_name; ?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group col-sm-4">
			<label class="control-label" for="email"><span class="colorRed">*</span>Телефон: </label>
			<div class="controls">
				<input  type="text" name="phone" value="<?php echo $phone; ?>" />
				<?php if ($error_phone) { ?>
				<span class="error help-block colorRed"><?php echo $error_phone; ?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group col-sm-4">
			<label class="control-label" for="email">E-mail:</label>
			<div class="controls">
				<input  type="text" name="email" value="<?php echo $email; ?>" />
			</div>
		</div>
        <div class="col-sm-8">
            <label class="control-label" for="captcha">Тема сообщения:</label>
            <div class="controls">
                <input name="enquiry" id="input-enquiry" type="text"/>
                <?php if ($error_enquiry) { ?>
                <span class="error help-block colorRed"><?php echo $error_enquiry; ?></span>
                <?php } ?>
            </div>
            <span class="colorRed necessaryFields">*Поля, обязательные для заполнения</span>
            </div>
		<div class="form-group col-sm-4">
			<label class="control-label" for="captcha"><span class="colorRed">*</span>Код на картинке</label>
			<div class="controls captchaControl">
                <div class="captcha"><img src="index.php?route=information/contact/captcha" alt="" /></div>
				<input type="text" class="capcha" name="captcha" value="<?php echo $captcha; ?>" />
			</div>
		</div>
        <button class="callBackSend" type="submit" onclick="$('#contact').submit();">
            Отправить
        </button>
	</div>
</form>
	<?php echo $content_bottom; ?></div>

<?php echo $column_right; ?>

<?php echo $footer; ?>

<link href="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/stylesheet/contact.css" rel="stylesheet" type="text/css" />