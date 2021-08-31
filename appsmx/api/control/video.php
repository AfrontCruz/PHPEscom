<?php

require('./Controller.php');
require('./InterfaceController.php');
require('../model/video.php');

class VideoController extends Controller implements InterfaceController{
	private $video;

	public function __construct(){
		parent::__construct("video");
		$this->video = new Video( $this->data->video );
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
			print_r( json_encode( $this->video->create() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function GET(){
		if( $this->params == null)
			print_r( json_encode( $this->video->read() ) );
		else{
			$function = $this->params[0];
			$this->$function();
		}
	}
	public function PUT(){
		print_r( json_encode( $this->video->update($this->data) ) );
	}
	public function DELETE(){
		print_r( json_encode( $this->video->delete($this->data) ) );
	}
	public function OPTIONS(){ }

	public function find(){
		print_r( json_encode( $this->video->find( $this->params[1],$this->params[2] ) ) );
	}
	public function test(){
		echo "Test Video";
	}
}

$videoController = new VideoController();
$videoController->exec();