<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?>
        <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <?php if ($error_warning) { ?><div class="warning"><?php echo $error_warning; ?></div><?php } ?>
    <?php if ($success) { ?><div class="success"><?php echo $success; ?></div><?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/information.png" alt=""/> <?php echo $heading_title; ?></h1>
            <div class="buttons">
                <form id="import" action="<?php echo $import; ?>" style="display:inline;" method="post" enctype="multipart/form-data">
                    <input type="file" name="filename" />
                    <a onclick="if (confirm('<?php echo $text_import_warning; ?>')) { $('#import').submit() }" class="button"><span><?php echo $button_import; ?></span></a>
                </form>
                <a href="<?php echo $export; ?>" class="button export"><span><?php echo $button_export; ?></span></a>
                <a onclick="addItem();" class="button"><span><?php echo $button_insert; ?></span></a>
                <a onclick="deleteItems();" class="button"><span><?php echo $button_delete; ?></span></a></div>
        </div>
        <div class="content">
                <form method="post" enctype="multipart/form-data" id="form">
                    <table class="list display" width="100%" id="items-table">
                        <thead>
                        <tr>
                            <th style="text-align: center;"><input type="checkbox" id="toggle-checkbox" onclick="toggleSelect()" /></th>
                            <?php foreach ($columns as $column) {
					            if ($column['key'] != 'selected') {
						            echo '<th class="left">' . ${'column_'.$column['key']} . '</th>' . "\n";
                                }
                            } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="center" style="height: 150px;" colspan="<?php echo count($columns); ?>" class="dataTables_empty">&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="clear">&nbsp;</div>
                </form>
        </div>
    </div>
<script type="text/javascript"><!--

var forceNewData = false;

function refreshTable(){
    forceNewData=true;
    itemsTable.fnDraw();
}

function fnSetKey( aoData, sKey, mValue )
{
    for ( var i=0, iLen=aoData.length ; i<iLen ; i++ )
    {
        if ( aoData[i].name == sKey )
        {
            aoData[i].value = mValue;
        }
    }
}

function fnGetKey( aoData, sKey )
{
    for ( var i=0, iLen=aoData.length ; i<iLen ; i++ )
    {
        if ( aoData[i].name == sKey )
        {
            return aoData[i].value;
        }
    }
    return null;
}

function fnUpdateCacheColumn(oCache, row, col, data) {
    oCache.lastJson.aaData[row][col] = data;
}

function fnUpdateCallback(oTable, oCache, self, sValue, y) {
    var aPos = oTable.fnGetPosition( self );
    var result = $.parseJSON(sValue);
    var oSettings = oTable.fnSettings();
    var page = Math.ceil((oSettings._iDisplayStart - oCache.iCacheLower) / oSettings._iDisplayLength);
    var mod = ((page+1) % <?php echo $iPipe; ?>) - 1;
    var cachePage = (mod < 0) ? <?php echo $iPipe; ?> - 1 : mod;
    var cacheRow = (cachePage * oSettings._iDisplayLength) + aPos[0];
    var row = aPos[0];
    var col = aPos[2];

    if (result.error) {
        oTable.fnUpdate( result.data, row, col, false );
        alert(result.error);
    } else {
        if (result.data != undefined) {
            fnUpdateCacheColumn(oCache, cacheRow, col, result.data);
            oTable.fnUpdate( result.data, row, col, false );
        }
    }
}


    var oCache = {
        iCacheLower: -1
    };

    function fnDataTablesPipeline ( sSource, aoData, fnCallback ) {
        var iPipe = <?php echo $iPipe; ?>; /* Ajust the pipe size */

        var bNeedServer = false;
        var sEcho = fnGetKey(aoData, "sEcho");
        var iRequestStart = fnGetKey(aoData, "iDisplayStart");
        var iRequestLength = fnGetKey(aoData, "iDisplayLength");
        var iRequestEnd = iRequestStart + iRequestLength;
        oCache.iDisplayStart = iRequestStart;

        /* force new data? */
        if (forceNewData) {
            bNeedServer = true;
        }

        /* outside pipeline? */
        if ( oCache.iCacheLower < 0 || iRequestStart < oCache.iCacheLower || iRequestEnd > oCache.iCacheUpper )
        {
            bNeedServer = true;
        }

        /* sorting etc changed? */
        if ( oCache.lastRequest && !bNeedServer )
        {
            for( var i=0, iLen=aoData.length ; i<iLen ; i++ )
            {
                if ( aoData[i].name != "iDisplayStart" && aoData[i].name != "iDisplayLength" && aoData[i].name != "sEcho" )
                {
                    if ( aoData[i].value != oCache.lastRequest[i].value )
                    {
                        bNeedServer = true;
                        break;
                    }
                }
            }
        }

        /* Store the request for checking next time around */
        oCache.lastRequest = aoData.slice();

        if ( bNeedServer )
        {
            if ( iRequestStart < oCache.iCacheLower )
            {
                iRequestStart = iRequestStart - (iRequestLength*(iPipe-1));
                if ( iRequestStart < 0 )
                {
                    iRequestStart = 0;
                }
            }

            oCache.iCacheLower = iRequestStart;
            oCache.iCacheUpper = iRequestStart + (iRequestLength * iPipe);
            oCache.iDisplayLength = fnGetKey( aoData, "iDisplayLength" );
            fnSetKey( aoData, "iDisplayStart", iRequestStart );
            fnSetKey( aoData, "iDisplayLength", iRequestLength*iPipe );

            $.getJSON( sSource, aoData, function (json) {
                /* Callback processing */
                oCache.lastJson = jQuery.extend(true, {}, json);

                if ( oCache.iCacheLower != oCache.iDisplayStart )
                {
                    json.aaData.splice( 0, oCache.iDisplayStart-oCache.iCacheLower );
                }
                json.aaData.splice( oCache.iDisplayLength, json.aaData.length );

                fnCallback(json)
            } );
            forceNewData = false;
        }
        else
        {
            json = jQuery.extend(true, {}, oCache.lastJson);
            json.sEcho = sEcho; /* Update the echo for each response */
            json.aaData.splice( 0, iRequestStart-oCache.iCacheLower );
            json.aaData.splice( iRequestLength, json.aaData.length );
            fnCallback(json);
            return;
        }
    }

$(document).ready(function() {


    window.itemsTable = $('#items-table').dataTable({
        "sDom": 'f<"filterLink">lTC<"clear"><"filterDiv">riptip',
        "oTableTools": {
            "aButtons": [

            ]
        },
        "oLanguage": {
            "sProcessing": "<?php echo $text_table_processing; ?>",
            "sLoadingRecords": "<?php echo $text_table_loading; ?>",
            "sEmptyTable": "<?php echo $text_table_empty; ?>",
            "sLengthMenu": "<?php echo $text_table_results_per_page; ?>",
            "sSearch": "<?php echo $text_table_search; ?>",
            "sZeroRecords": "<?php echo $text_table_zero_records; ?>",
            "sInfo": "<?php echo $text_table_info; ?>",
            "sInfoEmpty": "<?php echo $text_table_info_empty; ?>",
            "sInfoFiltered": "<?php echo $text_table_info_filtered; ?>",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "<?php echo $text_table_first; ?>",
                "sPrevious": "<?php echo $text_table_prev; ?>",
                "sNext": "<?php echo $text_table_next; ?>",
                "sLast": "<?php echo $text_table_last; ?>"
            }
        },
        "aoColumnDefs": [
            <?php if (count($bVisible)) { echo '{ "bVisible": false, "aTargets": [' . $bVisible . '] },' . "\n"; } ?>
            <?php if (count($bSortable)) { echo '{ "bSortable": false, "aTargets": [' . $bSortable . '] },' . "\n"; } ?>
            <?php foreach ($sWidth as $value) { echo '{ "sWidth": "' . $value['value'] . '", "aTargets": [ ' . $value['index'] . ' ] },' . "\n"; } ?>
            {
                "fnRender": function (obj) { return '<input type="checkbox" name="selected[]" value="' + obj.aData[<?php echo $selectedIndex; ?>] + '" />'; },
                "aTargets": [ <?php echo $selectedIndex; ?> ]
            },
            {
                "fnRender": function (obj) {
                    output = '<nobr>';
                    links = obj.aData[<?php echo $actionIndex; ?>];
                    for( var i in links ) {
                        output += '<a onclick="' + links[i].onclick + '" title="' + links[i].text + '" class="' + links[i].className + '"></a> ';
                    }
                    output += '</nobr>';
                    return output; },
                "aTargets": [ <?php echo $actionIndex; ?> ]
            }
        ],
        "aoColumns": [
         <?php foreach ($columns as $i => $column) {
            if ($column['edittype'] != false) {
                echo '{ "sClass": "' . $column['edittype'] . ' ' . $column['edittype'] . '_' . $column['key'] . '" }';
            } else {
                echo 'null';
            }
            echo ($i == count($columns)-1) ? '' . "\n" : ',' . "\n";
        } ?>
        ],
        "oColVis": {
            "aiExclude": [ <?php echo $selectedIndex; ?> ],
            "buttonText": "<?php echo $text_toggle_columns; ?>"
        },
        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]],
        "bAutoWidth": false,
        "bStateSave": true,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "index.php?route=tool/soforp_redirect_manager/getItems&token=<?php echo $token; ?>",
        "fnServerData": fnDataTablesPipeline,
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            $(nRow).attr("id", aData[<?php echo $idIndex; ?>]);
            return nRow;
        },
        "fnDrawCallback": function() {
            $('td.input', itemsTable.fnGetNodes()).editable( 'index.php?route=tool/soforp_redirect_manager/editItemField&token=<?php echo $token; ?>', {
                "callback": function( sValue, y ) {
                    fnUpdateCallback(itemsTable, oCache, this, sValue, y);
                },
                "submitdata": function ( value, settings ) {
                    var aPos = itemsTable.fnGetPosition( this );
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": aPos[2],
                        "old_value": itemsTable.fnGetData(aPos[0])[aPos[2]]
                    };
                },
                "onedit": function(settings,element){
                    settings.data = element.innerText.replace(/&amp;/g,"&");
                },
                "indicator": "<?php echo $text_indicator_saving; ?>",
                "placeholder": "<?php echo $text_none; ?>",
                "height": "14px",
                "onblur": "submit",
                "onsubmit": function (settings, original) {
                    if (original.revert == $('input',this).val() || (original.revert == '' && $('input',this).val() == "<?php echo $text_none; ?>")) {
                        original.reset();
                        return false;
                    }
                }
            });

            $('td.textarea', itemsTable.fnGetNodes()).editable( 'index.php?route=tool/soforp_redirect_manager/editItemField&token=<?php echo $token; ?>', {
                "callback": function( sValue, y ) {
                    fnUpdateCallback(itemsTable, oCache, this, sValue, y);
                },
                "submitdata": function ( value, settings ) {
                    var aPos = itemsTable.fnGetPosition( this );
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": aPos[2],
                        "old_value": itemsTable.fnGetData(aPos[0])[aPos[2]]
                    };
                },
                "type": "textarea",
                "indicator": "<?php echo $text_indicator_saving; ?>",
                "placeholder": "<?php echo $text_none; ?>",
                "height": "4em",
                "width": "20em",
                "onblur": "submit",
                "onsubmit": function (settings, original) {
                    if (original.revert == $('textarea',this).val() || (original.revert == '' && $('textarea',this).val() == "<?php echo $text_none; ?>")) {
                        original.reset();
                        return false;
                    }
                }
            });

