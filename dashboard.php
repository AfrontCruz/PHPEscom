<?php
    require( './database/database.php');
    $curp = $_GET['curp'];

    // echo $curp;
    $db = new database();
    $db->obtenerConexion();
    $sql = "SELECT CONCAT( nombre, ' ', paterno ) AS nombre FROM usuario WHERE curp = '$curp';";
    $result = $db->read( $sql );
    echo $result[0]->nombre;