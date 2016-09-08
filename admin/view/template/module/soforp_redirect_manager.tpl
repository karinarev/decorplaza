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
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
          <table class="form">
          <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="soforp_redirect_manager_status">
                      <option <?php if ($soforp_redirect_manager_status == 0) { ?> selected="selected" <?php } ?> value="0"><?php echo $text_disabled; ?></option>
                      <option <?php if ($soforp_redirect_manager_status == 1) { ?> selected="selected" <?php } ?> value="1"><?php echo $text_enabled; ?></option>
                  </select></td>
          </tr>
              <tr>
                  <td><?php echo $entry_debug; ?></td>
                  <td><select name="soforp_redirect_manager_debug">
                          <option <?php if ($soforp_redirect_manager_debug == 0) { ?> selected="selected" <?php } ?> value="0"><?php echo $text_disabled; ?></option>
                          <option <?php if ($soforp_redirect_manager_debug == 1) { ?> selected="selected" <?php } ?> value="1"><?php echo $text_enabled; ?></option>
                      </select></td>
              </tr>
      </table>
      <div class="description">
        <?php echo $text_description; ?>
      </div>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>