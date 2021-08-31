<?php

require('./Controller.php');
require('./InterfaceController.php');
require('../model/quiniela.php');

class QuinielaController extends Controller implements InterfaceController{
	private $quiniela;

	public function __construct(){
		parent::__construct("quiniela");
		$this->quiniela = new Quiniela( $this->data->quiniela );
	}
	public function exec(){
		$function = $this->method;
		$this->$function();
	}
	public function POST(){
		if( $this->params == null)
			print_r( json_encode( $this->quiniela->create() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function GET(){
		if( $this->params == null)
			print_r( json_encode( $this->quiniela->read() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function PUT(){
		print_r( json_encode( $this->quiniela->update($this->data) ) );
	}
	public function DELETE(){
		print_r( json_encode( $this->quiniela->delete($this->data) ) );
	}
	public function OPTIONS(){ }

	public function find(){
		print_r( json_encode( $this->quiniela->find( $this->params[1] ) ) );
	}
	public function test(){
		echo "Test Quiniela";
	}
}

$quinielaController = new QuinielaController();
$quinielaController->exec();