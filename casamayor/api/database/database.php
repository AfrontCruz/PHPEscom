<?php
class database
{
    public $user;
    public $password;
    public $server;
    public $name;

    public $connection;

    public function __construct()
    {
        $database_info = json_decode( file_get_contents("../.db") );
        $this->user = $database_info->database->user;
        $this->password = $database_info->database->password;
        $this->server = $database_info->database->server;
        $this->name = $database_info->database->name;
    }

    public function getConnection()
    {
        $this->connection = null;
        try {
            $this->connection = new PDO("mysql:host=" . $this->server
                . ";dbname=" . $this->name
                , $this->user, $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            return $this->connection;
        } catch (PDOException $exception) {
            echo "Error from get Connection: " . $exception->getMessage() . "\n\n";
        }
    }

    public function create($sql)
    {
        $count = $this->connection->exec($sql);
        return $count > 0 ?  true :  false;
    }

    public function read($sql)
    {
        $query = $this->connection->query($sql);
        $error = $this->connection->errorInfo();
        if( $error[0] == 0 ){
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
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
        $count = $this->connection->exec($sql);
        return $count > 0 ?  true :  false;
    }

    public function delete($sql){
        $count = $this->connection->exec($sql);
        return $count > 0 ?  true :  false;
    }
}
?>