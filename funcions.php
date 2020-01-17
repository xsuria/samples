<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
        <h1>Funcions</h1>
        
       

        <?php 
        require_once('classes/variable.php'); 
        require_once('classes/database.php');

        $a = funct();

        
       

        echo "<div class='return'><b>Crida de funcions </b>";
        echo "<ul>";
        echo "<li>Es pot cridar una funcio encara no definida si no està dins d'un if: $a</li>";
        echo "</ul>";
        echo "</div>";

        function funct(){
            return "Cridada";
        }


        echo "<div class='return'><b>Funcions per referencia, modifica el valor de fora</b>";

 
        function añadir_algo(&$cadena){
            $cadena .= 'y algo más.';
        }
        $cad = 'Esto es una cadena, ';
        añadir_algo($cad);

        echo "<ul>";
        echo "<li>El valor concatenat es: $cad</li>";
        echo "</ul>";
        echo "</div>";


        echo "<div class='return'><b>Número indeterminat de parametres a enviar</b> <br>Ho tractara com un array";

 
        function suma(...$vals){    
            $res = 0;
            foreach ($vals as $valor){
                $res+=$valor;
            }
            return $res;
        }
       
        echo "<ul>";
        echo "<li>valor: ".suma(1,2,3,4)."</li>";

        function add($a, $b) {
            return $a + $b;
        }
        
        $res2 =  add(...[1, 2])."\n";

        echo "<li>Alternativa valor2: ".$res2."</li>";
        
        $a = [1, 2];
        $res3 =  add(...$a);
        echo "<li>Alternativa valor3: ".$res3."</li>";

        function sum() {
            $acc = 0;
            foreach (func_get_args() as $n) {
                $acc += $n;
            }
            return $acc;
        }
        
        $res4 =  sum(1, 2, 3, 4);
        echo "<li>Versions antigues php : ".$res4."</li>";
        echo "</ul>";
        echo "</div>";



        echo "<div class='return'><b>Passar classe a funcions</b> <br>";

        class C {
            public $vari = "hola";

            function tornanum($num){
                return $num;
            }
        }
        class D extends C {}
        class E {}

        function f(C $class,$param) {
            return  $class->tornanum($param)."->".$class->vari; 
        }

        $r1 = f(new C,1);
        $r2 = f(new D,1);
        //$r3 = f(new E); error
 
        echo "<ul>";
        echo "<li>Resultat de clase pp C: $r1</li>";
        echo "<li>Resultat de clase extesa D: $r2</li>";
        echo "<li>Resultat de clase suelts E: error</li>";
        echo "</ul>";
        echo "</div>";


        echo "<div class='return'><b>Tornar parametres</b> <br>"; 
        echo "<ul>";

        function números_pequeños(){
            return array (0, 1, 2);
        }
        list ($cero, $uno, $dos) = números_pequeños();

        echo "<li>Tornar aprametes d'un arrray amb list $cero, $uno, $dos</li>";

        function &devolver_referencia($algunaref)
        {
            return $algunaref;
        }
        $nuevaref="hola";
        $nuevaref =& devolver_referencia('caracola');

        echo "<li>Tornar referencies &: $nuevaref</li>";

        function sum2($a, $b): float {
            return $a + $b;
        }

        $res = sum2(1,2);

        echo "<li>Força el tipus de sortida, si no error: $res </li>";

        //declare(strict_types=1);

        function sum3($a, $b): int {
            return $a + $b;
        }

        $res = (sum3(1, 2));

        echo "<li>Força el tipus d'entrada a la funció, strict_types (la primera linea al script i l'afecta a tot (comentat): $res </li>";

        class F {}
        function getCLASS(): F {
            return new F;
        }

        echo "<li>Tornar un objecte (class):". var_dump(getCLASS())."</li>";


        echo "</ul>";
        echo "</div>";

        echo "<div class='return'><b>Funcions varibles</b> <br>"; 
        echo "<ul>";

        Class retornaFuncio{

            public $parametre;

            public function __construct($parametre){
                $this->parametre = $parametre;
            }

            public function retornaFuncioAsociada(){
                if ($this->parametre == 1):
                    return "funcio1";
                else:
                    return "funcio2";
                endif;
            }
        }

        function funcio1(){
            return "funcio1";
        }

        function funcio2(){
            return "funcio2";
        }

        $retornaFuncio = new retornaFuncio(1);
        $func = $retornaFuncio->retornaFuncioAsociada();
        $res = $func();

        echo "<li>Crida d'una funció per mitja d'una variable:  $res</li>";

        class Foo
        {
            function Variable()
            {
                $nombre = 'Bar';
                $this->$nombre(); // Esto llama al método Bar()
            }
        
            function Bar()
            {
                echo   "funcio BAR";
            }
        }
        
        $foo = new Foo();
        $nombrefunc = "Variable";
        $res = $foo->$nombrefunc();  // Esto llama a $foo->Variable()

        echo "<li>Crida d'una funció per mitja d'una variable a una clase:</li>";

        
        class Foo2
        {
            static function bar()
            {
                echo "bar\n";
            }
            function baz()
            {
                echo "baz\n";
            }
        }
        
        echo "<li>Cridar funcions d'una class";

        $func = array("Foo2", "bar");
        $func(); // imprime "bar"
        $func = array(new Foo2, "baz");
        $func(); // imprime "baz"
        $func = "Foo2::bar";
        $func(); // imprime "bar" a partrid de PHP 7.0.0; antes, emitía un error fatal
        echo "</li>";


        echo "</ul>";
        echo "</div>";



        echo "<div class='return'><b>Funcions anonimes</b> <br>"; 
        echo "<ul>";

        $res =preg_replace_callback('~-([a-z])~', function ($coincidencia) {
            return strtoupper($coincidencia[1]);
        }, 'hola-mundo');

        echo "<li>Mètode funció anonima 1: $res</li>";


        $saludo = function($nombre)
        {
            return "Hola $nombre";
        };
        
        $res = $saludo('Mundo');
        echo "<li>Mètode funció anonima 2: $res</li>";

        $mensaje = "hola";
        $ejemplo = function ($arg) use ($mensaje) {
            return "$arg $mensaje";
        };
        $res = $ejemplo("hola");
        echo "<li>Mètode funció anonima 3: $res</li>";

        $mensaje = "casa";
        $res = $ejemplo("hola");
        echo "<li>Reinicia missatge: $res</li>";

        echo "</ul>";
        echo "</div>";
        ?>
    </div>
</html>