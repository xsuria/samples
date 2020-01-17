<?php

class TradError{

    private $errors=array('0'=>'Ok', '1'=>'sobrepasa php.ini', '2'=>'max_file_sise form');
    private $cod;

    function __construct($cod){
        $this->cod=$cod;
    }

    function tradError(){
            return $this->errors[$this->cod];
    }
}


$dir_subida = 'uploads/';



foreach ($_FILES["imágenes"]["error"] as $clave => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $nombre_tmp = $_FILES["imágenes"]["tmp_name"][$clave];
        // basename() puede evitar ataques de denegació del sistema de ficheros;
        // podría ser apropiado más validación/saneamiento del nombre de fichero
        $nombre = basename($_FILES["imágenes"]["name"][$clave]);
        move_uploaded_file($nombre_tmp, $dir_subida.$nombre);
    }
}



?>
