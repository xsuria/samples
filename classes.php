
<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
        <h1>Classes</h1>

<?php

/* Definicio simple d'una clase 
Definim la clase, la variable nom es comú per tota la clase, 
al ser publica altres clases poden accedir ala variable

Private:

Desde la misma clase que declara
Protected:

Desde la misma clase que declara
Desde las clases que heredan esta clase
Public:

Desde la misma clase que declara
Desde las clases que heredan esta clase
Desde cualquier elemento fuera de la clase

Es posible impedir que un método pueda sobreescribirse mediante la palabra final:
También se puede impedir que la clase pueda heredarse mediante la misma palabra:

*/


/**************************************
 *              BASIC
 * ***********************************/

 // Podem donar valors a les variables definides.

class Animals {
    public $nom;
    function retorna(){
        echo $this->nom;
    }
}

echo "<p class='return'><b>Basic:</b><br>";
$Animal = new Animals;
$Animal->nom = "Tana"; // Podem donar valors a les variables definides.
$Animal->retorna();
echo "</p>";


/**************************************
 *              COLANR
 * ***********************************/

/* Clonar Classes clone
Podem clonar les clases obtenint el mateix resultat */

echo "<p class='return'><b>Clonar:</b><br>";
$Animal = new Animals;
$Animal->nom = "Tana"; // Podem donar valors a les variables definides.
$Animal->retorna();
echo "<br>";
$Animal2 = clone $Animal;
$Animal2->nom = "Kenia"; // Podem donar valors a les variables definides.
$Animal2->retorna();
echo "</p>";


/**************************************
 *              CONSTRUCTOR
 * ***********************************/

/* Classes recurrents 
Podem usar new self per crear un objecte igual dins; */

echo "<p class='return'><b>Constructor:</b><br>";
class Recurretn{
    public $cont;
    // si volem passar paramets a la clase fem un cosntructor;
    public function __construct($cont){
        $this->cont = $cont;
    }

    function suma(){
        $this->cont++;
        echo $this->cont;
        if ($this->cont<10){
            $this->suma($this->cont); //també podem cridar a un mateix amb this
        }
    }
}

$Recurrent = new Recurretn(0);
$Recurrent->suma();
echo "</p>";



/**************************************
 *              EXTENSIÓ DE CLASSES
 * ***********************************/

echo "<p class='return'><b>Extends:</b><br>";

class multiplica{
    public function multi($var1,$var2){
        return $var1*$var2;
    }
}

class resta extends multiplica{
    public function rest($var1,$var2){
        echo "$var1-$var2=".($var1-$var2)."<br>";
        echo "$var1*$var2=".$this->multi($var1,$var2); // Com esta extesa amb this podem accedir a funcionas de l'altre.
    }
}

$resta = new resta;
$resta->rest(5,2);
$resta->multi(5,2); // multi està dins la clase extesa multiplica
echo "</p>";


/* Inclou les clases */
require_once('classes/variable.php');
require_once('classes/database.php');
require_once('classes/suma.php');
require_once('classes/consulta.php');
require_once('traits/patas.php');


/**************************************
 *              Namespaces
 * ***********************************/

echo "<p class='return'><b>Namespaces:</b><br>";

/* Namespace 
Es poden accedir a les clases per noms asseignats dins l'arxiu include de la clase */

$suma = new calculs\sumatorio\Suma; //nameespace dins la clase
$suma->sum(2,2);
echo "<br>";

// També podem fer referencia amb use

use calculs\sumatorio\Suma; //nameespace dins la clase
$clase = new Suma;
$clase->sum(8,8);
echo "<br>";

/* Podem cridar altres clases desde dins la clase */
class suma2{
    public function suma($var1,$var2){
        echo calculs\sumatorio\Suma::sum($var1,$var2); //nameespace dins la clase
    }
}

$Suma2 = new suma2;
$Suma2->suma(2,2);

echo "</p>";

/**************************************
 *              Database
 * ***********************************/

echo "<p class='return'><b>Database:</b><br>";

/* Connexions a la base de dades */

$consulta = new consulta; // consulta esta extesa a database que fa la connexio
$conditionals[]=array("name","tana","=");
$conditionals[]=array("type","cat","=");
$res = $consulta->selectAll('pets',$conditionals);
print_r($res);
echo "</p>";

/**************************************
 *              Function on construct
 * ***********************************/

echo "<p class='return'><b>Functions on construct:</b><br>";

/* Assignar funcions a variables */

class ClaseA
{
    public $prova;
    public function __construct(){
        $this->prova = function() {
            return "HOLA!";
        };
    }
}
$a = new ClaseA;
$funcio = $a->prova;
echo $funcio();
echo "<p>";

/**************************************
 *              Constants
 * ***********************************/

echo "<p class='return'><b>Constants:</b><br>";

/* es poden definir constants */

class Coche {
    const RUEDAS = 4;
}

echo Coche::RUEDAS . "\n";
$miCoche = new Coche();
echo $miCoche::RUEDAS . "\n";
echo "</p>";

/**************************************
 *              Traits
 * ***********************************/

echo "<p class='return'><b>Traits:</b><br>";

/* es pot resoldre la limitacio de una sola extensio amb trait, només relacions horitzontasl*/

class Mascota {
    public function getRaza() {
        echo 'Perro';
    }
}
trait Color_mascota {
    public function getColor() {
        parent::getRaza();
        echo 'Blanco';
    }
}


class Animales extends Mascota {
    use Color_mascota;
    use extremidades\Patas_mascota; // inclos a traits/patas amb namespace extremidades
}

$o = new Animales();
$o->getRaza(); 
$o->getColor();
$o->getPatas(); 
echo $o->var;

echo "</p>";


# https://diego.com.es/instancia-de-clases-en-php
//https://diego.com.es/programacion-orientada-a-objetos-en-php
//https://codigofacilito.com/videos/curso_git_primeros_pasos
//https://webdeasy.de/en/flexible-php-7-mysqli-database-class-download/
//https://www.php.net/manual/es/book.mysqli.php
?>

</div>
</html>