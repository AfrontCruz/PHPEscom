<?php

class url{
    public function __construct($uri, $name)
    {        
        $str_uri = str_replace(".php", "", $uri );
        $str_uri = str_replace(".api", "", $str_uri );
        $str_uri = str_replace("microframework/", "", $str_uri );
        $str_uri = str_replace("micrositio/", "", $str_uri );
        $str_uri = str_replace("/v0", "", $str_uri);
        $str_uri = str_replace("%20", " ", $str_uri);
        if( substr( $str_uri, -1 ) == "/" )
            $str_uri = substr( $str_uri, 0, -1 );
        $str_uri = str_replace("/api/control/" . $name . "/","", $str_uri);
        $str_uri = str_replace("/api/control/" . $name,"", $str_uri);
        $str_uri = str_replace("/api/service/" . $name . "/","", $str_uri);
        $str_uri = str_replace("/api/service/" . $name,"", $str_uri);
        if( strpos( $str_uri, "/" ) !== false )
            $this->params = explode("/",$str_uri);
        else if( strlen( $str_uri ) > 0 )
            $this->params = [$str_uri];
        else
            $this->params = null;
    }

    public function getParams(){
        return $this->params;
    }
}

?>