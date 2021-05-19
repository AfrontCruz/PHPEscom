<?php
  function str_contains($name){
    $pos = strpos( $_SERVER['SCRIPT_NAME'], $name );

    if( $pos === false )
      return false;
    else
      echo " active";
  }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <a class="navbar-brand" href="#"><span class="font-weight-bold">PHP</span>escom</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item <?php str_contains( "index" ); ?>">
        <a class="nav-link" href="/proyecto">Inicio<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php str_contains( "nuevo" ); ?>">
        <a class="nav-link" href="/proyecto/nuevo.php">Nuevo cuestionario<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php str_contains( "ver" ); ?>">
        <a class="nav-link" href="/proyecto/ver.php">Ver cuestionarios</a>
      </li>
    </ul>
  </div>
</nav>