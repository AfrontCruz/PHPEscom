<?php

class database
{
    public $usuario;
    public $clave;
    public $servidor;
    public $nombreBD;

    public $conexion;

    public function __construct()
    {
        $this->usuario = 'root';
        $this->clave = 'root';
        $this->servidor = 'localhost';
        $this->nombreBD = 'phpescom';       
    }

    public function obtenerConexion()
    {
        $this->conexion = null;
        try {
            $this->conexion = new PDO("mysql:host=" . $this->servidor
                . ";dbname=" . $this->nombreBD
                , $this->usuario, $this->clave);
            $this->conexion->exec("set names uft8");
            return $this->conexion;
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
    }

    public function create($sql)
    {
        $this->conexion->query('SET CHARACTER SET utf8');
        $consulta = $this->conexion->prepare($sql);
        $count = $this->conexion->exec($sql);
        return $count > 0 ?  true :  false;
    }

    public function read($sql)
    {
        $this->conexion->query('SET CHARACTER SET utf8');
        $consulta = $this->conexion->query($sql);
        $error = $this->conexion->errorInfo();
        if( $error[0] == 0 ){
            $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
        }        
        else if( $error[0] == 23000 ){
            $resultado = [null, "Registro duplicado"];
        }
        else{
            $resultado = [null, $error[2]];
        }

        return $resultado;
    }

    public function update($sql){
        $this->conexion->query('SET CHARACTER SET utf8');
        $count = $this->conexion->exec($sql);
        return $count > 0 ?  true :  false;
    }

    public function delete($sql){
        $this->conexion->query('SET CHARACTER SET utf8');
        $count = $this->conexion->exec($sql);
        return $count > 0 ?  true :  false;
    }
}
?>
