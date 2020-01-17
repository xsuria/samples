<html>
        <?php include("top2.inc.php")?>
        <div style="width: 800px; padding:20px;">
            <h1>Nmespaces</h1>

<?php 

include("classes/namespace.php");

$class = new espai\xavi\Mostra;
$class->escriu();
echo "<br>";
echo espai\xavi\NAME;
echo "<br>";
echo "<hr>";
use espai\xavi;

$class2 = new xavi\Mostra;
$class2->escriu();
echo "<hr>";

use espai\xavi as miespace;

$class3 = new miespace\Mostra;
$class3->escriu();
echo "<hr>";

use function espai\xavi\escriu2;
escriu2();


?>

</div>
</html>