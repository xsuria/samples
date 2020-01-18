
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
 *              Autocaraga
 * ***********************************/
/*
Els fitxers s'han de dir igual que les classes */

echo "<p class='return'><b>Autocarga:</b><br>";

spl_autoload_register(function ($nombre_clase) {
    include "classes/".$nombre_clase . '.php';
    //throw new ExcepciónAusente("Imposible cargar $nombre_clase.");
});

$obj2  = new consulta();
echo "clase carregada";

/*try {
    $obj = new ClaseNoCargable();
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}
*/

echo "</p>";


/**************************************
 *              BASIC
 * ***********************************/

 // Podem donar valors a les variables definides.

class Animals {
    public $nom;
    public $nom2="coco";
    function retorna(){
        echo $this->nom;
    }
}

echo "<p class='return'><b>Basic:</b><br>";
$Animal = new Animals;
$Animal->nom = "Tana"; // Podem donar valors a les variables definides.
$Animal->retorna();
echo "<br>";
echo $Animal->nom2;
echo "</p>";


echo "<p class='return'><b>Final, devant de les funcions fa que les filles no les puguin sobrescriure:</b><br>";

class primera_final{
    final public function escriu(){
        echo "escriu";
    }
}

Class segona_final extends primera_final{
    /* public function escriu(){
        echo "escriur";
    }
    donara error
    */
}


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

echo "<br>Es pot accedri a propietats d'un objecte recent clonat<br>";
$dateTime = new DateTime();
echo (clone $dateTime)->format('Y');

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

echo "<br><br>Heretar constructors: quan ferm extends s'executa l'altre constructor</br>";

Class primera{
    function __construct(){
        echo "constructor primera<br>";
    }
}

Class segona extends primera{

    function __construct(){
        parent::__construct();
        echo "constructor segonsa<br>";
    }
}



Class tercera extends primera{

}

$obj = new primera;
$obj2 = new segona;
$obj3 = new tercera;


echo "<br><br>Destructors</br>";

class MyDestructableClass {
    function __construct() {
        print "En el constructor\n";
        $this->name = "MyDestructableClass";
    }
 
    function __destruct() {
        print "Destruyendo " . $this->name . "\n";
    }
 }
 
 $obj = new MyDestructableClass();


echo "</p>";



/**************************************
 *              EXTENSIÓ DE CLASSES
 * ***********************************/

echo "<p class='return'><b>Extends:</b> la funcio mare es crida amb \$this o parent<br>";

class multiplica{
    public function multi($var1,$var2){
        return $var1*$var2;
    }
}

class resta extends multiplica{
    public function rest($var1,$var2){
        echo "$var1-$var2=".($var1-$var2)."<br>";
        echo "$var1*$var2=".$this->multi($var1,$var2)."<br>"; // Com esta extesa amb this podem accedir a funcionas de l'altre.
        echo parent::multi(2,2)."<br>";
        echo $this->multi(3,3);
    }
}

$resta = new resta;
$resta->rest(5,2);
$resta->multi(5,2); // multi està dins la clase extesa multiplica



echo "<br>Diferencia ente self i estatic al cridar funcions filles, la primera crida la fucio en la propia clase mare, l'altre a la filla";

// self toranará A, ja que es crida a la seva funcio
class A {
    public static function who() {
        echo "<br>Mara<br>";
    }
    public static function test() {
        self::who();
    }
}

class B extends A {
    public static function who() {
        echo "<br>Filla<br>";
    }
}

B::test();

// crida a la funcio who de la filla
class A2 {
    public static function who() {
        echo "<br>Mare<br>";
    }
    public static function test() {
        static::who();
    }
}

class B2 extends A2 {
    public static function who() {
        echo "<br>Filla<br>";
    }
}

B2::test();


echo "</p>";


echo "<p class='return'>Abstarct: classes que no es poden instanciar, es criden les funcions des del fill<br>";


abstract class ClaseAbstracta
{
    // Forzar la extensión de clase para definir este método
    abstract protected function getValor();


    // Método común
    public function imprimir() {
        print $this->getValor() . "\n";
    }
}

class ClaseConcreta1 extends ClaseAbstracta
{
    protected function getValor() {
        return "ClaseConcreta1";
    }


}


$clase1 = new ClaseConcreta1;
$clase1->imprimir();








echo "</p>";


echo "<p class='return'><b>Interface:</b> Definexi metodes de la clase a la que esta asociada, si no es compleix torna error<br>
Permet multiples extensions amb ,";

// Declarar la interfaz 'iTemplate'
interface iTemplate
{
    public function setVariable($name, $var);
}

interface iTemplate2
{
    public function getHtml($template);
}

// Implementar la interfaz
// Ésto funcionará 
class Template implements iTemplate,iTemplate2{
  
    public function setVariable($name, $var){ // si falta o els parametres no son iguals peta

    }
  

    public function getHtml($template){ // si falta o els parametres no son iguals peta
    }

    public function grtuser(){
        
    }
}
echo "</p>";


