<?php

require( '../utils/url.php');
require('../jwt/JWTImplementacion.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With, Authorization");

class Controller{
    public $data;
    public $method;
    public $params;

    public function __construct($name){
        $this->data = json_decode( file_get_contents('php://input') );
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url = new url( $_SERVER['REQUEST_URI'], $name );
        $this->params = $url->getParams();
    }

    public function exec(){
        print_r( $this );
    }

    public function getData(){
        return $this->data;
    }

    public function getMetodo(){
        return $this->method;
    }

    public function getParametros(){
        return $this->params;
    }
}
?>
