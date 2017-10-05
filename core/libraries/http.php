<?php

class http {

    protected $params = [];
    protected $body = [];
    protected $url;
    protected $response;
    protected $dJson = false;
    const pError = "URL kosong \n Invoke method setUrl(url) untuk mengisi URL atau isi parameter pada fungsi method";

    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }
    
    public function setBody(array $body) {
        $this->body = $body;
        return $this;
    }

    public function post($url = null) {
        $url = ($url) ? $url : $this->url;
        if($url) {
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($this->body));
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $this->response = curl_exec($ch);
            curl_close($ch);
            return $this;
        } else {
            json::output(array(
                "status" => false,
                "pesan" => http::pError
            ));
        }
    }

    public function toDecodedJson() {
        $this->dJson = true;
        return $this;
    }

    public function getResponse() {
        return ($this->dJson) ? json_decode($this->response) : $this->response;
    }

    public function get($url = null) {
        $url = ($url) ? $url : $this->url;
        if($url) {
            $this->response = file_get_contents($url . "?" . http_build_query($this->params));
        } else {
            json::output(array(
                "status" => false,
                "pesan" => http::pError
            ));
        }
        return $this;
    }

}