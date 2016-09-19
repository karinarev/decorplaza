<?php echo $header; ?>
<?php echo $column_left; ?>
<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content"><?php echo $content_top; ?>
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
    </ul>
    <h3 class="category-header"><?php echo $heading_title; ?></h3>
    <div class="box-container">
        <div class="content"><?php echo $text_error; ?></div>
    </div>
    </div>
<div class="clear"></div>
<div class="content-bottom">
    <?php echo $content_bottom; ?>
</div>

<?php echo $column_right; ?>

<?php echo $footer; ?>