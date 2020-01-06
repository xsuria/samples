<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
        <h1>Mysqli stmt</h1>

        <?php 
            require_once('classes/variable.php'); 
            require_once('classes/database.php');
        ?>
        <?php
        echo "<div class='return'><b>Informació opcions de les ultimes consultes:</b><br>bind_param envia la variable:<br> i --> integer
        <br>d --> double<br>
        s-->string<br>
        b-->blob";
        Class UpdateQuery extends Database{
           
           public $id = 1;
            function __construct(){
                $this->connect();
            }   
            
            function updateTable(){
                $query = "update pets set name='".date("Ymdhis")."' where id=(?)";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("i", $this->id);
                $stmt->execute();   
                
                echo "<ul>";
                echo "<li>Files afectades: ".$stmt->affected_rows."</li>";
                echo "</ul>";
                $stmt->free_result();
                $stmt->close();

            }
        }

        $update = new UpdateQuery;
        $update->updateTable();
        echo "</div>";

        echo "<div class='return'><b>Consulta:</b>";

        Class consulta extends Database{
            function __construct(){
                $this->connect();
            }

            function consulta(){
                $query = "select name from pets";
                $stmt = mysqli_prepare($this->connection, $query);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $name);
               //un resultat  mysqli_stmt_fetch($stmt);
                echo "<ul>";
                //echo "Resultats: ".$name;
                echo "<li>Num resultats: ".mysqli_stmt_field_count ($stmt)."</li>";
                while (mysqli_stmt_fetch($stmt)) {
                    printf ("<li>%s</li>", $name);
                }
                echo "</ul>";
                
                mysqli_stmt_free_result($stmt);
                mysqli_stmt_close($stmt);

            }

        }

        $class = new consulta;
        $class->consulta();
        echo "</div>";

        echo "<div class='return'><b>get_result: n consultes 1 prepare:</b>";

        Class multiple extends Database{

            function __construct(){
                $this->connect();
            }

            function multi(){
                $query = "select * from pets where name=?";
                $stmt = mysqli_prepare($this->connection, $query);
                mysqli_stmt_bind_param($stmt, "s", $name);
                $names = array("Kenia","Nil","coco");
                foreach ($names as $name){
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result ($stmt);
                    while ($fila = $result->fetch_assoc()){
                        print_r($fila);
                    }
                    
                }

                echo "<li>Parametrs enviats: ".mysqli_stmt_param_count ($stmt)."</li>";
                mysqli_stmt_free_result($stmt);
                mysqli_stmt_close($stmt);

            }

        }

        $class = new multiple;
        $class->multi();

        echo "</div>";


        echo "<div class='return'><b>Insert multiples values:</b>";

        Class multipleInsert extends Database{

            function __construct(){
                $this->connect();
            }

            function insertQuery($name,$type,$color){
                $query = "insert into pets (name,color,type) values (?,?,?)";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("sss", $v1,$v2,$v3);

                $v1 = $name;
                $v2 = $type;
                $v3 = $color;

                $stmt->execute();

                echo "<ul>";
                echo "<li>Id ultim insert: ".mysqli_stmt_insert_id($stmt)."</li>";
                echo "</ul>";
                mysqli_query($this->connection,"delete from pets where id=".mysqli_stmt_insert_id($stmt));

                mysqli_stmt_free_result($stmt);
                mysqli_stmt_close($stmt);

            }

        }

        $insert = new multipleInsert;
        $insert->insertQuery('coco','dog','wrong');
        echo "</div>";

        echo "<div class='return'><b>Torna una fila concreta del llistat de resultats: (store_results)</b>";

        Class goFileQuery extends Database{

            function __construct(){
                $this->connect();
            }

            function consulta(){
                $query ="select name,type from pets";
                //$stmt = $this->connection->prepare($query);
                $stmt = mysqli_prepare($this->connection, $query);
                mysqli_stmt_execute($stmt);
                //$stmt->execute();
                mysqli_stmt_bind_result($stmt, $name, $type);
                //$smtp->bind_result($stmt, $name, $type);
                mysqli_stmt_store_result($stmt);

                mysqli_stmt_data_seek($stmt, 2);
                mysqli_stmt_fetch($stmt);

                echo "<ul>";
                echo "<li>Anar a una fila concreta:".$name."-".$type."</li>";
                echo "</li>";

                mysqli_stmt_free_result($stmt);
                mysqli_stmt_close($stmt);

            }
        }

        $res = new goFileQuery;
        $res->consulta();
        echo "</div>";

    
        echo "<div class='return'><b>Control d'errors:</b>";

        Class errorControl extends Database{
            function __construct(){
                $this->connect();
            }

            function update(){

                mysqli_query($this->connection, "CREATE TABLE pets2 LIKE pets");

                $query ="select * from pets2";

                $stmt = mysqli_prepare($this->connection, $query);

                mysqli_query($this->connection, "DROP TABLE pets2");

                mysqli_stmt_execute($stmt);
                
                //echo $stmt->errno;
                echo "<ul>";
                echo "<li>".mysqli_stmt_errno($stmt)."</li>";
                echo "<li>Error list (comentat)";/*print_r(mysqli_stmt_error_list($stmt))*/echo "</li>";

                echo "<li>List warnings: ".mysqli_stmt_get_warnings($stmt)."</li>";
                echo "</ul>";

                mysqli_stmt_free_result($stmt);
                mysqli_stmt_close($stmt);
 

            }
        }
        
        $class = new errorControl;
        $class->update();
        echo "</div>";

    ?>
    </div>
</html>