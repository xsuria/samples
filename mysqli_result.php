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


        echo "<div class='return'><b>Fetch_all:</b><br>Tots els resultats. <b style='color:#ff0000'>Millor fetch_array no ocnsumeix tant</b> només per enviar a un alte instancia<br>";

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


        echo "<div class='return'><b>Fetch Object / Fetch Row / Fetch array / Fetch assoc:</b><br>";

        Class formatResult extends Database{
            function __construct(){
                $this->connect();
            }

            function getResult(){
                $res = mysqli_query($this->connection, "select * from pets");

                echo "<ul>";
                echo "<li>Camps: ".$res->field_count." / ".mysqli_field_count($this->connection)."</li>";
                echo "<li>Files: ".mysqli_num_rows($res)."</li>";
                echo "</ul>";
                //$res = $this->connection->query("select * from pets");
                //while ($obj = mysqli_fetch_array($res)){
                //while ($obj = mysqli_fetch_assoc($res)){
                //while ($obj = mysqli_fetch_object($res)){
                
                /*
                $row = mysqli_fetch_row($res);
                foreach ($row->lengths as $i => $val) {
                    printf("El campo %2d tiene por Largo %2d\n", $i+1, $val);
                }*/

                while ($obj = mysqli_fetch_row($res)){
                    print_r($obj);
                }


            }
        }

        $class = new formatResult;
        $class->getResult();
        echo "</div>";

        echo "<div class='return'><b>Field seek:</b><br>";

        Class filedSeek extends Database{
            function __construct(){
                $this->connect();
            }

            function seek(){
                $res = mysqli_query($this->connection,'select * from pets');
                mysqli_field_seek($res,1);
                $info = mysqli_fetch_field($res);
                print_r($info);
            }
        }

        $class = new filedSeek;
        $class->seek();
        echo "</div>";


    //$resultado->field_seek(1);
    //$info_campo = $resultado->fetch_field();


        echo "<div class='return'><b>Informació de les columnes:</b><br>";
        echo "<span><b>fetch_field_direct:</b> informació d'una columan</span>";
        Class fetch_field_direct extends Database{
            function __construct(){
                $this->connect();
            }

            function query(){
                $res = mysqli_query($this->connection,"select name,type from pets");
                $info = $res->fetch_field_direct(1);
                echo "<ul>";
                echo ("<li>Nombre:". $info->name."</li>");
                echo ("<li>Tabla:". $info->table."</li>");
                echo ("<li>Longitud:". $info->max_length."</li>");
                echo ("<li>Banderas:". $info->flags."</li>");
                echo ("<li>Tipo:". $info->type."</li>");
                echo "</ul>";    
                
                echo "<span><b>fetch_field:</b> Informació de totes les columnes</span>";
                while ($info = $res->fetch_field()) {
                    echo "<ul>";
                    echo ("<li>Nombre:". $info->name."</li>");
                    echo ("<li>Tabla:". $info->table."</li>");
                    echo ("<li>Longitud:". $info->max_length."</li>");
                    echo ("<li>Banderas:". $info->flags."</li>");
                    echo ("<li>Tipo:". $info->type."</li>");
                    echo "</ul>"; 
                }

                echo "<span><b>fetch_fields:</b> Array Informació de totes les columnes</span>";
                $info = $res->fetch_fields();
                echo "<pre>";
                print_r($info);
                echo "</pre>";

                $res->close();
            }
        }

        $class = new fetch_field_direct;
        $class->query();
        echo "</div>";


        ?>
    </div>
</html>