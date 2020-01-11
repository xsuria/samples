<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
        <h1>Mysqli Result</h1>
        
       

        <?php 
        require_once('classes/variable.php'); 
        require_once('classes/database.php');

       

        echo "<div class='return'><b>Continue / break </b><br>Salta al següent de la estructura";
        echo "<ul>";
        echo "<li>resultat: ";
        
        for ($x=1;$x<=10;$x++){
            if ($x==2){continue;}
            if ($x==5){break;}
            echo $x;
        }
        echo "</li>";
        echo "</div>";

        echo "<div class='return'><b>Do while</b><br>com a minim fa la primera";
        echo "<li>resultat: ";
        $x=0;
        do{
            echo $x;
            $x++;
        }while ($x<5);
        echo "</li>";
        echo "</ul>";
        echo "</div>";

        echo "<div class='return'><b>switch</b> sense breake entra a tots<br>";
        echo "<li>resultat: ";
        $x=0;
        switch($x){
            case 0:
                echo "entra";
            break;
            case 1:
                echo "entra2";
            break;
            default:
                echo "def";
        }
        echo "</li>";
        echo "</ul>";
        echo "</div>";

        echo "<div class='return'><b>declare</b> (comentat) executa la funcio especifica cada cop que hi ha una instrucció php<br>";
        echo "<li>resultat: ";

        declare(ticks=3); // a partir de quina execucio

        // Una función llamada en cada evento tick
        function funcio($val)// primera execucio
        {
            //echo $val."-"; // COMENTAT
        }
        register_tick_function('funcio',0);  //2a execucio

        $a=1; // 3a execucio
        $a=2; // 4a execucio
        
        
        echo "</li>";
        echo "</ul>";
        echo "</div>";


        echo "<div class='return'><b>goto </b>Salta a una part del codi amb etiqueta 'etiqueta:'<br>";

        goto b;
        $a=1;

        b:
        $a=2;


        echo "<li>resultat: $a</li>";
        echo "</ul>";
        echo "</div>";

        ?>
    </div>
</html>