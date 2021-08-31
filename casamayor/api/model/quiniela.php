<?php

require('../model/Model.php');

class Quiniela extends Model implements \JsonSerializable {
	private $jornada;
	private $quiniela;
	private $correo;
	private $juega;
	private $codigo;
	private $registroPago;
	private $fechaPago;
	private $created;
	private $updated;

	public function __construct($data){
		if( isset( $data->jornada) )
			$this->jornada = $data->jornada;
		if( isset( $data->quiniela) )
			$this->quiniela = $data->quiniela;
		if( isset( $data->correo) )
			$this->correo = $data->correo;
		if( isset( $data->juega) )
			$this->juega = $data->juega;
		if( isset( $data->codigo) )
			$this->codigo = $data->codigo;
		if( isset( $data->registroPago) )
			$this->registroPago = $data->registroPago;
		if( isset( $data->fechaPago) )
			$this->fechaPago = $data->fechaPago;
		if( isset( $data->created) )
			$this->created = $data->created;
		if( isset( $data->updated) )
			$this->updated = $data->updated;
	}
	public function create(){
		$query = "INSERT INTO Quiniela(jornada,quiniela,correo,juega,registroPago,fechaPago) VALUES('$this->jornada','$this->quiniela','$this->correo','$this->juega','$this->registroPago','$this->fechaPago')";
		return parent::createSQL( $query );
	}
	public function read(){
		$query = "SELECT jornada,quiniela,correo,juega,codigo,registroPago,fechaPago,created,updated FROM Quiniela";
		return parent::readSQL($query, "Quiniela");
	}
	public function update($data){
		if( "created" == $data->attribute || "updated" == $data->attribute)
			return false;
		$query = "UPDATE Quiniela SET $data->attribute = '$data->value' WHERE codigo = '$data->codigo';";
		return parent::updateSQL( $query );
	}
	public function delete($data){
		$query = "DELETE FROM Quiniela WHERE  codigo = '$data->codigo';";
		return parent::deleteSQL($query);
	}
	public function find( $codigo ){
		$query = "SELECT jornada,quiniela,correo,juega,codigo,registroPago,fechaPago,created,updated FROM Quiniela WHERE codigo = '$codigo';";
		return parent::readSQL($query, "Quiniela");
	}
	public function rawSelect($sql){
		return parent::readSQL($sql, "Quiniela");
	}
	public function jsonSerialize(){
		$vars = get_object_vars($this);
		return $vars;
	}
}