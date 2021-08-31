<?php

require('../database/database.php');
require('../utils/response.php');

class Model{
    public function createSQL($sql){
        $db = new database();
        $db->getConnection();
        $result = $db->create($sql);
        $response = new Response( null, $result, "");
        $db = null;
        return $response;
    }
    public function readSQL($sql, $model){
        $db = new database();
        $db->getConnection();
        $result = $db->read($sql);
        $array = array();        
        foreach($result as $obj){
            $obj = new $model($obj);
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
    public function updateSQL($sql){
        $db = new database();
        $db->getConnection();
        $result = $db->update($sql);
        $response = new Response( null, $result, "");
        $db = null;
        return $response;
    }
    public function deleteSQL($sql){
        $db = new database();
        $db->getConnection();
        $result = $db->delete($sql);
        $response = new Response( null, $result, "");
        $db = null;
        return $response;
    }
    
}