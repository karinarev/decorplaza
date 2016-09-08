<div class="panel-group category-panel">

  <?php foreach ($categories as $category) { ?>
  <?php if ($category['children']) { ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <a class="category-link" data-toggle="collapse" data-target="#collapse<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a>
    </div>
    <div id="collapse<?php echo $category['category_id']; ?>" class="panel-collapse collapse in">
      <div class="panel-body">
        <ul class="box-category-children">
          <?php foreach ($category['children'] as $child) { ?>
          <?php if ($child['category_id'] == $child_id) { ?>
          <li class="active">
            <a href="<?php echo $child['href']; ?>" class="active"><?php echo $child['name']; ?></a>
            <?php } else { ?>
          <li>
            <a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
            <?php } ?>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
  <?php } else { ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
    </div>
  </div>
  <?php } ?>

  <?php } ?>

</div>