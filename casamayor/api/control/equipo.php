<?php

require('./Controller.php');
require('./InterfaceController.php');
require('../model/equipo.php');

class EquipoController extends Controller implements InterfaceController{
	private $equipo;

	public function __construct(){
		parent::__construct("equipo");
		$this->equipo = new Equipo( $this->data->equipo );
	}
	public function exec(){
		$function = $this->method;
		$this->$function();
	}
	public function POST(){
		if( $this->params == null)
			print_r( json_encode( $this->equipo->create() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function GET(){
		if( $this->params == null)
			print_r( json_encode( $this->equipo->read() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function PUT(){
		print_r( json_encode( $this->equipo->update($this->data) ) );
	}
	public function DELETE(){
		print_r( json_encode( $this->equipo->delete($this->data) ) );
	}
	public function OPTIONS(){ }

	public function find(){
		print_r( json_encode( $this->equipo->find( $this->params[1] ) ) );
	}
	public function test(){
		echo "Test Equipo";
	}
}

$equipoController = new EquipoController();
$equipoController->exec();