<?php

require('./Controller.php');
require('./InterfaceController.php');
require('../model/inscripcion.php');

class InscripcionController extends Controller implements InterfaceController{
	private $inscripcion;
	private $jwt;

	public function __construct(){
		parent::__construct("inscripcion");
		$this->jwt = new JWTImplementation();
		$this->inscripcion = new Inscripcion( $this->data->inscripcion );
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
			print_r( json_encode( $this->inscripcion->create() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function GET(){
		if( $this->params == null)
			print_r( json_encode( $this->inscripcion->read() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function PUT(){
		print_r( json_encode( $this->inscripcion->update($this->data) ) );
	}
	public function DELETE(){
		print_r( json_encode( $this->inscripcion->delete($this->data) ) );
	}
	public function OPTIONS(){ }

	public function find(){
		print_r( json_encode( $this->inscripcion->find( $this->params[1],$this->params[2] ) ) );
	}
	public function test(){
		echo "Test Inscripcion";
	}
}

$inscripcionController = new InscripcionController();
$inscripcionController->exec();