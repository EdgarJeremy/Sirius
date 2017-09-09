<?php
/**
 * Copyright 2017 TagConn development
 * tcFramework v0.0.1
 */

class api extends basepoint {

    /**
     * Jangan lupa panggil parent::__construct()
     * ketika implement __construct() di basepoint class
     */
    public function __construct() {
        parent::__construct();
    }
    /**
     * Endpoint default 'api'
     *
     * @return void
     */
    public function index() {
        /**
         * Logika & output disini **/
         $this
            /** Set status output **/
            ->setStatus(endpoint::GAGAL)
            /** Set data output **/
            ->setData(array("nama"=>"bijon"))
            /** Meluncur! **/
            ->send();
    }

    public function test() {
        $this
            ->setStatus(endpoint::OK)
            ->setData(array(
                "foo" => "bar"
            ))
            ->send();
    }

    
}