<?php foreach ($columns as $i => $column) { ?>
<?php if ($column['edittype'] == 'select') { ?>
            $('td.select_<?php echo $column['key']; ?>', itemsTable.fnGetNodes()).editable( 'index.php?route=tool/soforp_redirect_manager/editItemField&token=<?php echo $token; ?>', {
                "callback": function( sValue, y ) {
                    fnUpdateCallback(itemsTable, oCache, this, sValue, y);
                },
                "submitdata": function ( value, settings ) {
                    var aPos = itemsTable.fnGetPosition( this );
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": aPos[2],
                        "old_value": itemsTable.fnGetData(aPos[0])[aPos[2]]
                    };
                },
                "type": "select",
                "data": <?php echo $column['options']; ?>,
                "indicator": "<?php echo $text_indicator_saving; ?>",
                "placeholder": "<?php echo $text_none; ?>",
                "onblur": "submit",
                "onsubmit": function (settings, original) {
                    if (original.revert == $('select option:selected',this).text() || (original.revert == '' && $('select option:selected',this).text() == "<?php echo $text_none; ?>")) {
                        original.reset();
                        return false;
                    }
                }
            });
<?php } ?>
<?php } ?>
        }
    });
});
//--></script>
<script type="text/javascript"><!--
    window.token = '<?php echo $token; ?>';
    function toggleSelect() {
        if( $('#toggle-checkbox').attr('checked') == 'checked')
            $('#form input[name*=\'selected\']').attr('checked', 'checked');
        else
            $('#form input[name*=\'selected\']').prop('checked', false);
    }

    function showEditForm(json) {

        if( json["form"] ) {
            if($("#redirect-popup").length == 0)
                $("body").append("<div id=\"redirect-popup\"></div>");
            $("#redirect-popup").html(json["form"]);
            $('#redirect-popup').popup("show");
            $('#redirect-popup-content .date').datepicker({dateFormat: 'yy-mm-dd'});
            $('.redirect-popup_save').click(function(){
                $.ajax({
                    url: 'index.php?route=tool/soforp_redirect_manager/save&token=' + window.token,
                    type: 'post',
                    data: $('#redirect-popup-content input, #redirect-popup-content select, #redirect-popup-content textarea'),
                    dataType: 'json',
                    success: function(json){
                        $('.success, .warning, .attention, .information').remove();

                        if (json['redirect'])
                            location = json['redirect'];

                        if (json['success']) {
                            $('#redirect-popup').popup("hide");
                            refreshTable();
                        }
                    }
                });
            });
        }
    }

    function addItem() {
        $.ajax({
            url: 'index.php?route=tool/soforp_redirect_manager/get&token=' + window.token,
            type: 'post',
            dataType: 'json',
            success: function(json){
                $('.success, .warning, .attention, .information').remove();

                if (json['redirect'])
                    location = json['redirect'];

                if (json['success'])
                    showEditForm(json);
            }
        });
    }

    function editItem(item_id) {
        $.ajax({
            url: 'index.php?route=tool/soforp_redirect_manager/get&token=' + window.token,
            type: 'post',
            data: 'item_id=' + item_id,
            dataType: 'json',
            success: function(json){
                $('.success, .warning, .attention, .information').remove();

                if (json['redirect'])
                    location = json['redirect'];

                if (json['success'])
                    showEditForm(json);
            }
        });
    }

    function resetItemStat(item_id) {
        $.ajax({
            url: 'index.php?route=tool/soforp_redirect_manager/resetItemStat&token=' + window.token,
            type: 'post',
            data: 'item_id=' + item_id,
            dataType: 'json',
            success: function(json){
                $('.success, .warning, .attention, .information').remove();

                if (json['redirect'])
                    location = json['redirect'];

                if (json['success'])
                    refreshTable();
            }
        });
    }

    function deleteItem(item_id) {
        $.ajax({
            url: 'index.php?route=tool/soforp_redirect_manager/delete&token=' + window.token,
            type: 'post',
            data: 'item_id=' + item_id,
            dataType: 'json',
            success: function(json){
                $('.success, .warning, .attention, .information').remove();

                if (json['redirect'])
                    location = json['redirect'];

                if (json['success'])
                    refreshTable();
            }
        });
    }
    function deleteItems() {
        var hasSelection = false;
        $('#form input[name*=\'selected\']').each(function() {
            if ($(this).attr('checked'))
                hasSelection = true;
        });

        if (hasSelection) {
            if (!confirm ('<?php echo $text_confirm_delete; ?>')) {
                return false;
            } else {
                $.ajax({
                    url: 'index.php?route=tool/soforp_redirect_manager/delete&token=' + window.token,
                    type: 'post',
                    data: $('#form').serialize(),
                    dataType: 'json',
                    success: function(json){
                        if (json['redirect'])
                            location = json['redirect'];
                        if (json['success'])
                            refreshTable();
                    }
                });

            }
        } else {
            alert('<?php echo $error_no_selection; ?>');
            return false;
        }
    }
    //--></script>
<?php echo $footer; ?>