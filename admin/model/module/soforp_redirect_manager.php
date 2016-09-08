<?php
class ModelModuleSoforpRedirectManager extends Model {
    public function install() {
        $sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "redirect` (";
        $sql .= " `redirect_id` int(11) NOT NULL AUTO_INCREMENT,";
        $sql .= " `active` tinyint(1) NOT NULL DEFAULT '0',";
        $sql .= " `from_url` text COLLATE utf8_bin NOT NULL,";
        $sql .= " `to_url` text COLLATE utf8_bin NOT NULL,";
        $sql .= " `response_code` int(3) NOT NULL DEFAULT '301',";
        $sql .= " `date_start` date NOT NULL DEFAULT '0000-00-00',";
        $sql .= " `date_end` date NOT NULL DEFAULT '0000-00-00',";
        $sql .= " `times_used` int(5) NOT NULL DEFAULT '0',";
        $sql .= " PRIMARY KEY (`redirect_id`)";
        $sql .= ") CHARSET=utf8 COLLATE=utf8_general_ci";
        $this->db->query($sql);
    }
}
?>