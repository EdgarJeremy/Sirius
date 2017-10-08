<?php

class model {

    protected $db;
    private $load;

    public function __construct($db) {
        $this->db = $db;
        $this->load = new loader($this);
        $autoloads = getConfig("autoload");
        foreach($autoloads as $type=>$lists) {
            foreach($lists as $key=>$item) {
                if($item === "database" && $type === "library") {
                    continue;
                }
                $this->load->$type($item);
            }
        }
    }

}