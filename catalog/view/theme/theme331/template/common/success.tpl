<?php echo $header; ?>
<?php echo $column_left; ?>
		<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content"><?php echo $content_top; ?>

  <h3><?php echo $heading_title; ?></h3>
  <div class="box-container">
    <?php echo $text_message; ?>
    <div class="buttons">
      <a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a>
    </div>
  </div>
  <?php echo $content_bottom; ?>
  <?php echo $elkom; ?>
  </div>

<?php echo $column_right; ?>

<?php echo $footer; ?>