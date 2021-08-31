<?php

require('./Controller.php');
require('./InterfaceController.php');
require('../model/usuario.php');

class UsuarioController extends Controller implements InterfaceController{
	private $usuario;
	private $jwt;
	public function __construct(){
		parent::__construct("usuario");
		$this->jwt = new JWTImplementation();
		$this->usuario = new Usuario( $this->data->usuario );
	}
	public function exec(){
		$response = $this->jwt->getAuth();
		if( !$response->getIsSuccess() )
			return;
		$function = $this->method;
		$this->$function();
	}
	public function POST(){
		if( $this->params == null)
			print_r( json_encode( $this->usuario->create() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function GET(){
		if( $this->params == null)
			print_r( json_encode( $this->usuario->read() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function PUT(){
		print_r( json_encode( $this->usuario->update($this->data) ) );
	}
	public function DELETE(){
		print_r( json_encode( $this->usuario->delete($this->data) ) );
	}
	public function OPTIONS(){ }

	public function find(){
		print_r( json_encode( $this->usuario->find( $this->params[1] ) ) );
	}
	public function test(){
		echo "Test Usuario";
	}
}

$usuarioController = new UsuarioController();
$usuarioController->exec();