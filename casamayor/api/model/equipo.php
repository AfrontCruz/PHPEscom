<?php

require('../model/Model.php');

class Equipo extends Model implements \JsonSerializable {
	private $nombre;
	private $clave;
	private $created;
	private $updated;

	public function __construct($data){
		if( isset( $data->nombre) )
			$this->nombre = $data->nombre;
		if( isset( $data->clave) )
			$this->clave = $data->clave;
		if( isset( $data->created) )
			$this->created = $data->created;
		if( isset( $data->updated) )
			$this->updated = $data->updated;
	}
	public function create(){
		$query = "INSERT INTO Equipo(nombre,clave) VALUES('$this->nombre','$this->clave')";
		return parent::createSQL( $query );
	}
	public function read(){
		$query = "SELECT nombre,clave,created,updated FROM Equipo";
		return parent::readSQL($query, "Equipo");
	}
	public function update($data){
		if( "created" == $data->attribute || "updated" == $data->attribute)
			return false;
		$query = "UPDATE Equipo SET $data->attribute = '$data->value' WHERE clave = '$data->clave';";
		return parent::updateSQL( $query );
	}
	public function delete($data){
		$query = "DELETE FROM Equipo WHERE  clave = '$data->clave';";
		return parent::deleteSQL($query);
	}
	public function find( $clave ){
		$query = "SELECT nombre,clave,created,updated FROM Equipo WHERE clave = '$clave';";
		return parent::readSQL($query, "Equipo");
	}
	public function rawSelect($sql){
		return parent::readSQL($sql, "Equipo");
	}
	public function jsonSerialize(){
		$vars = get_object_vars($this);
		return $vars;
	}
}