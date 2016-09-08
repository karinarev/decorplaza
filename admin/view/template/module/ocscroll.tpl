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
        
     <div class="vtabs">
     <a href="#tab-general"><?php echo $tab_general; ?></a> 
     <a href="#tab-contact"><?php echo $tab_contact; ?></a>
     </div>
       <div id="tab-contact" class="htabs-content">
   
</div>
 
   <div id="tab-general" class="vtabs-content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
        <tr>
          <td><span class="required">*</span><?php echo $entry_enable_module; ?></td>
          <td><?php if ($settings_enable) { ?>
            <input type="radio" name="oc_scroll_settings[enable]" value="1" checked="checked" />
            <?php echo $text_yes; ?>
            <input type="radio" name="oc_scroll_settings[enable]" value="0" />
            <?php echo $text_no; ?>
            <?php } else { ?>
            <input type="radio" name="oc_scroll_settings[enable]" value="1" />
            <?php echo $text_yes; ?>
            <input type="radio" name="oc_scroll_settings[enable]" value="0" checked="checked" />
            <?php echo $text_no; ?>
            <?php } ?></td>
        </tr>
        <tr>
          <td><?php echo $entry_loading_text; ?></td>
          <td>
          <?php foreach ($languages as $language) { ?>
              <textarea cols="40" rows="3" name="oc_scroll_settings[<?php echo $language['language_id']; ?>][txtloading]" /><?php echo isset($settings_txtloading[$language['language_id']]) ? $settings_txtloading[$language['language_id']] : ''; ?></textarea>
              <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
           <?php } ?>
          </td>
        </tr>
        <tr>
          <td><?php echo $entry_end_text; ?></td>
          <td>
          <?php foreach ($languages as $language) { ?>
          <textarea cols="40" rows="3" name="oc_scroll_settings[<?php echo $language['language_id']; ?>][txtend]" /><?php echo isset($settings_txtend[$language['language_id']]) ? $settings_txtend[$language['language_id']] : ''; ?></textarea>
          
              <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
           <?php } ?>
          </td>
        </tr>
        <tr>
          <td><?php echo $entry_content; ?></td>
          <td><input size="50" name="oc_scroll_settings[selector]" value="<?php echo isset($settings_selector)? $settings_selector : ''; ?>"       type="text" />
         </td>
        </tr>
        <td><?php echo $entry_item_selector; ?></td>
          <td><input size="50" name="oc_scroll_settings[item_selector]" value="<?php echo isset($settings_item_selector)? $settings_item_selector : ''; ?>"   type="text" />
          
          
         </td>
        </tr>
        <tr>
          <td><?php echo $entry_chk_image_text; ?></td>
          <td><?php if ($settings_image) { ?>
            <input type="radio" name="oc_scroll_settings[image]" value="1" checked="checked" />
            <?php echo $text_yes; ?>
            <input type="radio" name="oc_scroll_settings[image]" value="0" />
            <?php echo $text_no; ?>
            <?php } else { ?>
            <input type="radio" name="oc_scroll_settings[image]" value="1" />
            <?php echo $text_yes; ?>
            <input type="radio" name="oc_scroll_settings[image]" value="0" checked="checked" />
            <?php echo $text_no; ?>
            <?php } ?></td>
        </tr>
   </table>
    </form> 
        </div>
          
      
  
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
       
    
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('.vtabs a').tabs(); 
//--></script> 
<?php echo $footer; ?> 