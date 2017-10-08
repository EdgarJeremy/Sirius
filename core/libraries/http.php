<?php

class http {

    protected $params = [];
    protected $body = [];
    protected $url;
    protected $response;
    protected $statusCode;
    protected $error = false;
    protected $errorMessage = "";
    protected $dJson = false;
    protected $skipError = false;

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

    public function skipError() {
        $this->skipError = true;
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
            $this->statusCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            $this->error = ($error) ? true : false;
            $this->errorMessage = $error;
            curl_close($ch);
            return $this;
        } else {
            json::output(array(
                "status" => false,
                "pesan" => http::pError
            ));
        }
    }

    public function get($url = null) {
        $url = ($url) ? $url : $this->url;
        if($url) {
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url . "?" . http_build_query($this->params));
            curl_setopt($ch,CURLOPT_POST,0);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($ch);
            $statusCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
            $errorMsg = curl_error($ch);
            $error = ($errorMsg) ? true : false;
            curl_close($ch);
            if($this->skipError) {
                return new http_result($this->url,$response,$statusCode,$error,$errorMsg);
            } else {
                if($error) {
                    json::output(array(
                        "status" => false,
                        "message" => "Backend CuRL Error : {$url} " . $errorMsg
                    ));
                }
                if($statusCode < 200 || $statusCode > 206) {
                    json::output(array(
                        "status" => false,
                        "message" => "Backend HTTP Request Failed : {$url} " . $this->getHttpMessage($statusCode)
                    ));
                }
                return new http_result($this->url,$response,$statusCode,$error,$errorMsg);
            }
        } else {
            json::output(array(
                "status" => false,
                "pesan" => http::pError
            ));
        }
    }

    private function validUrl($url) {
        return (preg_match('/^http(s)?:\/\/[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', $url));
    }

    private function getHttpMessage($code = "") {
        $code = ($code) ? $code : $this->statusCode;
        $messages = array(
            // [Informational 1xx]
            100=>'100 Continue',
            101=>'101 Switching Protocols',
            // [Successful 2xx]
            200=>'200 OK',
            201=>'201 Created',
            202=>'202 Accepted',
            203=>'203 Non-Authoritative Information',
            204=>'204 No Content',
            205=>'205 Reset Content',
            206=>'206 Partial Content',
            // [Redirection 3xx]
            300=>'300 Multiple Choices',
            301=>'301 Moved Permanently',
            302=>'302 Found',
            303=>'303 See Other',
            304=>'304 Not Modified',
            305=>'305 Use Proxy',
            306=>'306 (Unused)',
            307=>'307 Temporary Redirect',
            // [Client Error 4xx]
            400=>'400 Bad Request',
            401=>'401 Unauthorized',
            402=>'402 Payment Required',
            403=>'403 Forbidden',
            404=>'404 Not Found',
            405=>'405 Method Not Allowed',
            406=>'406 Not Acceptable',
            407=>'407 Proxy Authentication Required',
            408=>'408 Request Timeout',
            409=>'409 Conflict',
            410=>'410 Gone',
            411=>'411 Length Required',
            412=>'412 Precondition Failed',
            413=>'413 Request Entity Too Large',
            414=>'414 Request-URI Too Long',
            415=>'415 Unsupported Media Type',
            416=>'416 Requested Range Not Satisfiable',
            417=>'417 Expectation Failed',
            // [Server Error 5xx]
            500=>'500 Internal Server Error',
            501=>'501 Not Implemented',
            502=>'502 Bad Gateway',
            503=>'503 Service Unavailable',
            504=>'504 Gateway Timeout',
            505=>'505 HTTP Version Not Supported'
        );
        return isset($messages[$code]) ? $messages[$code] : "";
    }

}