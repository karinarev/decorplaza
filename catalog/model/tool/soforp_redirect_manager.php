<?php
class ModelToolSoforpRedirectManager extends Model {

    protected function log( $message ){
        if( $this->config->get("soforp_redirect_manager_debug") != 1 )
            return;
        file_put_contents(DIR_LOGS . $this->config->get("config_error_filename") , date("Y-m-d H:i:s - ") . "SOFORP Redirect Manager " . $message . "\r\n", FILE_APPEND );
    }

    public function checkUrl(){
        $this->log("работает" );
        $request_uri = $this->request->server['REQUEST_URI'];
        if($request_uri == ""){
            $this->log("ОШИБКА!!! Запрос не содержит REQUEST_URI:" . print_r($this->request,true) );
            return;
        }

        $from = HTTP_SERVER;
        if( substr($from,-1) == "/" )
            $from = substr($from,0,-1);
        $from .= urldecode($request_uri);


        $sql = "SELECT * FROM `" . DB_PREFIX . "redirect` WHERE ( from_url = '" . $this->db->escape($from) . "' OR from_url = '" . $this->db->escape($from) . "/') ";
        $query = $this->db->query($sql);

        if ($query->num_rows) {
            $to = str_replace('&amp;', '&', $query->row['to_url']);
            $this->log("Найдено правило $from -> " . $query->row['to_url']);
            $this->db->query("UPDATE `" . DB_PREFIX . "redirect` SET times_used = times_used+1 WHERE redirect_id = " . (int)$query->row['redirect_id']);

            header('Location: ' . $to, true, $query->row['response_code']);
            exit();
        } else {
            $this->log("Нет правил редиректа для $from");
        }
    }
}