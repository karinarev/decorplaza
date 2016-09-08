<?php
require_once( DIR_SYSTEM . "/engine/soforp_controller.php");
class ControllerToolSoforpRedirectManager extends SoforpController {
    private $error = array();

    public function __construct($registry) {
        $this->registry = $registry;
        $this->_moduleName = "SOFORP Redirect Manager";
    }

    private $columns = array(
        array('key' => 'selected', 'name' => 'selected', 'sortable' => false, 'searchable' => false, 'visible' => true, 'width' => '20px', 'edittype' => false),
        array('key' => 'id', 'name' => 'r.redirect_id', 'sortable' => true, 'searchable' => true, 'visible' => true, 'width' => '40px', 'edittype' => false),
        array('key' => 'active', 'name' => 'r.active', 'sortable' => true, 'searchable' => true, 'visible' => true, 'width' => false, 'edittype' => 'select'),
        array('key' => 'from_url', 'name' => 'r.from_url', 'sortable' => true, 'searchable' => true, 'visible' => true, 'width' => false, 'edittype' => 'input'),
        array('key' => 'to_url', 'name' => 'r.to_url', 'sortable' => true, 'searchable' => true, 'visible' => true, 'width' => false, 'edittype' => 'input'),
        array('key' => 'response_code', 'name' => 'r.response_code', 'sortable' => false, 'searchable' => true, 'visible' => false, 'width' => false, 'edittype' => 'select'),
        array('key' => 'date_start', 'name' => 'r.date_start', 'sortable' => true, 'searchable' => true, 'visible' => true, 'width' => false, 'edittype' => 'input'),
        array('key' => 'date_end', 'name' => 'r.date_end', 'sortable' => true, 'searchable' => true, 'visible' => true, 'width' => false, 'edittype' => 'input'),
        array('key' => 'times_used', 'name' => 'r.times_used', 'sortable' => true, 'searchable' => false, 'visible' => true, 'width' => false, 'edittype' => false),
        array('key' => 'action', 'name' => 'action', 'sortable' => false, 'searchable' => false, 'visible' => true, 'width' => '60px', 'edittype' => false)
    );

    public function index()
    {
        $this->getList();
    }


