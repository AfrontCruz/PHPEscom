<?php

require('../database/database.php');
require('../utils/response.php');

class View{
    public function readSQL($sql, $view){
        $db = new database();
        $db->getConnection();
        $result = $db->read($sql);
        $array = array();        
        foreach($result as $obj){
            $obj = new $view($obj);
            array_push( $array, $obj->jsonSerialize() );
        }
        $response = new response( $array, true, "" );
        return $response;
    }
    public function readSQLRaw($sql, $data){
        $db = new database();
        $db->getConnection();
        $result = $db->read($sql);
        $array = [];
        foreach($result as $obj){
            array_push( $array, $obj->$data );
        }
        $response = new response( $array, true, "" );
        return $response;
    }
        
}