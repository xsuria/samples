<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
    <h1>Assignacions</h1>
    <?php
    
    echo "<p class='return'><b>Assigancio simple:</b><br>";

    $a=1;
    $a =& $b;
    $b=2;
    echo $b;
    echo $a;
    echo "</p>";


    echo "<p class='return'><b>Assigancio en un foreach, ultim valor:</b><br>";
    $ref = 0;
    $fila =& $ref;
    foreach (array(1, 2, 3) as $fila) {
        // hacer algo
    }
    echo $ref; // 3 - último elemento de la matriz iterada
    echo "</p>";

    echo "<p class='return'><b>Assigancio en arrays:</b><br>";
    $a = 1;
    $b = array(2, 3);
    $arr = array(&$a, &$b[0], &$b[1]);
    $arr[0]++; $arr[1]++; $arr[2]++;
    print_r($b);
    print_r($a);
    echo "</p>";

    echo "<p class='return'><b>Assigancio en funcions:</b><br>";
    function foo(&$var)
    {
        $var++;
    }

    $a=5;
    foo($a);
    echo $a;
    echo "</p>";

    echo "<p class='return'><b>Retornar assignaciosn classes fubcions:</b><br>";

    class foo {
        public $valor = 42;
    
        public function &obtenerValor() {
            return $this->valor;
        }
    }
    
    $obj = new foo;
    $miValor = &$obj->obtenerValor(); // $miValor es una referencia a $obj->valor, que es 42.
    $obj->valor = 2;
    echo $miValor;  
    
    
    function &collector() {
        static $collection = array();
        return $collection;
      }
      $collection = &collector();
      $collection[] = 'foo';
      print_r($collection);


    echo "</P>";

    echo '¡Mi nombre de usuario es ' . $_ENV["USER"] . '!';


    ?>

    </div>
</html>