<?php

class basepoint extends mc_base {

    protected $data = array();
    protected $status = endpoint::OK;
    protected $pesan = "Error tidak diketahui";
    protected $waktu_mulai;

    public function __construct() {
        parent::__construct();
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

    protected function setData($data) {
        $this->data = $data;
        return $this;
    }

    protected function setPesan($pesan) {
        $this->pesan = $pesan;
        return $this;
    }

    protected function send() {
        header("Content-Type: application/json;charset=utf-8");
        $sendArray = [];
        $sendArray["status"] = $this->status;
        $sendArray[($this->status) ? "data" : "pesan"] = ($this->status) ? $this->data : $this->pesan;
        $sendArray["waktu_eksekusi"] = $this->ambilTotalWaktu();
        json::output($sendArray);
        exit();
    }

    private function ambilTotalWaktu() {
        $waktu = microtime();
        $waktu = explode(' ', $waktu);
        $waktu = $waktu[1] + $waktu[0];
        $selesai = $waktu;
        $total = round(($selesai - $this->waktu_mulai),4);
        return $total;
    }

    protected function pakaiModel(array $models) {
        $prepend = getConfig("model_prepend");
        foreach($models as $key=>$model) {
            $classname = $model.$prepend;
            if(!is_numeric($key))
                $this->$key = new $classname($this->db);
            else
                $this->$model = new $classname($this->db);
        }
    }

}