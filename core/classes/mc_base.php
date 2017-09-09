<?php


class mc_base {

    protected $db;

    public function __construct() {
        $this->db = getDb();
    }

}