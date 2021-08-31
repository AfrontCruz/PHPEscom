<?php

require('./Controller.php');
require('./InterfaceController.php');
require('../model/partido.php');

class PartidoController extends Controller implements InterfaceController{
	private $partido;

	public function __construct(){
		parent::__construct("partido");
		$this->partido = new Partido( $this->data->partido );
	}
	public function exec(){
		$function = $this->method;
		$this->$function();
	}
	public function POST(){
		if( $this->params == null)
			print_r( json_encode( $this->partido->create() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function GET(){
		if( $this->params == null)
			print_r( json_encode( $this->partido->read() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function PUT(){
		print_r( json_encode( $this->partido->update($this->data) ) );
	}
	public function DELETE(){
		print_r( json_encode( $this->partido->delete($this->data) ) );
	}
	public function OPTIONS(){ }

	public function find(){
		print_r( json_encode( $this->partido->find( $this->params[1],$this->params[2],$this->params[3] ) ) );
	}
	public function jornada(){
		print_r( json_encode( $this->partido->jornada() ) );
	}
	public function test(){
		echo "Test Partido";
	}
}

$partidoController = new PartidoController();
$partidoController->exec();