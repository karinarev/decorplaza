<?php echo $header; ?>
<?php echo $column_left; ?>
		<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
			<?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
			<?php echo $breadcrumb['separator']; ?><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>">
			<?php echo $breadcrumb['text']; ?></a> <?php } else { ?><?php echo $breadcrumb['text']; ?><?php } ?>
			<?php } ?>
		</div>
  <h1><?php echo $heading_title; ?></h1>
  
  <?php if ($errorEmail) { ?>
  <div class="warning"><?php echo $errorEmail; ?></div>
  <?php } ?>
  
  
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="contact" class="form-horizontal">
	
	<div class="content contact-f form-horizontal">
		<div class="form-group">
			<label class="control-label col-sm-5" for="family">Фамилия:*</label>
			<div class="col-sm-7">
				<input  type="text" name="family" value="<?php echo $family; ?>" />
				<?php if ($error_family) { ?>
				<span class="error help-block"><?php echo $error_family; ?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5" for="name">Имя:*</label>
			<div class="col-sm-7">
				<input  type="text" name="name" value="<?php echo $name; ?>" />
				<?php if ($error_name) { ?>
				<span class="error help-block"><?php echo $error_name; ?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5" for="otchestvo">Отчество:*</label>
			<div class="col-sm-7">
				<input  type="text" name="otchestvo" value="<?php echo $otchestvo; ?>" />
				<?php if ($error_otchestvo) { ?>
				<span class="error help-block"><?php echo $error_otchestvo; ?></span>
				<?php } ?>
			</div>
		</div>
		
		
		<div class="form-group">
			<label class="control-label col-sm-5" for="email">E-mail:*</label>
			<div class="controls col-sm-7">
				<input  type="text" name="email" value="<?php echo $email; ?>" />
				<?php if ($error_email) { ?>
				<span class="error help-block"><?php echo $error_email; ?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5" for="ncart">№ карты:*</label>
			<div class="controls col-sm-7">
				<input  type="text" name="ncart" value="<?php echo $ncart; ?>" />
				<?php if ($error_ncart) { ?>
				<span class="error help-block"><?php echo $error_ncart; ?></span>
				<?php } ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-5" for="captcha"><?php echo $entry_captcha; ?></label>
			<div class="controls col-sm-7">
				
				<div class="buttons"><a onclick="$('#contact').submit();" class="button"><span>Активировать</span></a></div>
			</div>
		</div>
		Поля отмеченные * обязательны для заполнения.
	</div>
</form>
	<?php echo $content_bottom; ?></div>

<?php echo $column_right; ?>

<?php echo $footer; ?>