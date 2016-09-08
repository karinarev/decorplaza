<div id="redirect-popup-title">
    <?php echo $text_redirect_popup_title; ?>
</div>
<div id="redirect-popup-content">
    <div>
        <table>
            <?php if ( isset($item_id) ) { ?>
            <input name="item_id" type="hidden" value="<?php echo $item_id; ?>">
            <?php } ?>
            <tr>
                <td>
                    <label for="active"><?php echo $entry_active; ?></label>
                    <select id="active" name="item[active]">
                        <option value="0" <?php if( !$item['active'] ) echo 'selected="selected"';?> ><?php echo $text_disabled; ?></option>
                        <option value="1" <?php if( $item['active'] ) echo 'selected="selected"';?> ><?php echo $text_enabled; ?></option>
                    </select>
                </td>
                <td>
                    <label for="response_code"><?php echo $entry_response_code; ?></label>
                    <select id="response_code" name="item[response_code]">
                        <option value="301"<?php if( $item['response_code'] == 301 ) echo 'selected="selected"';?> ><?php echo $text_response_code_301; ?></option>
                        <option value="302"<?php if( $item['response_code'] == 302 ) echo 'selected="selected"';?> ><?php echo $text_response_code_302; ?></option>
                        <option value="307"<?php if( $item['response_code'] == 307 ) echo 'selected="selected"';?> ><?php echo $text_response_code_307; ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="required">*</span> <label for="from_url"><?php echo $entry_from_url; ?></label>
                    <textarea id="from_url" rows="3" cols="90" name="item[from_url]" ><?php echo $item['from_url']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="required">*</span> <label for="to_url"><?php echo $entry_to_url; ?></label>
                    <textarea id="to_url" rows="3" cols="90" name="item[to_url]" ><?php echo $item['to_url']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="date_start"><?php echo $entry_date_start; ?></label>
                    <input id="date_start" class="date" name="item[date_start]" type="text" value="<?php echo $item['date_start']; ?>">
                </td>
                <td>
                    <label for="date_end"><?php echo $entry_date_end; ?></label>
                    <input id="date_end" class="date" name="item[date_end]" type="text" value="<?php echo $item['date_end']; ?>">
                </td>
            </tr>
        </table>
    </div>
</div>
<div id="redirect-popup-buttons">
    <a class="button redirect-popup_save"><?php echo $button_save; ?></a>
    <a class="button redirect-popup_close"><?php echo $button_cancel; ?></a>
</div>
