<?php

class auth {

    public function buatTableApiKey($db) {
        $db->query("
            CREATE TABLE IF NOT EXISTS `".getConfig("auth","table_name")."` (
                `id_key` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `key` varchar(32) NOT NULL,
                `ip_address` varchar(15) NOT NULL,
                `u_name` varchar(255) NOT NULL
            );
        ");
    }

    public function cek($db,$key) {
        if(getConfig("auth","auto_permit_local") && $_SERVER["REMOTE_ADDR"] == "localhost" || $_SERVER["REMOTE_ADDR"] == "::1")
            return true;
        else
            return ($db
                ->where("key",$key)
                ->where("ip_address",$_SERVER["REMOTE_ADDR"])
                ->get(getConfig("auth","table_name"))
                ->num_rows() > 0);
    }

}