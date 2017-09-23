<?php


class mc_base {

    protected $load;
    protected $input;

    public function __construct() {
        $this->load = new loader($this);
        $this->input = new input();

        $autoloads = getConfig("autoload");
        foreach($autoloads as $type=>$lists) {
            foreach($lists as $key=>$item) {
                if($item === "database" && $type === "library") {
                    $this->db = getDb();
                    continue;
                }
                $this->load->$type($item);
            }
        }
    }

    
}