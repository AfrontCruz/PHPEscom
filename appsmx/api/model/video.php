<?php

require('../model/Model.php');

class Video extends Model implements \JsonSerializable {
	private $titulo;
	private $id;
	private $clave;
	private $descripcion;
	private $disponible;
	private $created;
	private $updated;

	public function __construct($data){
		if( isset( $data->titulo) )
			$this->titulo = $data->titulo;
		if( isset( $data->id) )
			$this->id = $data->id;
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
		$query = "INSERT INTO Video(titulo,id,clave,descripcion,disponible) VALUES('$this->titulo','$this->id','$this->clave','$this->descripcion',$this->disponible)";
		return parent::createSQL( $query );
	}
	public function read(){
		$query = "SELECT titulo,id,clave,descripcion,disponible,created,updated FROM Video";
		return parent::readSQL($query, "Video");
	}
	public function update($data){
		if( "created" == $data->attribute || "updated" == $data->attribute)
			return false;
		$query = "UPDATE Video SET $data->attribute = '$data->value' WHERE id = '$data->id' AND clave = '$data->clave';";
		return parent::updateSQL( $query );
	}
	public function delete($data){
		$query = "DELETE FROM Video WHERE  id = '$data->id' AND clave = '$data->clave';";
		return parent::deleteSQL($query);
	}
	public function find( $id,$clave ){
		$query = "SELECT titulo,id,clave,descripcion,disponible,created,updated FROM Video WHERE id = '$id' AND clave = '$clave';";
		return parent::readSQL($query, "Video");
	}
	public function rawSelect($sql){
		return parent::readSQL($sql, "Video");
	}
	public function jsonSerialize(){
		$vars = get_object_vars($this);
		return $vars;
	}
}