<?php
    require( './database/database.php');
    $curp = $_POST['curp'];
    $clave = $_POST['clave'];

    $db = new database();
    $db->obtenerConexion();
    $sql = "CALL sp_autentica('$curp','$clave')";
    $result = $db->read( $sql );
    
    if( $result[0]->respuesta == 1 ){
        echo "Autenticación exitosa";
        ?>
        <script>
            setTimeout( () => { window.location.replace("/dashboard.php?curp=<?php echo $curp ?>" ) }, 1000 );
        </script>
<?php
    }
    else
        echo "Error: " . $result[0]->mensaje;
?>