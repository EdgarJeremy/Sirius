<?php
/**
 * Copyright 2017 TagConn development
 * Sirius v0.0.1
 */

class api extends basepoint {

    /**
     * Jangan lupa panggil parent::__construct()
     * ketika implement __construct() di basepoint class
     */
    public function __construct() {
        parent::__construct();
        $this->skipOptions();
        $this->setHeaders([
            "Content-Type" => "application/json;charset=utf-8",
            "Access-Control-Allow-Origin" => "*"
        ]);
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
            ->withGet()
            ->withPost()
            ->withCookie()
            ->withMethod()
            ->withHeaders()
            ->withRemoteIp()
            ->withWaktuEksekusi()
            /** Set data output **/
            ->setData(array(
                "nama_aplikasi" => getConfig("app","name"),
                "versi" => getConfig("app","version"),
                "pesan" => "Selamat bekerja!"
            ))
            /** Eksekusi **/
            ->send();
    }

}