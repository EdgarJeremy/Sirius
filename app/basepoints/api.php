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
            ->setStatus(endpoint::OK)
            /** Set data output **/
            ->setData(array(
                "judul" => "tcFramework",
                "pesan" => "Selamat bekerja!"
            ))
            /** Meluncur! **/
            ->send();
    }
    
}