    <html>
        <?php include("top2.inc.php")?>
        <div style="width: 800px; padding:20px;">
            <h1>Seguretat</h1>

<?php 
echo "<p class='return'><b>Autentificador header PHP_AUTH_DIGEST</b><br>";

$dominio = 'http://127.0.0.1/samples/seguretat.phps';

// usuario => contraseña
$usuarios = array('admin' => 'xavisegur', 'invitado' => 'invitado');


if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$dominio.
           '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($dominio).'"');

    die('Texto a enviar si el usuario pulsa el botón Cancelar');
}


// Analizar la variable PHP_AUTH_DIGEST
if (!($datos = analizar_http_digest($_SERVER['PHP_AUTH_DIGEST'])) ||
    !isset($usuarios[$datos['username']]))
    die('Credenciales incorrectas');


// Generar una respuesta válida
$A1 = md5($datos['username'] . ':' . $dominio . ':' . $usuarios[$datos['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$datos['uri']);
$respuesta_válida = md5($A1.':'.$datos['nonce'].':'.$datos['nc'].':'.$datos['cnonce'].':'.$datos['qop'].':'.$A2);

if ($datos['response'] != $respuesta_válida)
    die('Credenciales incorrectas');

// Todo bien, usuario y contraseña válidos
echo 'Se ha identificado como: ' . $datos['username'];

function analizar_http_digest($txt)
{
    // Protección contra datos ausentes
    $partes_necesarias = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $datos = array();
    $claves = implode('|', array_keys($partes_necesarias));

    preg_match_all('@(' . $claves . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $coincidencias, PREG_SET_ORDER);

    foreach ($coincidencias as $c) {
        $datos[$c[1]] = $c[3] ? $c[3] : $c[4];
        unset($partes_necesarias[$c[1]]);
    }

    return $partes_necesarias ? false : $datos;
}

echo "</p>";

echo "<p class='return'><b>Autentificador header</b><br>";
/* if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Mi dominio"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Contraseña incorrecta';
    exit;
} else {
    echo "Hola {$_SERVER['PHP_AUTH_USER']}.<br>";
    echo "Introdujo {$_SERVER['PHP_AUTH_PW']} como su contraseña.";
} */
ECHO 'COMENTAT';
echo "</p>";

echo "<p class='return'><b>Encriptar Passwords password_hash /password_verify</b><br>";

echo "encripta: ".$crypt = password_hash('password',PASSWORD_DEFAULT);
echo "<br>";
echo "comprova: ";
if (password_verify('password',$crypt)){
    echo "Si";
}else{
    echo "No";
}
echo "</p>";

echo "<p class='return'><b>Encriptar Passwords Crypt</b><br>";
echo crypt('password','clau');
echo "</p>";

echo "<p class='return'><b>mysqli_real_escape_string</b><br>";

spl_autoload_register(function ($nombre_clase) {
    include "classes/".$nombre_clase . '.php';
    //throw new ExcepciónAusente("Imposible cargar $nombre_clase.");
});


class mysql_scape_string extends Database{

    public function __construct(){
        $this->connect();
    }

    function escape($var){
        return mysqli_real_escape_string($this->connection,$var);
    }
}

$escape = new mysql_scape_string;
$indice="a' or 'a'='a";
$consulta = sprintf("SELECT id, name FROM products where name='%s' and name!='%s'",
$escape->escape($indice),$indice);
echo $consulta;
echo "</p>";
?>
XFORM<BR>
<h:html xmlns:h="http://www.w3.org/1999/xhtml"
        xmlns="http://www.w3.org/2002/xforms">
<h:head>
 <h:title>Búsqueda</h:title>
 <model>
  <submission action="http://example.com/search"
              method="urlencoded-post" id="s"/>
 </model>
</h:head>
<h:body>
 <h:p>
  <input ref="q"><label>Buscar</label></input>
  <submit submission="s"><label>Ir</label></submit>
 </h:p>
</h:body>
</h:html>


</div>
</html>