<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
        <h1>Mysqli Result</h1>

        <?php 
        require_once('classes/variable.php'); 
        require_once('classes/database.php');

        echo "<div class='return'><b>Last Position:</b><br>seveix per fer un seek del fetch_field (columnes de la taula)<br>";

        Class lastPosition extends Database{

            function __construct(){
                $this->connect();
            }

            function lastposition(){
                $result = mysqli_query($this->connection,"select * from pets limit 2");
                echo "<ul>";
                while ($finfo = mysqli_fetch_field($result)) {
                    $currentfield = mysqli_field_tell($result);
                    echo "<li>Posició: ".$currentfield."-->Nom:".$finfo->name."</li>";
                }
                echo "</ul>";
                mysqli_free_result($result);
            }
            

        }

        $class = new lastPosition;
        $class->lastposition();
        echo "</div>";

        echo "<div class='return'><b>Seek:</b><br>Anar a una fila<br>";

        Class seek extends Database{
            function __construct(){
                $this->connect();
            }

            function fseek($pos){
                $result = mysqli_query($this->connection, "select * from pets");
                $result->data_seek($pos);
                $row = $result->fetch_row();
                print_r($row);
            }
        }

        $class = new seek;
        $class->fseek(2);
        echo "</div>";


        echo "<div class='return'><b>SeFetch_all:</b><br>Tots els resultats. <b style='color:#ff0000'>Millor fetch_array no ocnsumeix tant</b> només per enviar a un alte instancia<br>";

        Class fetch_all extends Database{
            function __construct(){
                $this->connect();
            }

            function fall(){
                $results = mysqli_query($this->connection, "select * from pets");
                $results->fetch_all(MYSQLI_NUM); // MYSQLI_ASSOC, MYSQLI_NUM, MYSQLI_BOTH
                foreach($results as $result){
                    print_r($result); 
                    echo "<br>";
                }
                
               
            }
        }

        $class = new fetch_all;
        $class->fall();
        echo "</div>";

        ?>
    </div>
</html>