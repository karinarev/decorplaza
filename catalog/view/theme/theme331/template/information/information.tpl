<?php echo $header; ?>
<?php echo $column_left; ?>
		<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content"><?php echo $content_top; ?>
  <?/*<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>*/?>
  <div class="breadcrumb">
			<?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
			<?php echo $breadcrumb['separator']; ?><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>">
			<?php echo $breadcrumb['text']; ?></a> <?php } else { ?><?php echo $breadcrumb['text']; ?><?php } ?>
			<?php } ?>
		</div>
  <h1 class="style-1"><?php echo $heading_title; ?></h1>
  <div class="box-container">
    <?php echo $description; ?>
	
	
	<?php if($this->request->get['information_id'] == 5) :  ?>
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="contact" class="form-horizontal">
	<input type="hidden" name="mode" value="opt3"
	
	<div class="content contact-f form-horizontal">
		<div class="form-group">
			<label class="control-label col-sm-5" for="name">Ваше имя<span style="color: #F00;">*</span>: </label>
			<div class="col-sm-7">
				<input <?php if ($error_name && $_POST) { ?>style="border-color: #F00;"<?php } ?> type="text" name="name" required="required" value="<?php echo $name; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5" for="email">Телефон<span style="color: #F00;">*</span>: </label>
			<div class="controls col-sm-7">
				<input <?php if ($error_phone && $_POST) { ?>style="border-color: #F00;"<?php } ?> type="text" name="phone" value="<?php echo $phone; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5" for="email"><?php echo $entry_email; ?></label>
			<div class="controls col-sm-7">
				<input  type="email" required="required" name="email" value="<?php echo $email; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5" for="email">Город: </label>
			<div class="controls col-sm-7">
				<input required="required" type="text" name="city" value="<?php echo $city; ?>" />
			</div>
		</div>
		 <div class="form-group">
			<label class="control-label col-sm-5" for="enquiry">Комментарии</label>
			<div class="controls col-sm-7">
				<textarea  name="enquiry" cols="40" rows="10" required="required" ><?php echo $enquiry; ?></textarea>
			</div>
		</div> 
		<div class="form-group" style="float: right;">
			<input type="hidden" class="capcha" required="required" name="captcha" value="" />
			<div class="controls col-sm-7" >
				<div class="buttons" style="float: right; margin-right: 113px;"><a onclick="$('#contact').submit();" class="button"><span>Отправить</span></a></div>
			</div>
		</div>
	</div>
	
	
	</form>
	<?php endif; ?>
	
	
  </div>
  <?php echo $content_bottom; ?></div>

<?php echo $column_right; ?>

<?php echo $footer; ?>