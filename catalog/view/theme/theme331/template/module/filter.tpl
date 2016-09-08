<div class="panel-group filter-panel">
  <div class="panel panel-default">
    <div class="panel-heading">
      <a class="filter-link" data-toggle="collapse" data-target="#collapseFilter"><?php echo $heading_title; ?></a>
    </div>
    <div id="collapseFilter" class="panel-collapse collapse in">
      <div class="filter-body">
        <div class="list-group">
          <?php foreach ($filter_groups as $filter_group) { ?>

          <a class="list-group-item"><?php echo $filter_group['name']; ?></a>
          <div class="list-group-wrapper">
            <div class="list-group-item">
              <div id="filter-group<?php echo $filter_group['filter_group_id']; ?>">
                <?php foreach ($filter_group['filter'] as $filter) { ?>
                <div class="checkbox filter-item">
                  <label class="label-group">
                    <?php if (in_array($filter['filter_id'], $filter_category)) { ?>
                    <input type="checkbox" name="filter[]" value="<?php echo $filter['filter_id']; ?>" checked="checked" class="filter-checkbox" id="checkbox<?php echo $filter['filter_id']; ?>" onchange="filterChanged('<?php echo $action; ?>', this)" />
                    <label for="checkbox<?php echo $filter['filter_id']; ?>"><?php echo $filter['name']; ?></label>

                    <?php } else { ?>
                    <input type="checkbox" name="filter[]" value="<?php echo $filter['filter_id']; ?>" class="filter-checkbox" id="checkbox<?php echo $filter['filter_id']; ?>" onchange="filterChanged('<?php echo $action; ?>', this)"/>
                    <label for="checkbox<?php echo $filter['filter_id']; ?>"><?php echo $filter['name']; ?></label>

                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="panel-footer text-center">
        <button type="button" id="button-filter" class="btn btn-filter" onclick="filterButtonClicked('<?php echo $action; ?>')"><?php echo $button_filter; ?></button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript"><!--


  $('.list-group-wrapper').each(function () {
    if($(this).find('.filter-item').length > 8){
      $(this).height($('.filter-item:eq(8)').position().top - 5)
              .mCustomScrollbar({
                axis:"y"
              });
    }

  });



  //--></script>
