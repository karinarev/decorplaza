<?php
class ModelToolSoforpRedirectManager extends Model {

    protected function log( $message ){
        if( $this->config->get("soforp_redirect_manager_debug") != 1 )
            return;
        file_put_contents(DIR_LOGS . $this->config->get("config_error_filename") , date("Y-m-d H:i:s - ") . "SOFORP Redirect Manager " . $message . "\r\n", FILE_APPEND );
    }

    public function addItem($data){
        $this->db->query("INSERT INTO " . DB_PREFIX . "redirect SET active = '" . (int)$data['active'] . "', from_url = '" . $this->db->escape($data['from_url']) . "', to_url = '" . $this->db->escape($data['to_url']) . "', response_code = '" . (int)$data['response_code'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "'");

        $this->cache->delete('redirect');
    }

    public function editItem($item_id, $data){
        $this->db->query("UPDATE " . DB_PREFIX . "redirect SET active = '" . (int)$data['active'] . "', from_url = '" . $this->db->escape($data['from_url']) . "', to_url = '" . $this->db->escape($data['to_url']) . "', response_code = '" . (int)$data['response_code'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', times_used = 0 WHERE redirect_id='" . (int)$item_id . "'");

        $this->cache->delete('redirect');
    }

    public function resetItemStat($item_id){
        $this->db->query("UPDATE " . DB_PREFIX . "redirect SET times_used = 0 WHERE redirect_id='" . (int)$item_id . "'");
    }

    public function deleteItem($item_id){
        $this->db->query("DELETE FROM " . DB_PREFIX . "redirect WHERE redirect_id='" . (int)$item_id . "' LIMIT 1");

        $this->cache->delete('redirect');
    }

    public function editItemField($item_id, $data) {

        $return = $data['old_value'];

        if ($data['key'] == 'active') {
            $sql = "UPDATE " . DB_PREFIX . "redirect SET active = '" . (int)$data['value'] . "' WHERE redirect_id = '" . (int)$item_id . "'";
            $return = ($data['value']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled');
        }

        if ($data['key'] == 'from_url') {
            $sql = "UPDATE " . DB_PREFIX . "redirect SET from_url = '" . $this->db->escape($data['value']) . "' WHERE redirect_id = '" . (int)$item_id . "'";
            $return = $data['value'];
        }

        if ($data['key'] == 'to_url') {
            $sql = "UPDATE " . DB_PREFIX . "redirect SET to_url = '" . $this->db->escape($data['value']) . "' WHERE redirect_id = '" . (int)$item_id . "'";
            $return = $data['value'];
        }

        if ($data['key'] == 'response_code') {
            $sql = "UPDATE " . DB_PREFIX . "redirect SET response_code = '" . (int)$data['value'] . "' WHERE redirect_id = '" . (int)$item_id . "'";
            $values = array(
                '301' => $this->language->get('text_response_code_301'),
                '302' => $this->language->get('text_response_code_302'),
                '307' => $this->language->get('text_response_code_307'),
            );
            $return = $values[$data['value']];
        }

        if ($data['key'] == 'date_start') {
            $sql = "UPDATE " . DB_PREFIX . "redirect SET date_start = '" . $this->db->escape($data['value']) . "' WHERE redirect_id = '" . (int)$item_id . "'";
            $return = $data['value'];
        }

        if ($data['key'] == 'date_end') {
            $sql = "UPDATE " . DB_PREFIX . "redirect SET date_end = '" . $this->db->escape($data['value']) . "' WHERE redirect_id = '" . (int)$item_id . "'";
            $return = $data['value'];
        }


        if ($sql) {
            $this->db->query($sql);
            $this->cache->delete('redirect');
        }

        return $return;
    }

    public function buildQuery($sql, $data) {
        if (isset($data['filter_from_url']) && !is_null($data['filter_from_url'])) {
            $sql .= " AND LCASE(r.from_url) LIKE '%" . $this->db->escape(strtolower($data['filter_from_url'])) . "%'";
        }

        if (isset($data['filter_to_url']) && !is_null($data['filter_from_url'])) {
            $sql .= " AND LCASE(r.to_url) LIKE '%" . $this->db->escape(strtolower($data['filter_to_url'])) . "%'";
        }

        if (isset($data['filter_active']) && !is_null($data['filter_active'])) {
            $sql .= " AND r.active = '" . (int)$data['filter_active'] . "'";
        }

        if (isset($data['filters']) && count($data['filters']) > 1) {
            $sql .= " AND (";
            foreach ($data['filters'] as $filter) {
                $sql .= 'UPPER(' . $filter['name'] . ") LIKE UPPER('%" . $this->db->escape($filter['keyword']) . "%') OR ";
            }
            $sql = substr_replace($sql, "", -3);
            $sql .= ")";
        }

        $sort_data = $data['sort_columns'];

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)  ) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY r.redirect_id";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        return $sql;
    }

    public function getItem($item_id) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "redirect` r WHERE r.redirect_id = '" . (int)$item_id . "'");
        $data = $query->row;
        if( $data['date_start'] == '0000-00-00')
            $data['date_start'] = '';
        if( $data['date_end'] == '0000-00-00')
            $data['date_end'] = '';
        return $data;
    }

    public function getItems($data = array()) {
        $sql = $this->buildQuery("SELECT DISTINCT r.* FROM " . DB_PREFIX . "redirect r WHERE 1 ", $data );

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalItems($data = array()) {
        $sql = $this->buildQuery("SELECT COUNT(r.redirect_id) AS total FROM " . DB_PREFIX . "redirect r  WHERE 1 ", $data);

        $query = $this->db->query($sql);

        return $query->row['total'];
    }
}
?>