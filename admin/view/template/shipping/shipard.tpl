<?php
/*
*    .ru
*    .ru
*/
?>

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
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		  <input type="hidden" name="shipard_status" value="true">
		  <table >
			  <tr>
				  <td><?php echo $text_shipard_name; ?></td>
				  <td><input type="text" name="shipard_name" style="width: 200px;" value="<?php echo $shipard_name?>"></td>
                                  <td style="padding-left: 50px;"><?php echo $text_shipard_index?></td>
				  <td style="text-align: right;"><input type="text" name="shipard_index" value="<?php echo $shipard_index?>"></td>
			  
                          </tr>
                          <tr>
				  <td><?php echo $text_shipard_noview?></td>
				  <td style="text-align: right;"><input type="checkbox" name="shipard_noview" value="1" <?php if(isset($shipard_noview)) { if($shipard_noview=='1') { echo 'checked="checked"'; }}?>></td>
                                  <td style="padding-left: 50px;"><?php echo $text_shipard_weight?></td>
				  <td style="text-align: right;"><input type="number" style="width: 133px" name="shipard_weight" value="<?php echo $shipard_weight?>"></td>
			  </tr>
			  <tr>
				  <td><?php echo $text_shipard_sort_order?></td>
				  <td style="text-align: right;"><input type="text" size="3" name="shipard_sort_order" value="<?php echo $shipard_sort_order?>"></td>
                                  <td style="padding-left: 50px;"><?php echo $text_shipard_weight_pack?></td>
				  <td style="text-align: right;"><input type="number" style="width: 133px" name="shipard_weight_pack" value="<?php echo $shipard_weight_pack?>"></td>
			  </tr>
                          
                          <tr>
				  <td><?php echo $text_shipard_parent?></td>
				  <td style="text-align: right;"><input type="text" name="shipard_parent" value="<?php echo $shipard_parent?>"></td>
                                  <td style="padding-left: 50px;"><?php echo $text_shipard_inner?></td>
				  <td style="text-align: right;"><input type="checkbox" name="shipard_inner" value="1" <?php if(isset($shipard_inner)) { if($shipard_inner == '1') { echo 'checked="checked"';}}?>></td>
                          </tr>
                          <tr>
				  <td><?php echo $text_shipard_php?></td>
                                  <td style="text-align: right;">
                                      <select name="shipard_php">
                                          <option value="0" <?php if($shipard_php == '0'){ ?>selected="selected"<?php } ?>>PHP - serialize() - windows-1251</option>
                                          <option value="1" <?php if($shipard_php == '1'){ ?>selected="selected"<?php } ?>>XML - WDXX - UTF-8</option>
                                      </select>
                                  </td>
                                  <td style="padding-left: 50px;"><?php echo $text_shipard_opis?></td>
				  <td style="text-align: right;"><input type="checkbox" name="shipard_opis" value="1" <?php if(isset($shipard_opis)) { if($shipard_opis=='1'){ echo 'checked="checked"';}}?>></td>
                          
			  </tr>
                          <tr>
				  <td></td>
                                  <td></td>
                                  <td style="padding-left: 50px;"><?php echo $text_shipard_time?></td>
				  <td style="text-align: right;"><input type="checkbox" name="shipard_time" value="1" <?php if(isset($shipard_time)) { if($shipard_time=='1'){ echo 'checked="checked"';}}?>></td>
                          
			  </tr>
                  </table>
		  <table id="module" class="list">
			<thead>
			  <tr>
				<td class="left"><?php echo $entry_name; ?></td>
                                <td class="left"><?php echo $entry_type; ?></td>
				<td class="left"><?php echo $entry_cost; ?></td>
				<td class="left"><?php echo $entry_tax_class; ?></td>
				<td class="left"><?php echo $entry_geo_zone; ?></td>
				<td class="right"><?php echo $entry_status; ?></td>
				<td class="right"><?php echo $entry_sort_order; ?></td>
				<td></td>
			  </tr>
			</thead>
			<?php $module_row = 0; ?>
			<?php foreach ($modules as $module) { ?>
			<tbody id="module-row<?php echo $module_row; ?>">
			  <tr>
			    <td class="left"><input type="text" name="shipard[<?php echo $module_row; ?>][name]" value="<?php echo $module['name']; ?>" size="40" /></td>
			    <td class="left">
                                <select name="shipard[<?php echo $module_row; ?>][shipard_type]">
                                <option value="0" <?php if($module['shipard_type'] == '0'){ ?>selected="selected"<?php } ?>><?php echo $text_post_banderol; ?></option>
                                <option value="1" <?php if($module['shipard_type'] == '1'){ ?>selected="selected"<?php } ?>><?php echo $text_post_zak_banderol; ?></option>
                                <option value="2" <?php if($module['shipard_type'] == '2'){ ?>selected="selected"<?php } ?>><?php echo $text_post_zak_banderol_1; ?></option>
                                <option value="3" <?php if($module['shipard_type'] == '3'){ ?>selected="selected"<?php } ?>><?php echo $text_post_cen_banderol; ?></option>
                                <option value="4" <?php if($module['shipard_type'] == '4'){ ?>selected="selected"<?php } ?>><?php echo $text_post_cen_posilka; ?></option>
                                <option value="5" <?php if($module['shipard_type'] == '5'){ ?>selected="selected"<?php } ?>><?php echo $text_post_cen_avio_banderol; ?></option>
                                <option value="6" <?php if($module['shipard_type'] == '6'){ ?>selected="selected"<?php } ?>><?php echo $text_post_cen_avio_posilka; ?></option>
                                <option value="7" <?php if($module['shipard_type'] == '7'){ ?>selected="selected"<?php } ?>><?php echo $text_post_cen_banderol_1; ?></option>
                                <option value="8" <?php if($module['shipard_type'] == '8'){ ?>selected="selected"<?php } ?>><?php echo $text_post_ems; ?></option>
                                <option value="9" <?php if($module['shipard_type'] == '9'){ ?>selected="selected"<?php } ?>><?php echo $text_post_fix; ?></option>
                                </select>
                            </td>
                            <td class="left"><input type="text" name="shipard[<?php echo $module_row; ?>][cost]" value="<?php echo $module['cost']; ?>" size="5" /></td>
				<td class="left"><select name="shipard[<?php echo $module_row; ?>][tax_class_id]">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($tax_classes as $tax_class) { ?>
                  <?php if ($tax_class['tax_class_id'] == $module['tax_class_id']) { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
				<td class="left"><select name="shipard[<?php echo $module_row; ?>][geo_zone_id]">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $module['geo_zone_id']) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
				<td class="right"><select name="shipard[<?php echo $module_row; ?>][status]">
                <?php if ($module['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
				<td class="right"><input type="text" name="shipard[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
				<td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
			  </tr>
			</tbody>
			<?php $module_row++; ?>
			<?php } ?>
			<tfoot>
			  <tr>
				<td colspan="6"></td>
				<td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
			  </tr>
			</tfoot>
		  </table>
      </form>
         Поле <b>"цена"</b> служит для увеличения стоимости доставки. Зачем это нужно? Что бы Вы могли заработать на доставке, если хотите. Я например ставлю 50 рублей, так как приходится ехать на почту + делать жесткую упаковку.
         Если выбран тип <b>"Фиксированная цена"</b>, то никаких расчетов происходить не будет. Просто тупо поставится поле стоимость.<br/><br/>
         Галочка <b>"Убирать, если находимся в родном регионе"</b>, служит для отключения данного модуля для района, указанного в настройках интернет магазина. Например в своем районе используйте просто доставку по городу.
         <br/><br/><center><font style="font-size:14px; margin-top:10px;">В качестве благодарности от Вас, хотел бы увидеть на Вашем сайте ссылку на мой магазин <a href="http://arduino55.ru/" target="_blank">http://arduino55.ru/</a> Буду очень признателен! Если есть вопросы - пишите misterspaun@gmail.com</font></center>
         В случае ошибки: <b>Warning: file_get_contents()...</b> Добавляем в файл .htaccess: php_value allow_url_fopen On
    </div>
  </div>
	copyright &copy; <a href="mailto:misterspaun@gmail.com">Ilya Isaev</a>

</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {
	html  = '<tbody id="module-row' + module_row + '">';
	html += '<tr>';
	html += '	<td class="left"><input type="text" name="shipard[' + module_row + '][name]" size="40" /></td>';
        html += '	<td class="left"><select name="shipard[<?php echo $module_row; ?>][shipard_type]">';
        html += '                        <option value="0" <?php if(isset($module["shipard_type"])) { if($module["shipard_type"] == "0"){ ?>selected="selected"<?php }} ?>><?php echo $text_post_banderol; ?></option>';
        html += '                        <option value="1" <?php if(isset($module["shipard_type"])) { if($module["shipard_type"] == "1"){ ?>selected="selected"<?php }} ?>><?php echo $text_post_zak_banderol; ?></option>';
        html += '                        <option value="2" <?php if(isset($module["shipard_type"])) { if($module["shipard_type"] == "2"){ ?>selected="selected"<?php }} ?>><?php echo $text_post_zak_banderol_1; ?></option>';
        html += '                        <option value="3" <?php if(isset($module["shipard_type"])) { if($module["shipard_type"] == "3"){ ?>selected="selected"<?php }} ?>><?php echo $text_post_cen_banderol; ?></option>';
        html += '                        <option value="4" <?php if(isset($module["shipard_type"])) { if($module["shipard_type"] == "4"){ ?>selected="selected"<?php }} ?>><?php echo $text_post_cen_posilka; ?></option>';
        html += '                        <option value="5" <?php if(isset($module["shipard_type"])) { if($module["shipard_type"] == "5"){ ?>selected="selected"<?php }} ?>><?php echo $text_post_cen_avio_banderol; ?></option>';
        html += '                        <option value="6" <?php if(isset($module["shipard_type"])) { if($module["shipard_type"] == "6"){ ?>selected="selected"<?php }} ?>><?php echo $text_post_cen_avio_posilka; ?></option>';
        html += '                        <option value="7" <?php if(isset($module["shipard_type"])) { if($module["shipard_type"] == "7"){ ?>selected="selected"<?php }} ?>><?php echo $text_post_cen_banderol_1; ?></option>';
        html += '                        <option value="8" <?php if(isset($module["shipard_type"])) { if($module["shipard_type"] == "8"){ ?>selected="selected"<?php }} ?>><?php echo $text_post_ems; ?></option>';
        html += '                        <option value="9" <?php if(isset($module["shipard_type"])) { if($module["shipard_type"] == "9"){ ?>selected="selected"<?php }} ?>><?php echo $text_post_fix; ?></option>';
        html += '                        </select></td>';
	html += '	<td class="left"><input type="text" name="shipard[' + module_row + '][cost]" size="5" /></td>';
	html += '	<td class="left"><select name="shipard[' + module_row + '][tax_class_id]">';
	html += '	  <option value="0"><?php echo $text_none; ?></option>';
	<?php foreach ($tax_classes as $tax_class) { ?>
		html += '	  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>';
    <?php } ?>
	html += '	</select></td>';
	html += '	<td class="left"><select name="shipard[' + module_row + '][geo_zone_id]">';
	html += '	<option value="0"><?php echo $text_all_zones; ?></option>';
    <?php foreach ($geo_zones as $geo_zone) { ?>
		html += '	<option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>';
    <?php } ?>
	html += '	</select></td>';
	html += '	<td class="right"><select name="shipard[' + module_row + '][status]">';
	html += '	<option value="1"><?php echo $text_enabled; ?></option>';
	html += '	<option value="0" selected="selected"><?php echo $text_disabled; ?></option>';
	html += '	</select></td>';
	html += '	<td class="right"><input type="text" name="shipard[' + module_row + '][sort_order]" size="3" /></td>';
	html += '	<td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '	</tr>';
	html += '</tbody>';

	$('#module tfoot').before(html);

	module_row++;
}
//--></script>
<?php echo $footer; ?>