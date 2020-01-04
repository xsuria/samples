
<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
        <h1>Classes</h1>
        <h2>Variables</h2>
        <p>
            <b>Private:</b><br>
            Desde la misma clase que declara<br>
            <b>Protected:</b><br>
            Desde la misma clase que declara<br>
            Desde las clases que heredan esta clase<br>
            <b>Public:</b><br>
            Desde la misma clase que declara<br>
            Desde las clases que heredan esta clase<br>
            Desde cualquier elemento fuera de la clase<br>

        </p>


    </div>
</html>





<?php

/* Definicio simple d'una clase 
Definim la clase, la variable nom es comú per tota la clase, 
al ser publica altres clases poden accedir ala variable



Es posible impedir que un método pueda sobreescribirse mediante la palabra final:
También se puede impedir que la clase pueda heredarse mediante la misma palabra:

*/

class Animals {
    public $nom;
    function retorna(){
        echo $this->nom;
        echo "<br>";
    }
}

$Animal = new Animals;
$Animal->nom = "Tana"; // Podem donar valors a les variables definides.
$Animal->retorna();

echo "<hr>";
/* Clonar Classes clone
Podem clonar les clases obtenint el mateix resultat */

$Animal = new Animals;
$Animal->nom = "Tana"; // Podem donar valors a les variables definides.
$Animal->retorna();

$Animal2 = clone $Animal;
$Animal2->nom = "Kenia"; // Podem donar valors a les variables definides.
$Animal2->retorna();

echo "<hr>";

/* Classes recurrents 
Podem usar new self per crear un objecte igual dins; */

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

echo "<hr>";

/* Extendre classes */


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
echo "<hr>";


/* Inclou les clases */
require_once('classes/variable.php');
require_once('classes/database.php');
require_once('classes/suma.php');
require_once('classes/consulta.php');
require_once('traits/patas.php');



/* Namespace 
Es poden accedir a les clases per noms asseignats dins l'arxiu include de la clase */

$suma = new calculs\sumatorio\Suma; //nameespace dins la clase
$suma->sum(2,2);
echo "<hr>";

// També podem fer referencia amb use

use calculs\sumatorio\Suma; //nameespace dins la clase
$clase = new Suma;
$clase->sum(8,8);
echo "<hr>";

/* Podem cridar altres clases desde dins la clase */
class suma2{
    public function suma($var1,$var2){
        echo calculs\sumatorio\Suma::sum($var1,$var2); //nameespace dins la clase
    }
}

$Suma2 = new suma2;
$Suma2->suma(2,2);
echo "<hr>";

/* Connexions a la base de dades */

$consulta = new consulta; // consulta esta extesa a database que fa la connexio
$conditionals[]=array("col2","txt1","=");
$conditionals[]=array("col2","txt1","=");
$res = $consulta->selectAll('test1',$conditionals);
print_r($res);
echo "<hr>";

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
echo "<hr>";

/* es poden definir constants */

class Coche {
    const RUEDAS = 4;
}

echo Coche::RUEDAS . "\n";
$miCoche = new Coche();
echo $miCoche::RUEDAS . "\n";
echo "<hr>";

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


// https://diego.com.es/instancia-de-clases-en-php
//https://diego.com.es/programacion-orientada-a-objetos-en-php
//https://codigofacilito.com/videos/curso_git_primeros_pasos
//https://webdeasy.de/en/flexible-php-7-mysqli-database-class-download/
//https://www.php.net/manual/es/book.mysqli.php
?>