<?php echo $header; ?>
<?php echo $column_left; ?>
		<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
  <?php if($_SERVER['REQUEST_URI'] == "/discount-form/"):?>
  <a href="http://italy-sumochka.ru/">Главная</a> » Получить скидку
<?else: ?>
	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
	<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
	<?php } ?>
<?endif;?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  
  <?php if ($errorEmail) { ?>
  <div class="warning"><?php echo $errorEmail; ?></div>
  <?php } ?>
  
  
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="contact" class="form-horizontal">
	<div class="contact-info form">
		<div class="content row">
			<div class="map-left col-sm-6">      
				<div class="contact-box">
					<?php echo $description; ?>
				</div>				
			</div>			
		</div>
	</div>
	<div class="content contact-f form-horizontal">
		<div class="form-group">
			<label class="control-label col-sm-5" for="name"><?php echo $entry_name; ?>*</label>
			<div class="col-sm-7">
				<input  type="text" name="name" value="<?php echo $name; ?>" />
				<?php if ($error_name) { ?>
				<span class="error help-block"><?php echo $error_name; ?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5" for="email"><?php echo $entry_email; ?>*</label>
			<div class="controls col-sm-7">
				<input  type="text" name="email" value="<?php echo $email; ?>" />
				<?php if ($error_email) { ?>
				<span class="error help-block"><?php echo $error_email; ?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group hidden">
			<label class="control-label col-sm-5" for="enquiry"><?php echo $entry_enquiry; ?>*</label>
			<div class="controls col-sm-7">
				<textarea  name="enquiry" cols="40" rows="10" >Хотел бы получить скидку</textarea>
				<?php if ($error_enquiry) { ?>
				<span class="error help-block"><?php echo $error_enquiry; ?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5" for="captcha"><?php echo $entry_captcha; ?>*</label>
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