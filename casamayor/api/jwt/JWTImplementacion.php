<?php

require('../php-jwt/src/JWT.php');
require('../php-jwt/src/BeforeValidException.php');
require('../php-jwt/src/ExpiredException.php');
require('../php-jwt/src/SignatureInvalidException.php');

use Firebase\JWT\JWT;

class JWTImplementation{
    private $key;

    public function __construct(){
        $this->key = "@fr0nt";
    }

    public function getHeaderToken(){
        $header = null;
        if (isset($_SERVER['Authorization']))
            $header = trim($_SERVER["Authorization"]);
        else if (isset($_SERVER['HTTP_AUTHORIZATION']))
            $header = $_SERVER["HTTP_AUTHORIZATION"];
        elseif ( function_exists('apache_request_headers') ) {
            $response = apache_request_headers();
            $response = array_combine(array_map('ucwords', array_keys($response)), array_values($response));
            if (isset($response['Authorization']))
                $header = $response['Authorization'];
        }
        return $header;
    }
    
    public function getToken() {
        $header = $this->getHeaderToken();
        $header = str_replace(" ", "", $header);
        $header = str_replace("\n", "", $header);
        $header = str_replace("Bearer", "", $header);
        return $header;
    }
    
    public function getAuth(){
        $token = $this->getToken();
        try {
            $decoded = JWT::decode($token, $this->key , array('HS256'));
            $response = new response( $decoded, true, "" );
            return $response;
        }
        catch (Exception $e){
            $response = new response( null, false, $e->getMessage() );
            print_r( json_encode( $response ) );
            header('HTTP/1.1 401 Unauthorized');
            return $response;
        }
    }
    
    function doToken($user){
        $time = time();
        $payload = array(
            "iat" => $time,
            "exp" => $time + 3600 * 24,
            'user' => $user
        );
        $jwt = JWT::encode($payload, $this->key);
        return $jwt;
    }
}

?>
