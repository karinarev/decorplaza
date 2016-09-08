<?php echo $header; ?>
<?php echo $column_left; ?>
<div class="<?php if ($column_left or $column_right) { ?>col-sm-9<?php } ?> <?php if (!$column_left & !$column_left) { ?>col-sm-12  <?php } ?> <?php if ($column_left & $column_right) { ?>col-sm-6<?php } ?>" id="content"><?php echo $content_top; ?>
  <h3><?php echo $heading_title; ?></h3>
  <?php if ($categories) { ?>
  <div class="row alphabet">
    <div class="col-md-2"><?php echo $text_index; ?> </div>
    <div class="col-md-10">
      <?php foreach ($categories as $category) { ?>
      &nbsp;<a href="/brands/#<?php echo $category['name']; ?>"><?php echo $category['name']; ?></a>
      <?php } ?>
    </div>
  </div>

  <?php foreach ($categories as $category) { ?>
  <h3 id="<?php echo $category['name']; ?>" class="category-name"><?php echo $category['name']; ?></h3>
  <div class="category-divider"></div>
  <?php if ($category['manufacturer']) { ?>
  <?php foreach (array_chunk($category['manufacturer'], 7) as $manufacturers) { ?>
  <div class="row category-row">
    <?php foreach ($manufacturers as $manufacturer) { ?>
    <div class="category-col">
      <div class="category-aria">
        <a href="<?php echo $manufacturer['href']; ?>">
          <img class="category-image img-responsive" src="<?php echo $manufacturer['thumb']; ?>" alt="<?php echo $manufacturer['name']; ?>" title="<?php echo $manufacturer['name']; ?>" />
          <?php echo $manufacturer['name']; ?>
        </a></div>
    </div>

    <?php } ?>
  </div>
  <?php } ?>
  <?php } ?>
  <?php } ?>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button-cont-right"><?php echo $button_continue; ?><i class="fa fa-arrow-circle-right"></a></div>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>

<?php echo $column_right; ?>

<?php echo $footer; ?>

