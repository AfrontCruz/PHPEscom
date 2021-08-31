<?php

require('./Controller.php');
require('./InterfaceController.php');
require('../model/curso.php');

class CursoController extends Controller implements InterfaceController{
	private $curso;
	private $jwt;

	public function __construct(){
		parent::__construct("curso");
		$this->jwt = new JWTImplementation();
		$this->curso = new Curso( $this->data->curso );
	}
	public function exec(){
		$response = $this->jwt->getAuth();
		if( !$response->getIsSuccess() )
			return;
		$function = $this->method;
		$this->$function();
	}
	public function POST(){
		if( $this->params == null){
			$response = $this->jwt->getAuth();
			print_r( json_encode( $this->curso->create() ) );
		}
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function GET(){
		if( $this->params == null)
			print_r( json_encode( $this->curso->read() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function PUT(){
		print_r( json_encode( $this->curso->update($this->data) ) );
	}
	public function DELETE(){
		print_r( json_encode( $this->curso->delete($this->data) ) );
	}
	public function OPTIONS(){ }

	public function find(){
		print_r( json_encode( $this->curso->find( $this->params[1] ) ) );
	}
	public function test(){
		echo "Test Curso";
	}
}

$cursoController = new CursoController();
$cursoController->exec();