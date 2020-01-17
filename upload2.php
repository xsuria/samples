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
$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);

echo $fichero_subido;

echo '<pre>';
if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.<br>";
} else {
    echo "¡Posible ataque de subida de ficheros!<br>";
}

echo 'Más información de depuración:';

print_r($_FILES);
$err = $_FILES['fichero_usuario']['error'];
$trad_error = new TradError($err);
echo $trad_error->tradError();

?>
