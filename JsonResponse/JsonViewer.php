<?php

class JsonViewer {
	
	private $code = 200;
	private $data = null;
	private $msg = null;

	public $contentType = 'application/json';
	public $encodingOptions = 0;

	public function render($data, $status = 200, $msg = '') {
        $app = \Slim\Slim::getInstance();
        $status = intval($status);
        $response = ['code' => 200, 'data' => null, 'msg' => ''];
        $response['code'] = $status;
        if(200 == $status){
        	$response['data'] = $data;
        }else{
        	$response['msg'] = $msg;
        }
		
        $app->response()->status(200);
        $app->response()->header('Content-Type', $this->contentType);
        $jsonp_callback = $app->request->get('callback', null);
        if($jsonp_callback !== null){
            $app->response()->body($jsonp_callback.'('.json_encode($response, $this->encodingOptions).')');
        } else {
            $app->response()->body(json_encode($response, $this->encodingOptions));
        }
        $app->stop();
    }
}