echo "<p class='return'><b>Magic / Sobrecarrega:</b> __set, __unset, __get, __isset, __tostring, __invoke, __debugInfo<br>";

class sobrecarga{

    public $data = array();
    private $prop;

    function __construct($entra){
        $this->prop = $entra;
    }

    function __set($name, $value){
    $this->data[$name] = $value;
        print_r($this->data);
    }

    function __get($name)
    {
        return $this->data[$name];
    }

    function __isset($name)
    {
        return isset($this->data[$name]);
    }

    function __unset($name)
    {
        unset($this->data[$name]);
    }

    public function __call($name, $arguments){
        echo $name;
        print_r($arguments);
    }

    public static function __callStatic($name, $arguments){
        print_r($arguments);
    }

    public function normal(){
        echo "Normal";
    }
    
    public function __toString() // diu que ha de fer quan es tracta una classe com un string
    {
        return "__tostring: diu que ha de fer quan es tracta una classe com un string<br>";
    }

    public function __invoke($var){
        return $var." __invoke retorna quan una clase es tracta com una funcio<br>";
    }

    public function __debugInfo() {
        return [
            'propSquared' => $this->prop,
        ];
    }
 

}

$sobrecarga = new sobrecarga(9);
$sobrecarga->a = 1;
echo "<br>";
echo $sobrecarga->a;
echo "<br>";
echo isset($sobrecarga->a);
echo "<br>";
unset($sobrecarga->a);
echo "<br>";
echo $sobrecarga;
echo "<br>";
echo $sobrecarga(1);
echo "<br>__debugInfo Retorna els valors que ha de rebre<br>";
var_dump(new sobrecarga(42));

echo "<br>si cridem una funció no definida, crida _call o _callstatic<br>";
$sobrecarga->properties_travel("metode 1","metode3");
$sobrecarga->properties_travel2("metode 4","metode5");
$sobrecarga::runTest2("metode2");
$sobrecarga->normal();

echo "</p>";


echo "<p class='return'><b>Recorre Objecte:</b><br>";

Class objectes{

    public $var1 = "hola";
    public $vas2 = "adeu";
    private $var4 = "caracola";
    protected $var5 ="almeja";

    function iterateVisible() {
        foreach ($this as $clave => $valor) {
            echo "$clave --> $valor</br>";
        }
     }
}
echo "Desde fora només publiques<br>";
$objectes = new objectes;
foreach ($objectes as $key => $value ){
    echo "$key --> $value</br>";
}

echo "<br>Desde dins totes<br>";
$objectes->iterateVisible();
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

echo "<p class='return'><b>Namespaces: __NAMESPACE__  torna el nom</b><br>";

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


echo "<p class='return'><b>Namespaces a un mateix arxiu ha de ser al principi arxius:</b><br>";

/*
namespace NS {
    class NombreClase {
    }
    
    echo NombreClase::class;
}
*/
echo "</p>";

/**************************************
 *              Constants
 * ***********************************/
echo "<p class='return'><b>Constants:</b><br>";

Class Constants{

    const NOM = "kenia";

    function mostraconstant(){
        echo self::NOM;
    }

}

echo Constants::NOM . "<br>";

$Constants = new Constants;
$Constants->mostraconstant();
echo "<br>";

const NOM2 = "Coco";

Class ConstatFora{
    function mostraconstant(){
        echo NOM2;
    }
}

$ConstatFora = new ConstatFora;
$ConstatFora->mostraconstant();
echo "<br>".NOM2;

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


echo "<p class='return'><b>Saber si es instancia de un objecte instanceof :</b><br>";
echo "<ul>";

class class1 {
    
}
class class2 {
   
}

$a = new class1;

$v1 = $a instanceof class1;
$v2 = $a instanceof class2;

echo "<li>Si la var es instancia (instanceof) de class: $v1 / $v2 </li>";

echo "</ul></p>";


echo "<p class='return'><b>Comparar objectes :</b><br>";

class clase1{

    public $var=1;
}

class clase2{
    public $var=1;
}

function bool2str($bool)
{
    if ($bool === false) {
        return 'FALSO';
    } else {
        return 'VERDADERO';
    }
}

function compara(&$o1, &$o2){
    echo 'o1 == o2 : ' . bool2str($o1 == $o2) . "<br>";
    echo 'o1 != o2 : ' . bool2str($o1 != $o2) . "<br>";
    echo 'o1 === o2 : ' . bool2str($o1 === $o2) . "<br>";
    echo 'o1 !== o2 : ' . bool2str($o1 !== $o2) . "<br>";
}


$o1 = new clase1();
$o2 = new clase1();
$o3 = new clase2();

compara($o1,$o2);

//compara($o1,$o3);

echo "</p>";


# https://diego.com.es/instancia-de-clases-en-php
//https://diego.com.es/programacion-orientada-a-objetos-en-php
//https://codigofacilito.com/videos/curso_git_primeros_pasos
//https://webdeasy.de/en/flexible-php-7-mysqli-database-class-download/
//https://www.php.net/manual/es/book.mysqli.php
?>

</div>
</html>