<?php


class mc_base {

    protected $load;

    public function __construct() {
        $this->load = new loader($this);
        $autoloads = getConfig("autoload");
        foreach($autoloads as $type=>$lists) {
            foreach($lists as $key=>$item) {
                if($item === "database") {
                    $this->db = getDb();
                    continue;
                }
                $this->load->$type($item);
            }
        }
    }
    
}