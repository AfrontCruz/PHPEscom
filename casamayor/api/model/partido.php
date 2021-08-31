<?php

require('../model/Model.php');

class Partido extends Model implements \JsonSerializable {
	private $jornada;
	private $local;
	private $visita;
	private $fecha;
	private $orden;
	private $abierto;
	private $created;
	private $updated;

	public function __construct($data){
		if( isset( $data->jornada) )
			$this->jornada = $data->jornada;
		if( isset( $data->local) )
			$this->local = $data->local;
		if( isset( $data->visita) )
			$this->visita = $data->visita;
		if( isset( $data->fecha) )
			$this->fecha = $data->fecha;
		if( isset( $data->orden) )
			$this->orden = intval($data->orden);
		if( isset( $data->abierto) )
			$this->abierto = intval($data->abierto);
		if( isset( $data->created) )
			$this->created = $data->created;
		if( isset( $data->updated) )
			$this->updated = $data->updated;
	}
	public function create(){
		$query = "INSERT INTO Partido(jornada,local,visita,fecha,orden,abierto) VALUES('$this->jornada','$this->local','$this->visita','$this->fecha',$this->orden,$this->abierto)";
		return parent::createSQL( $query );
	}
	public function read(){
		$query = "SELECT jornada,local,visita,fecha,orden,abierto,created,updated FROM Partido";
		return parent::readSQL($query, "Partido");
	}
	public function update($data){
		if( "created" == $data->attribute || "updated" == $data->attribute)
			return false;
		$query = "UPDATE Partido SET $data->attribute = '$data->value' WHERE jornada = '$data->jornada' AND local = '$data->local' AND visita = '$data->visita';";
		return parent::updateSQL( $query );
	}
	public function delete($data){
		$query = "DELETE FROM Partido WHERE  jornada = '$data->jornada' AND local = '$data->local' AND visita = '$data->visita';";
		return parent::deleteSQL($query);
	}
	public function find( $jornada,$local,$visita ){
		$query = "SELECT jornada,local,visita,fecha,orden,abierto,created,updated FROM Partido WHERE jornada = '$jornada' AND local = '$local' AND visita = '$visita';";
		return parent::readSQL($query, "Partido");
	}
	public function jornada(){
		$query = "SELECT jornada,local,visita,fecha,orden,abierto,created,updated FROM Partido WHERE abierto = 1 ORDER BY orden;";

		return parent::readSQL($query, "Partido");
	}
	public function rawSelect($sql){
		return parent::readSQL($sql, "Partido");
	}
	public function jsonSerialize(){
		$vars = get_object_vars($this);
		return $vars;
	}
}