    private function getList()
    {
        $this->initLanguage('tool/soforp_redirect_manager');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->columns = array_values($this->columns);

        $this->initBreadcrumbs(array(
            array("tool/soforp_redirect_manager","heading_title")
        ));

        $this->data['iPipe'] = 5;
        $this->data['import'] = $this->url->link('tool/soforp_redirect_manager/import', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['export'] = $this->url->link('tool/soforp_redirect_manager/export', 'token=' . $this->session->data['token'], 'SSL');

        foreach ($this->columns as $column)
        {
            if ($column['key'] != 'selected')
            {
                $this->data['column_' . $column['key']] = $this->language->get('column_' . $column['key']);
            }
        }

        $this->data['token'] = $this->session->data['token'];

        if (isset($this->error['warning']))
        {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->session->data['success']))
        {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $bVisible = array();
        $bSortable = array('0');
        $sWidth = array();

        foreach ($this->columns as $i => &$column)
        {
            if (!$column['visible'])
            {
                $bVisible[] = $i;
            }
            if (!$column['sortable'])
            {
                $bSortable[] = $i;
            }
            if ($column['width'] != false)
            {
                $sWidth[] = array('index' => $i, 'value' => $column['width']);
            }
            if ($column['key'] == 'id')
            {
                $idIndex = $i;
            }
            if ($column['key'] == 'action')
            {
                $actionIndex = $i;
            }
            if ($column['key'] == 'selected')
            {
                $selectedIndex = $i;
            }
            if ($column['key'] == 'response_code')
            {
                $column['options'] = array(
                    '301' => $this->language->get('text_response_code_301'),
                    '302' => $this->language->get('text_response_code_302'),
                    '307' => $this->language->get('text_response_code_307'),
                );
            }
            if ($column['key'] == 'active')
            {
                $column['options'] = array(
                    '0' => $this->language->get('text_disabled'),
                    '1' => $this->language->get('text_enabled'),
                );
            }
        }

        foreach ($this->columns as &$column)
        {
            if (isset($column['options']))
            {
                $column['options'] = json_encode($column['options']);
            }
        }

        $this->data['bVisible'] = implode(',', $bVisible);
        $this->data['bSortable'] = implode(',', $bSortable);
        $this->data['sWidth'] = $sWidth;
        $this->data['actionIndex'] = $actionIndex;
        $this->data['selectedIndex'] = $selectedIndex;
        $this->data['idIndex'] = $idIndex;
        $this->data['columns'] = $this->columns;

        $this->document->addStyle('view/javascript/jquery/dataTables/css/dataTables.css');
        $this->document->addStyle('view/javascript/jquery/dataTables/css/TableTools.css');
        $this->document->addStyle('view/javascript/jquery/dataTables/css/TableTools.print.css', 'stylesheet', 'print');
        $this->document->addStyle('view/javascript/jquery/dataTables/css/ColVis.css');
        $this->document->addScript('view/javascript/jquery/dataTables/js/jquery.dataTables.min.js');
        $this->document->addScript('view/javascript/jquery/jquery.jeditable.min.js');
        $this->document->addScript('view/javascript/jquery/dataTables/js/TableTools.min.js');
        $this->document->addScript('view/javascript/jquery/dataTables/js/ColVis.min.js');

        $this->document->addStyle('view/stylesheet/soforp_redirect_manager.css');
        $this->document->addScript('view/javascript/jquery/popup-overlay/jquery.popupoverlay.js');
        $this->document->addScript('view/javascript/jquery/ui/jquery-ui-timepicker-addon.js');

        $this->template = 'tool/soforp_redirect_manager_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function getItems()
    {
        $this->columns = array_values($this->columns);

        $this->load->model('tool/soforp_redirect_manager');
        $this->initLanguage('tool/soforp_redirect_manager');

        $start = $limit = '';
        if (isset($this->request->get['iDisplayStart']) && $this->request->get['iDisplayLength'] != '-1')
        {
            $start = $this->request->get['iDisplayStart'];
            $limit = $this->request->get['iDisplayLength'];
        }

        $sort = $order = '';
        if (isset($this->request->get['iSortCol_0']))
        {
            for ($i = 0; $i < intval($this->request->get['iSortingCols']); $i++)
            {
                if ($this->request->get['bSortable_' . intval($this->request->get['iSortCol_' . $i])] == "true")
                {
                    if ($this->columns[intval($this->request->get['iSortCol_' . $i])]['sortable'])
                    {
                        $sort = $this->columns[intval($this->request->get['iSortCol_' . $i])]['name'];
                        $order = strtoupper($this->request->get['sSortDir_' . $i]);
                    }
                }
            }
        }

        $filters = array();
        if (isset($this->request->get['sSearch']) && $this->request->get['sSearch'] != "")
        {
            for ($i = 0; $i < count($this->columns); $i++)
            {
                if ($this->columns[$i]['searchable'])
                {
                    $filters[] = array('name' => $this->columns[$i]['name'], 'keyword' => $this->request->get['sSearch']);
                }
            }
        }

        $sort_columns = array();

        foreach ($this->columns as $column) {
            if ($column['sortable']) {
                $sort_columns[] = $column['name'];
            }
        }

        $data = array(
            'filters' => $filters,
            'sort' => $sort,
            'order' => $order,
            'start' => $start,
            'limit' => $limit,
            'sort_columns' => $sort_columns
        );

        $result_total = $this->model_tool_soforp_redirect_manager->getTotalItems($data);

        $results = $this->model_tool_soforp_redirect_manager->getItems($data);
        $response_names = array(
            '301' => $this->language->get('text_response_code_301'),
            '302' => $this->language->get('text_response_code_302'),
            '307' => $this->language->get('text_response_code_307'),
        );

        $items = array();
        foreach ($results as $result) {
            $item = array(
                $result['redirect_id'],
                $result['redirect_id'],
                ($result['active'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
                $result['from_url'],
                $result['to_url'],
                $response_names[$result['response_code']],
                $result['date_start'] = ( $result['date_start'] == '0000-00-00' ? '' : $result['date_start'] ),
                $result['date_end'] = ( $result['date_end'] == '0000-00-00' ? '' : $result['date_end'] ),
                $result['times_used'],
                array( array(
                        'text' => $this->language->get('text_reset_item_stat'),
                        'onclick' => "resetItemStat(" . $result['redirect_id'] . ");",
                        'className' => 'action reset',
                    ), array(
                        'text' => $this->language->get('text_edit_item'),
                        'onclick' => "editItem(" . $result['redirect_id'] . ");",
                        'className' => 'action edit',
                    ), array(
                        'text' => $this->language->get('text_delete_item'),
                        'onclick' => "deleteItem(" . $result['redirect_id'] . ");",
                        'className' => 'action delete',
                ))
            );

            $item = array_values($item);

            $items[] = $item;
        }

        $json = array(
            'sEcho' => intval($this->request->get['sEcho']),
            'iTotalRecords' => $result_total,
            'iTotalDisplayRecords' => $result_total,
            'aaData' => $items
        );

        $this->data['token'] = $this->session->data['token'];
        $this->response->setOutput(json_encode($json));
    }

    public function editItemField()
    {
        $this->columns = array_values($this->columns);

        $this->load->model('tool/soforp_redirect_manager');
        $this->load->language('tool/soforp_redirect_manager');

        $json = array();

        $json['timestamp'] = date($this->language->get('date_format_php'));

        $json['data'] = $this->request->post['old_value'];

        if (!$this->user->hasPermission('modify', 'tool/soforp_redirect_manager')) {
            $json['error'] = $this->language->get('error_permission');
        } else {
            if (isset($this->request->post['value']) && isset($this->request->post['row_id']) && isset($this->request->post['column']) && $this->validateDataTable()) {

                $data = array(
                    'key' => $this->columns[$this->request->post['column']]['key'],
                    'column' => $this->columns[$this->request->post['column']]['name'],
                    'value' => $this->request->post['value'],
                    'old_value' => $this->request->post['old_value']
                );

                $json['data'] = $this->model_tool_soforp_redirect_manager->editItemField($this->request->post['row_id'], $data);
            } else {
                $json['error'] = $this->error['warning'];
            }
        }

        $this->data['token'] = $this->session->data['token'];
        $this->response->setOutput(json_encode($json));
    }


    private function validateDataTable()
    {
        if (!$this->user->hasPermission('modify', 'catalog/product'))
        {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $column = $this->columns[$this->request->post['column']];
        $key = $column['key'];
        $value = $this->request->post['value'];

        if (($key == 'quantity' || $key == 'price') && !is_numeric($value))
        {
            $this->error['warning'] = $this->language->get('error_not_numeric');
        }

        if (!$this->error)
        {
            return TRUE;
        } else {
            if (!isset($this->error['warning']))
            {
                $this->error['warning'] = $this->language->get('error_required_data');
            }
            return FALSE;
        }
    }

    public function get(){
        $this->initLanguage('tool/soforp_redirect_manager');

        if( isset($this->request->post['item_id']) ) {
            $this->data['item_id'] = $this->request->post['item_id'];
            $this->load->model('tool/soforp_redirect_manager');
            $this->data['item'] = $this->model_tool_soforp_redirect_manager->getItem($this->request->post['item_id']);
        } else {
            $this->data['item'] = array(
                'active' => 1,
                'from_url' => '',
                'to_url' => '',
                'response_code' => 301,
                'date_start' => '',
                'date_end' => ''
            );
        }

        $json = array();
        $json['success'] = 1;
        $json["form"] = $this->renderTemplateOnly('tool/soforp_redirect_manager_form.tpl');

        $this->outputJson( $json );
    }

    public function save(){
        $json = array();

        $this->initLanguage('tool/soforp_redirect_manager');
        $this->load->model('tool/soforp_redirect_manager');

        if (!$this->user->hasPermission('modify', 'tool/soforp_redirect_manager')) {
            $json['error'] = $this->language->get('error_permission');
        } else {
            if( !isset($this->request->post['item_id']) ) {
                $this->model_tool_soforp_redirect_manager->addItem(
                    $this->request->post['item']
                );
            } else {
                $this->model_tool_soforp_redirect_manager->editItem(
                    $this->request->post['item_id'],
                    $this->request->post['item']
                );
            }
        }

        $json['success'] = 1;
        $this->outputJson( $json );
    }


    public function resetItemStat(){
        $json = array();

        $this->initLanguage('tool/soforp_redirect_manager');
        $this->load->model('tool/soforp_redirect_manager');

        if (!$this->user->hasPermission('modify', 'tool/soforp_redirect_manager')) {
            $json['error'] = $this->language->get('error_permission');
        } else {
            if( isset($this->request->post['item_id']) ) {
                $this->model_tool_soforp_redirect_manager->resetItemStat(
                    $this->request->post['item_id']
                );
                $json['success'] = 1;
            }
        }

        $this->outputJson( $json );
    }

    public function delete(){
        $this->initLanguage('tool/soforp_redirect_manager');
        $this->load->model('tool/soforp_redirect_manager');

        $json = array();

        if (!$this->user->hasPermission('modify', 'tool/soforp_redirect_manager')) {
            $json['error'] = $this->language->get('error_permission');
        } else {
            if( isset($this->request->post['item_id']) ) {
                $this->model_tool_soforp_redirect_manager->deleteItem(
                    $this->request->post['item_id']
                );
                $json['success'] = 1;
            } else if( isset($this->request->post['selected'])) {
                foreach($this->request->post['selected'] as $item_id) {
                    $this->model_tool_soforp_redirect_manager->deleteItem( $item_id );
                }
                $json['success'] = 1;
            }
        }

        $this->outputJson( $json );
    }

    public function export() {
        if (!$this->user->hasPermission('access', 'tool/soforp_redirect_manager'))
            return;

        header('Pragma: public');
        header('Expires: 0');
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=redirects.csv');
        header('Content-Transfer-Encoding: binary');

        $results = $this->db->query("SELECT * FROM `" . DB_PREFIX . "redirect` ORDER BY redirect_id ASC");
        echo implode(';', array_keys($results->row)) . "\n";
        foreach ($results->rows as $result) {
            if( $result['date_start'] == '0000-00-00')
                $result['date_start'] = '';
            if( $result['date_end'] == '0000-00-00')
                $result['date_end'] = '';
            echo str_replace('&amp;', '&', implode(';', str_replace('"', '%22', $result))) . "\n";
        }
        exit();
    }

    public function import() {
        $this->initLanguage('tool/soforp_redirect_manager');

        if (!$this->user->hasPermission('modify', 'tool/soforp_redirect_manager')) {
            $this->error['warning'] = $this->language->get('error_permission');
            $this->getList();
            return;
        }

        if(empty($this->request->files['filename']['tmp_name'])){
            $this->error['warning'] = $this->language->get('error_file');
            $this->getList();
            return;
        }

        $contents = file_get_contents($this->request->files['filename']['tmp_name']);

        foreach (explode("\n", str_replace('"', '', $contents)) as $num => $row) {
            if (!$num || empty($row))
                continue;

            $col = explode(';', $row);
            $redirect_id = (!empty($col[0])) ? "redirect_id = " . (int)$col[0] . "," : '';

            $sql = "
				active = " . (int)$col[1] . ",
				from_url = '" . $this->db->escape($col[2]) . "',
				to_url = '" . $this->db->escape($col[3]) . "',
				response_code = " . (int)$col[4] . ",
				date_start = '" . $this->db->escape($col[5]) . "',
				date_end = '" . $this->db->escape($col[6]) . "'
			";

            $this->db->query("INSERT INTO `" . DB_PREFIX . "redirect` SET " . $redirect_id . $sql . " ON DUPLICATE KEY UPDATE " . $sql);
        }

        $this->getList();
    }

}

?>