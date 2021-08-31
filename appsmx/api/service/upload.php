<?php

require('./Service.php');

class UploadService extends Service{

	public function __construct(){
        parent::__construct("upload");
    }
    
	public function exec(){
        if ( !file_exists('../files/qr') )
            if( !mkdir("../files/qr", 0755, true) )
                print_r( json_encode( new Response( null, false, "Hubó un error al crear las carpetas" ) ) );
        
        if( $_FILES[1]['size'] > 5002400 ){
            print_r( json_encode(new Response(null, false, "El peso máximo es de 5MB") ) );
            return;
        }
        else if( !($_FILES[1]['type'] == "application/pdf") ){
            print_r( json_encode(new Response(null, false, "Sólo puedes subir archivos en formato PDF") ) );
            return;
        }
        $move = move_uploaded_file( $_FILES[1]['tmp_name'], "../files/" . $_POST['rename'] );
        if( $move )
            print_r( json_encode(new Response(null, true, null) ) );
        else
            print_r( json_encode(new Response(null, false, "Error al subir documento") ) );
    }
}

$empleadoController = new UploadService();
$empleadoController->exec();