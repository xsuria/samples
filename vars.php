
<?php
error_reporting(E_ALL ^ E_NOTICE);
?>
<html>
        <?php include("top2.inc.php")?>
        <div style="width: 800px; padding:20px;">
            <h1>Variables</h1>

<?php 

echo "<div class='return'><b>General</b><br>Nomes vars<br>";

$var1 = "Coco";
$var2 = "Kenia";

echo "<ul>";
echo "<li>Definim les dos variables per separat: $var1 , $var2</li>";



$var1 =&$var2;
$var5 = $var5+5;
$var6.="Nil";
$var1 = "Tana";
echo "<li>Assignades amb &: $var1 , $var2</li>";
echo "<li>Var no definida ".var_dump($var3)."</li>";
echo "<li>Es pot concatenar o sumar indefinides, el primer agafa valor i el segon ho suma  a 0:  $var5, $var6</li>";
echo "<li>No cal definir arrays ni objectes</li>";
echo "</ul>";
echo "</div>";

echo "<div class='return'><b>Ambit</b><br>Nomes vars<br>";
echo "<ul>";
$var1 = "Coco";

function mostra(){
    return $var1;
}

function mostra2(){
    global $var1;
    return $var1;
}

function mostra3(){
    return $GLOBALS['var1'];
}

function mostra4(){
    static $a=1;
    $a++;
    return $a;

}

$a = 'hola';
$$a = 'mundo';

$n1=$n2=5;

function doble($num){
    return $num*2;
}

echo "<li>Definim com var fora del array: Null".mostra()."</li>";
echo "<li>Definim global dins array: ".mostra2()."</li>";
echo "<li>Definim global dins array: ".mostra3()."</li>";
echo "<li>Amb static persisteix dins del array: ".mostra4()." ".mostra4()."</li>";
echo "<li>Creacio dinamica de vars \$\$foo: $a , $hola</li>";
echo "<li>Creacio dinamica de vars \$\$foo: $a,  {${$a}}</li>";
echo "<li>Definicio Constants define(\"FOO\",     \"something\");</li>";
echo "<li>++\$foo o \$foo++: ".doble(++$n1)." / ".doble($n2++)."</li>";

echo "<ul>";
echo "</div>";

?>

</div>
</html>