<?php

require('../model/Model.php');

class Usuario extends Model implements \JsonSerializable {
	private $correo;
	private $usuario;
	private $clave;
	private $tipo;
	private $activo;
	private $intentos;
	private $inicio;
	private $created;
	private $updated;

	public function __construct($data){
		if( isset( $data->correo) )
			$this->correo = $data->correo;
		if( isset( $data->usuario) )
			$this->usuario = $data->usuario;
		if( isset( $data->clave) )
			$this->clave = $data->clave;
		if( isset( $data->tipo) )
			$this->tipo = $data->tipo;
		if( isset( $data->activo) )
			$this->activo = intval($data->activo);
		if( isset( $data->intentos) )
			$this->intentos = intval($data->intentos);
		if( isset( $data->inicio) )
			$this->inicio = $data->inicio;
		if( isset( $data->created) )
			$this->created = $data->created;
		if( isset( $data->updated) )
			$this->updated = $data->updated;
	}
	public function create(){
		$query = "INSERT INTO Usuario(correo,usuario,clave) VALUES('$this->correo','$this->usuario','$this->clave')";
		return parent::createSQL( $query );
	}
	public function read(){
		$query = "SELECT inicio,created,updated FROM Usuario";
		return parent::readSQL($query, "Usuario");
	}
	public function update($data){
		if( "correo" == $data->attribute || "usuario" == $data->attribute || "inicio" == $data->attribute || "created" == $data->attribute || "updated" == $data->attribute)
			return false;
		$query = "UPDATE Usuario SET $data->attribute = '$data->value' WHERE correo = '$data->correo';";
		return parent::updateSQL( $query );
	}
	public function delete($data){
		$query = "DELETE FROM Usuario WHERE  correo = '$data->correo';";
		return parent::deleteSQL($query);
	}
	public function find( $correo ){
		$query = "SELECT inicio,created,updated FROM Usuario WHERE correo = '$correo';";
		return parent::readSQL($query, "Usuario");
	}
	public function rawSelect($sql){
		return parent::readSQL($sql, "Usuario");
	}
	public function jsonSerialize(){
		$vars = get_object_vars($this);
		return $vars;
	}
}