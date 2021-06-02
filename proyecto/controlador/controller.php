<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With, Authorization");

class Controller{
    private $method;
    private $data;
    private $params;

    public function __construct( $name ){
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->data = json_decode( file_get_contents('php://input') );
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace( "/proyecto/controlador/$name.php", "", $url );
        $this->params = explode( "/", $url ); // La posición 0 va vacía siempre.
    }
    public function getMethod(){
        return $this->method;
    }
    public function getData(){
        return $this->data;
    }
    public function getParams(){
        return $this->params;
    }
}

?>