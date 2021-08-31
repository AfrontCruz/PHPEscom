<?php

require('./Service.php');

class AutenticaService extends Service{
    private $store;

	public function __construct(){
        parent::__construct("autentica");
        $this->store = json_decode( file_get_contents('../store/querys.json') );
    }
    
	public function exec(){
        $query = $this->store->autentica;
        $query = str_replace("$1", $this->data->id, $query );
        $result = $this->getInfo($query);
        
        if( count( $result ) > 0 ){
            $response = $this->autenticar($result);
        }
        else
            $response = new response( null, false, "El usuario no existe");
        
        print_r( json_encode( $response ) );
    }

    public function autenticar($result){
        if( !$result[0]->activo )
            return $this->failed("Usuario bloqueado", $result[0]->intento );
        else{
            if( $result[0]->clave == $this->data->clave )
                return $this->success($result);
            else
                return $this->failed("Contraseña incorrecta tiene " . (5 - (1 + $result[0]->intentos ) ) . " intentos antes de bloquearse", $result[0]->intentos);
        }
    }

    public function success($result){
        $user = [ 
            'correo' =>  $result[0]->correo,
            'usuario' => $result[0]->usuario,
            'created' => $result[0]->created,
            'inicio' => $result[0]->inicio,
            'tipo' => $result[0]->tipo
        ];
        $jwt = new JWTImplementation();
        $token = $jwt->doToken( $user );
        $array = [ 'usuario' => $user, 'token' => $token];
        $response = new response( $array, true, null );
        $query = $this->store->autenticaSuccess;
        $query = str_replace("$1", $this->data->id, $query );
        $db = new database();
        $db->getConnection();
        $db->update( $query );
        return $response;
    }

    public function failed($msg, $tried){
        $response = new response( null, false, $msg );
        $query = $this->store->autenticaFailed;
        $query = str_replace("$1", $this->data->id, $query );
        $db = new database();
        $db->getConnection();
        $db->update( $query );
        if( $tried + 1 > 4 ){
            $query = $this->store->autenticaLock;
            $query = str_replace("$1", $this->data->id, $query );
            $db->update( $query );
        }
        return $response;
    }
    
    public function getInfo($query){
        $db = new database();
        $db->getConnection();
        return $db->read( $query );
    }
}

$authService = new AutenticaService();
$authService->exec();