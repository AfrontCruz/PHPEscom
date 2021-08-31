<?php

require('../model/Model.php');

class Inscripcion extends Model implements \JsonSerializable {
	private $clave;
	private $correo;
	private $fecha;
	private $created;
	private $updated;

	public function __construct($data){
		if( isset( $data->clave) )
			$this->clave = $data->clave;
		if( isset( $data->correo) )
			$this->correo = $data->correo;
		if( isset( $data->fecha) )
			$this->fecha = $data->fecha;
		if( isset( $data->created) )
			$this->created = $data->created;
		if( isset( $data->updated) )
			$this->updated = $data->updated;
	}
	public function create(){
		$query = "INSERT INTO Inscripcion(clave,correo,fecha) VALUES('$this->clave','$this->correo','$this->fecha')";
		return parent::createSQL( $query );
	}
	public function read(){
		$query = "SELECT clave,correo,fecha,created,updated FROM Inscripcion";
		return parent::readSQL($query, "Inscripcion");
	}
	public function update($data){
		if( "created" == $data->attribute || "updated" == $data->attribute)
			return false;
		$query = "UPDATE Inscripcion SET $data->attribute = '$data->value' WHERE clave = '$data->clave' AND correo = '$data->correo';";
		return parent::updateSQL( $query );
	}
	public function delete($data){
		$query = "DELETE FROM Inscripcion WHERE  clave = '$data->clave' AND correo = '$data->correo';";
		return parent::deleteSQL($query);
	}
	public function find( $clave,$correo ){
		$query = "SELECT clave,correo,fecha,created,updated FROM Inscripcion WHERE clave = '$clave' AND correo = '$correo';";
		return parent::readSQL($query, "Inscripcion");
	}
	public function rawSelect($sql){
		return parent::readSQL($sql, "Inscripcion");
	}
	public function jsonSerialize(){
		$vars = get_object_vars($this);
		return $vars;
	}
}