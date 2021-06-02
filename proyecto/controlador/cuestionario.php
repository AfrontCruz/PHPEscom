<?php

require( './controller.php');

class CuestionarioController extends Controller{

    public function __construct(){
        parent::__construct("cuestionario");
        $params = $this->getParams();
        if( count( $params ) > 1  ){
            $nameFunction = $params[1];
            $this->$nameFunction();
        }
        else{
            $method = $this->getMethod();
            if( $method == "POST" )
                $this->crear();
            elseif( $method == "GET" )
                $this->leer();
            elseif( $method == "PUT" )
                $this->actualizar();
            elseif( $method == "DELETE" )
                $this->eliminar();
        }

    }
    // POST
    public function crear(){
        print_r( "Estoy creando!" );
    }
    // GET
    public function leer(){
        print_r( "Estoy leyendo!" );
    }
    // PUT
    public function actualizar(){
        print_r( "Estoy actualizando!" );
    }
    // DELETE
    public function eliminar(){
        print_r( "Estoy eliminando!" );
    }
    public function buscar(){
        $params = $this->getParams();
        print_r( "Estoy buscando $params[2]");
    }
    // Test 
    public function prueba(){
        print_r( "Estoy en una prueba!" );
    }
}

$cuestionarioController = new CuestionarioController();

?>