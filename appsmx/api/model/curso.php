<?php

require('../model/Model.php');

class Curso extends Model implements \JsonSerializable {
	private $nombre;
	private $clave;
	private $descripcion;
	private $disponible;
	private $created;
	private $updated;

	public function __construct($data){
		if( isset( $data->nombre) )
			$this->nombre = $data->nombre;
		if( isset( $data->clave) )
			$this->clave = $data->clave;
		if( isset( $data->descripcion) )
			$this->descripcion = $data->descripcion;
		if( isset( $data->disponible) )
			$this->disponible = intval($data->disponible);
		if( isset( $data->created) )
			$this->created = $data->created;
		if( isset( $data->updated) )
			$this->updated = $data->updated;
	}
	public function create(){
		$query = "INSERT INTO Curso(nombre,clave,descripcion,disponible) VALUES('$this->nombre','$this->clave','$this->descripcion',$this->disponible)";
		return parent::createSQL( $query );
	}
	public function read(){
		$query = "SELECT nombre,clave,descripcion,disponible,created,updated FROM Curso";
		return parent::readSQL($query, "Curso");
	}
	public function update($data){
		if( "created" == $data->attribute || "updated" == $data->attribute)
			return false;
		$query = "UPDATE Curso SET $data->attribute = '$data->value' WHERE clave = '$data->clave';";
		return parent::updateSQL( $query );
	}
	public function delete($data){
		$query = "DELETE FROM Curso WHERE  clave = '$data->clave';";
		return parent::deleteSQL($query);
	}
	public function find( $clave ){
		$query = "SELECT nombre,clave,descripcion,disponible,created,updated FROM Curso WHERE clave = '$clave';";
		return parent::readSQL($query, "Curso");
	}
	public function rawSelect($sql){
		return parent::readSQL($sql, "Curso");
	}
	public function jsonSerialize(){
		$vars = get_object_vars($this);
		return $vars;
	}
}