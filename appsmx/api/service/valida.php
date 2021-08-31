<?php

require('./Service.php');

class ValidaService extends Service{
	public function __construct(){
        parent::__construct("valida");
    }
    
	public function exec(){
        $jwt = new JWTImplementation();
        $response = $jwt->getAuth();
        if( $response->getIsSuccess() )
            print_r( json_encode( $response ) );
    }
}

$validaService = new ValidaService();
$validaService->exec();