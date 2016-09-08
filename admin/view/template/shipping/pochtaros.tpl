<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
        <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-data"><?php echo $text_methods; ?></a></div>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
        <table class="form">
          <tr>
            <td><?php echo $entry_name; ?></td>
            <td><input type="text" name="pochtaros_name" value="<?php if (isset($pochtaros_name)) echo $pochtaros_name; ?>" /></td>
          </tr>

          <tr>
            <td><?php echo $entry_store; ?></td>
            <td>
              <div class="scrollbox">
                <?php $class = 'even'; ?>
                <div class="<?php echo $class; ?>">
                  <input type="checkbox" name="pochtaros_store[]" value="0" <?php if (isset($pochtaros_store) and in_array(0, $pochtaros_store)) { ?>checked="checked"<?php } ?> />
                  <?php echo $text_default; ?>
                </div>
                <?php foreach ($stores as $store) { ?>
                    <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                    <div class="<?php echo $class; ?>">
                      <input type="checkbox" name="pochtaros_store[]" value="<?php echo $store['store_id']; ?>" <?php if (isset($pochtaros_store) and in_array($store['store_id'], $pochtaros_store)) { ?>checked="checked"<?php } ?> />
                      <?php echo $store['name']; ?>
                    </div>
                <?php } ?>
              </div>
                <?php if ($error_store) { ?>
                <span class="error"><?php echo $error_store; ?></span>
                <?php } ?>
            </td>
          </tr>

            <tr>
              <td><?php echo $entry_city; ?></td>
              <td><input type="text" name="pochtaros_city" value="<?php if (isset($pochtaros_city)) echo $pochtaros_city; ?>" /></td>
            </tr>

            <tr>
                <td><?php echo $entry_zone; ?></td>
                <td><select name="pochtaros_zone_id">
                        <option value=""><?php echo $text_select; ?></option>
                        <?php
                        foreach ($zones as $zone) {
                            if ($zone['status'] == 1) {
                                if ($zone['zone_id'] == $pochtaros_zone_id) { ?>
                                    <option value="<?php echo $zone['zone_id']; ?>" selected="selected"><?php echo $zone['name']; ?></option>
                                <?php
                                }
                                else {
                                ?>
                                    <option value="<?php echo $zone['zone_id']; ?>"><?php echo $zone['name']; ?></option>
                                <?php
                                }
                                ?>
                        <?php
                            }
                        }
                        ?>
                    </select>
            </tr>

            <tr>
                <td><?php echo $entry_weight_class; ?></td>
                <td><select name="pochtaros_weight_class_id">
                        <?php foreach ($weight_classes as $weight_class) { ?>
                        <?php if ($weight_class['weight_class_id'] == $pochtaros_weight_class_id) { ?>
                        <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select></td>
            </tr>

            <tr>
              <td><?php echo $entry_min_weight; ?></td>
              <td><input type="text" name="pochtaros_min_weight" value="<?php if (isset($pochtaros_min_weight)) echo $pochtaros_min_weight; ?>" />
                  <?php if ($error_min_weight) { ?>
                  <span class="error"><?php echo $error_min_weight; ?></span>
                  <?php } ?>
              </td>
            </tr>

            <tr>
              <td><?php echo $entry_max_weight; ?></td>
              <td><input type="text" name="pochtaros_max_weight" value="<?php if (isset($pochtaros_max_weight)) echo $pochtaros_max_weight; ?>" />
                  <?php if ($error_max_weight) { ?>
                  <span class="error"><?php echo $error_max_weight; ?></span>
                  <?php } ?>
              </td>
            </tr>

          <tr>
            <td><?php echo $entry_cost; ?></td>
            <td><input type="text" name="pochtaros_cost" value="<?php if (isset($pochtaros_cost)) echo $pochtaros_cost; ?>" />
                <?php if ($error_cost) { ?>
                <span class="error"><?php echo $error_cost; ?></span>
                <?php } ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_total; ?></td>
            <td><input type="text" name="pochtaros_total" value="<?php if (isset($pochtaros_total)) echo $pochtaros_total; ?>" />
                <?php if ($error_total) { ?>
                <span class="error"><?php echo $error_total; ?></span>
                <?php } ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_max_total; ?></td>
            <td><input type="text" name="pochtaros_max_total" value="<?php if (isset($pochtaros_max_total)) echo $pochtaros_max_total; ?>" />
                <?php if ($error_max_total) { ?>
                <span class="error"><?php echo $error_max_total; ?></span>
                <?php } ?>
            </td>
          </tr>

            <tr>
              <td><?php echo $entry_upakovka; ?></td>
              <td><input type="text" name="pochtaros_upakovka" value="<?php if (isset($pochtaros_upakovka)) echo $pochtaros_upakovka; ?>" />
                  <?php if ($error_upakovka) { ?>
                  <span class="error"><?php echo $error_upakovka; ?></span>
                  <?php } ?>
              </td>
            </tr>

          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td>
              <div class="scrollbox">
                <?php $class = 'even'; ?>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                    <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                    <div class="<?php echo $class; ?>">
                      <input type="checkbox" name="pochtaros_geo_zone[]" value="<?php echo $geo_zone['geo_zone_id']; ?>" <?php if (isset($pochtaros_geo_zone) and in_array($geo_zone['geo_zone_id'], $pochtaros_geo_zone)) { ?>checked="checked"<?php } ?> />
                      <?php echo $geo_zone['name']; ?>
                    </div>
                <?php } ?>
              </div>
                <?php if ($error_geo_zone) { ?>
                <span class="error"><?php echo $error_geo_zone; ?></span>
                <?php } ?>
            </td>
          </tr>

          <tr>
            <td><?php echo $entry_fragmentation; ?></td>
            <td><input type="checkbox" name="pochtaros_fragmentation" value="1" <?php if ($pochtaros_fragmentation) { ?>checked="checked"<?php } ?> /></td>
          </tr>

          <tr>
              <td><?php echo $entry_sort_order; ?></td>
              <td><input type="text" name="pochtaros_sort_order" value="<?php echo $pochtaros_sort_order; ?>" size="1" /></td>
          </tr>

          <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="pochtaros_status">
                  <?php if ($pochtaros_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
          </tr>

        </table>
        </div>
        <div id="tab-data">
            <div id="methods" class="vtabs">
                <?php foreach ($methods as $method) { ?>
                    <a href="#tab-method-<?php echo $method['key']; ?>"><?php echo $method['title']; ?></a>
                <?php } ?>

                <?php foreach ($methods as $method) { ?>
                    <div id="tab-method-<?php echo $method['key']; ?>" class="vtabs-content">
                        <table class="form" style="width:400px;">
                            <tr>
                                <td><?php echo $entry_price; ?></td>
                                <td><input type="text" name="pochtaros_price[<?php echo $method['key'];?>]" value="<?php if (isset($pochtaros_price[$method['key']])) echo $pochtaros_price[$method['key']]; ?>" />
                                    <?php if (isset($error_price[$method['key']])) { ?>
                                    <p class="error"><?php echo $error_number; ?></p>
                                    <?php } ?>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo $entry_status; ?></td>
                                <td><select name="pochtaros_mstatus[<?php echo $method['key'];?>]">
                                        <?php if ($pochtaros_mstatus[$method['key']]) { ?>
                                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                        <option value="0"><?php echo $text_disabled; ?></option>
                                        <?php } else { ?>
                                        <option value="1"><?php echo $text_enabled; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                        <?php } ?>
                                    </select></td>
                            </tr>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
    $('#tabs a').tabs();
    $('#methods a').tabs();
    $('#languages a').tabs();
    //--></script>
<?php echo $footer; ?>