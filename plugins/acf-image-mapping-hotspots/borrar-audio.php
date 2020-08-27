<?php 
    $url=$_REQUEST['url'];
    $nombre=basename($url);
    $server=$_SERVER["HTTP_HOST"];
    //$ruta=dirname(__FILE__).'/acf-grabador-audio/audio/'.$nombre;
    $ruta="/home/huyi/webapps/elementaldesign/peritajes/wp-content/plugins/acf-grabador-audio/audio/".$nombre;
    unlink($ruta);
    $urli= $_SERVER["REQUEST_URI"];
    
    echo "plugins".$ruta;
?>