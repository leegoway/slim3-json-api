<?php

class JsonViewer {
	
	private $code = 200;
    private $data = null;
    private $msg = null;

    public $encodingOptions = 0;

    private $_response;

    public function __construct($response) {
        $this->_response = $response;
    }

    public function render($data, $status = 200, $msg = '') {
        
        $status = intval($status);
        $response = ['code' => 200, 'data' => null, 'msg' => ''];
        $response['code'] = $status;
        if(200 == $status){
            $response['data'] = $data;
        }else{
            $response['msg'] = $msg;
        }
        $this->_response->withJson($response);
    }

    public function renderException($status = 0, $msg = '') {
        $status = intval($status);
        $response = ['code' => $status, 'data' => null, 'msg' => $msg];
        $this->_response->withJson($response);
    }
}