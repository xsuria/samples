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
        echo "</ul>";
        echo "</div>";


        

        ?>
    </div>
</html>