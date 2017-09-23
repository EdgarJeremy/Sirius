<?php

class basepoint extends mc_base {

    protected $data = array();
    protected $status = endpoint::OK;
    protected $message = "Error tidak diketahui";
    protected $withPost;
    protected $withGet;
    protected $withCookie;
    protected $withMethod;
    protected $withHeaders;
    protected $withRemoteIp;
    protected $izinkanBrowser;
    protected $withWaktuEksekusi;
    protected $isAjax;

    protected $waktu_mulai;
    protected $headers = array(
        "Content-Type" => "application/json;charset=utf8"
    );

    public function __construct() {
        parent::__construct();
        $this->initMulai();
        $this->withPost = getConfig("response_field","f_get");
        $this->withGet = getConfig("response_field","f_post");
        $this->withCookie = getConfig("response_field","f_cookie");
        $this->withMethod = getConfig("response_field","f_method");
        $this->withHeaders = getConfig("response_field","f_headers");
        $this->withRemoteIp = getConfig("response_field","f_remote_ip");
        $this->izinkanBrowser = getConfig("env","izinkan_browser");
        $this->isAjax = $this->input->ajax_request();
        $this->withWaktuEksekusi = getConfig("response_field","f_waktu_eksekusi");

        if(getConfig("auth","use_key")) {
            if(in_array("database",getConfig("autoload","library"))) {
                $this->load->library("auth");
                $this->auth->buatTableApiKey($this->db);
                $headers = $this->getRequestHeaders();
                if(isset($headers[getConfig("auth","header_key")])) {
                    if(!$this->auth->cek($this->db,$headers[getConfig("auth","header_key")])) {
                        $this
                            ->setStatus(endpoint::GAGAL)
                            ->withRemoteIp()
                            ->setMessage("Akses ditolak. Auth key tidak valid atau remote IP tidak diizinkan")
                            ->send();
                    }
                } else {
                    $this
                    ->setStatus(endpoint::GAGAL)
                    ->setMessage("Auth key tidak ada dalam request")
                    ->send();
                }
            } else {
                $this
                ->setStatus(endpoint::GAGAL)
                ->setMessage("Library 'Auth' membutuhkan library 'database' dalam autoload")
                ->send();
            }
        }
    }

    private function initMulai() {
        $waktu = microtime();
        $waktu = explode(" ",$waktu);
        $waktu = $waktu[1] + $waktu[0];
        $this->waktu_mulai = $waktu;
    }

    protected function setStatus(bool $status) {
        if(is_bool($status))
            $this->status = $status;
        return $this;
    }

    protected function setHeaders(array $headers) {
        if(is_array($headers)) {
            foreach($headers as $key=>$value) {
                $this->headers[$key] = $value;
            }
        }
        return $this;
    }

    protected function setData($data) {
        $this->data = $data;
        return $this;
    }

    protected function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    protected function setRequiredGet(array $fields) {
        $fieldGagal = array();
        foreach($fields as $key=>$value) {
            if(!$this->input->has_get($value)) {
                array_push($fieldGagal,$value);
            }
        }
        if(!empty($fieldGagal)) {
            $this->setStatus(endpoint::GAGAL);
            $this->setMessage("Field GET '" . implode(",",$fieldGagal) . "' harus dikirim!");
            $this->send();
        }
        return $this;
    }

    protected function send() {
        $this->outputHeaders();
        $sendArray = [];
        $sendArray["status"] = $this->status;
        $sendArray[($this->status) ? "data" : "message"] = ($this->status) ? $this->data : $this->message;

        if($this->withGet)
            $sendArray["f_get"] = $this->input->get();
        
        if($this->withPost)
            $sendArray["f_post"] = $this->input->post();

        if($this->withCookie)
            $sendArray["f_cookie"] = $this->input->cookie();

        if($this->withMethod)
            $sendArray["f_method"] = $_SERVER["REQUEST_METHOD"];

        if($this->withHeaders)
            $sendArray["f_headers"] = $this->getRequestHeaders();

        if($this->withRemoteIp)
            $sendArray["f_remote_ip"] = $_SERVER["REMOTE_ADDR"];
            
        if($this->withWaktuEksekusi)
            $sendArray["waktu_eksekusi"] = $this->ambilTotalWaktu();

        if($this->izinkanBrowser){
            json::output($sendArray);
        } else {
            if($this->isAjax) {
                json::output($sendArray);
            }
        }
        exit();
    }

    protected function withGet() {
        $this->withGet = true;
        return $this;
    }

    protected function withPost() {
        $this->withPost = true;
        return $this;
    }

    protected function withCookie() {
        $this->withCookie = true;
        return $this;
    }

    protected function withMethod() {
        $this->withMethod = true;
        return $this;
    }

    protected function withHeaders() {
        $this->withHeaders = true;
        return $this;
    }

    protected function withRemoteIp() {
        $this->withRemoteIp = true;
        return $this;
    }

    protected function withWaktuEksekusi() {
        $this->withWaktuEksekusi = true;
        return $this;
    }

    private function getRequestHeaders() {
        $headers = array();
        foreach($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }
        return $headers;
    }

    private function ambilTotalWaktu() {
        $waktu = microtime();
        $waktu = explode(' ', $waktu);
        $waktu = $waktu[1] + $waktu[0];
        $selesai = $waktu;
        $total = round(($selesai - $this->waktu_mulai),4);
        return $total;
    }

    private function outputHeaders() {
        foreach($this->headers as $key=>$header) {
            header($key . ": " . $header);
        }
    }

    protected function useModel(array $models) {
        $prepend = getConfig("model","model_prepend");
        foreach($models as $key=>$model) {
            $model = ucfirst($model);
            $classname = $model.$prepend;
            if(!is_numeric($key))
                $this->$key = new $classname($this->db);
            else
                $this->$model = new $classname($this->db);
        }
    }

}