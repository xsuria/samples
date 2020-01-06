    <html>
        <?php include("top2.inc.php")?>
        <div style="width: 800px; padding:20px;">
            <h1>Mysqli</h1>

<?php 

echo "<p class='return'><b>Connexió a la base de dades: (mysqli_connect_error())</b><br>";

Class Connection{
    var $host   = "localhost"; //database server
    var $user     = "root"; //database login name
    var $pass     = "xavisegur"; //database login password
    var $database = "laboratory"; //database name

    public $connection;

    public function connect(){
        $this->connection = new mysqli($this->host,$this->user,$this->pass,$this->database);
        $this->connection->set_charset("utf8"); 
        if (mysqli_connect_error())	{
            echo "ERROR:".mysqli_connect_error();
            exit();
        }else{
            //echo "conectat<BR>";
            //print_r($this->connection);
        }
    }
    public function close_connection(){
        mysqli_close($this->connection);
    }

}

$conn = new connection();
$conn->connect();
echo "</p>";

echo "<p class='return'><b>Simple Select:</b><br>";
Class simpleselect extends connection{

     public function __construct(){
        $this->connect();
    }

    public function select(){
        $query = mysqli_query($this->connection, "select * from pets");
        $resultat = mysqli_fetch_assoc($query);
        echo "Resultats:".$this->connection->field_count."<br>";
        echo "Escapa caracters especiasl l'altre -> ". $this->connection->real_escape_string("l'alter")."<br>";
        return $resultat;
    }
}

$simpleselect  = new simpleselect;
$res = $simpleselect->select();



print_r($res);
echo "</p>";

echo "<p class='return'><b>Simple insert / last_insert_id:</b><br>";
Class Insert extends connection{
    public $name;
    public $color;
    public $type;
    
    function __construct($name,$color,$type){
        $this->name = $name;
        $this->color = $color;
        $this->type = $type;
        $this->connect();
    }

    function query(){
        $conn = $this->connection;
        $conn->query("insert into pets (name,color,type) values ('$this->name','$this->color','$this->type')");
        $lastId = $this->connection->insert_id;
        $conn->query("delete from pets where id=$lastId");
        $conn->close();
    }
}

$insert = new Insert('Kenia','White','Dog');
$insert->query();
$res2 = $simpleselect->select();
print_r($res2);
echo "</p>";

echo "<p class='return'><b>Commit / rollback (nomes a innoDB):</b><br>";

Class commit extends connection{

    function __construct(){
        $this->connect();
    }

    function insertCommit(){

        $this->connection->autocommit(false);
        $all_query_ok=true;
        $this->connection->query("insert into pets (name,color,type) values ('Nil','Black','cat')");
        echo "totes ok".$all_query_ok;
        $this->connection->commit(); 
        mysqli_rollback($this->connection); 
        $this->connection->close();
    }

}

$commit = new commit;
//$commit-> insertCommit();
echo "</p>";


echo "<div class='return'><b>Contorl d'errors:</b><br>";
Class errorControl extends connection{
    function __construct(){
        $this->connect();
    }

    function retornaErrors(){
        mysqli_query($this->connection, "insert into table (a) values ('a')");
       
        echo "<li>Codi error:".$this->connection->errno."</li>";
        echo "<li>Descripcio Error:".$this->connection->error."</li>";
        echo "<li>Error SQLESTATE: ".$this->connection->sqlstate."</li>";
        echo "<li>Número de warnings: ".$this->connection->warning_count."</li>";
        
        echo "Array Errors: (<b>comentat</b>)";
        echo "<pre>";
        //print_r($this->connection->error_list);
        echo "<pre>";

        if (mysqli_warning_count($this->connection)) {
            $e = mysqli_get_warnings($this->connection);
            do {
                echo "Warning: $e->errno: $e->message\n";
            } while ($e->next());
         }

         $this->connection->close();

    }
}

$errorControl = new errorControl;
$errorControl->retornaErrors();
echo "</div>";

echo "<div class='return'><b>Informació opcions de les ultimes consultes:</b><br>";

Class infoConsultes extends connection{

    function __construct(){
        $this->connect();
    }

    function infoConsulta(){
        mysqli_query($this->connection,"update pets set name='".date('Ymdhis')."' where id=1");
        $cad= "<ul>";
        $cad.= "<li>Files afectades:".$this->connection->affected_rows."</li>";
        $cad.= "<li>Info última consulta:".mysqli_info ( $this->connection )."</li>";
        $cad.= "</ul>";
        $this->connection->close();
        return $cad;
    }

}
$info = new infoConsultes;
echo $info->infoConsulta();
echo "</div>";

echo "<div class='return'><b>Multiquerys</b><br>store_result() guarda el resultat";
Class MultiQuery extends connection{
    function __construct(){
        $this->connect();
    }

    function multiQuery(){
        $query = "select name from  pets  where id=1;";
        $query.= "select name from  pets  where id=2";
        echo "<ul>";
        if ($this->connection->multi_query($query)) {
            do {
                /* almacenar primer juego de resultados */
                if ($result = $this->connection->store_result()) {
                    while ($row = $result->fetch_row()) {
                        echo "<li>$row[0]</li>";
                    }
                    $result->free();
                }
                /* mostrar divisor */
                if ($this->connection->more_results()) {
                    printf("-----------------\n");
                }
            } while ($this->connection->next_result());
        }
        echo "</ul>";
        $this->connection->close();

    }
}

$query = new MultiQuery;
$query->multiQuery();
echo "</div>";

echo "<div class='return'><b>Prepare: tambi es pos fer amb stmt_init()</b><br>";

Class Prepare extends connection{

    public $name = "Nil";
    public $name2 = "Kenia";

    function __construct(){
        $this->connect();
    }

    function preparequery(){
        // tambi es pos fer amb stmt_init()
        $query = $this->connection->prepare("SELECT type FROM pets WHERE name=(?)");
        
        $query->bind_param("s", $this->name);
        $query->execute();
        $query->bind_result($type);
        $res = $query->fetch();

        $query->bind_param("s", $this->name2);
        $query->execute();
        $query->bind_result($type2);
        $res2 = $query->fetch();

        echo "<ul>";
        echo "<li>".$type."</li>";
        echo "<li>".$type2."</li>";
        echo "</ul>";



    }
}

$prep = new Prepare;
$prep->preparequery();
echo "</div>";

echo "<div class='return'><b>Informació connexions i bbdd</b><br>";
Class infoConsult extends connection{
    function __construct(){
        $this->connect();
    }

    function update(){
        
        echo "<ul><li>Canvia la connexió a la base de dades: 1</li>";
        echo "<li>Charset de la bbdd:".$this->connection->character_set_name()."</li>";
        $this->connection->change_user("root", "xavisegur", "laboratory");
        $this->connection->query("update pets set name='".date('Ymdhis')."' where id=1");        
        echo "<li>Verssio llibreria mysql: ".mysqli_get_client_info()."</li>";
        echo "<li>Verssio  mysql: ".mysqli_get_server_info($this->connection)."</li>";
        echo "<li>Estat del sistema: ".$this->connection->stat()."</li>";
        echo "<li>Id de la connexió: ".$this->connection->thread_id."</li>";

      
        if ($this->connection->ping()) {
            echo ("<li>Si la connexió esta ok si no reconnecta: ¡La conexión está bien!</li>");
        } else {
            echo ("<li>Error".$mysqli->error.'</li>');
        }
        echo "</ul>";

        

        echo "Charset de la bbdd: (<b>comentat</b>)";
        echo "<pre>";
        //print_r(mysqli_get_charset($this->connection));
        echo "<pre>";

        echo "Estadistiques de la connexio (<b>comentat</b>):";
        echo "<pre>";
        //print_r(mysqli_get_connection_stats($this->connection));
        echo "<pre>";

    }


}

$info = new infoConsult;
$info->update();
echo "</div>";

//$mysqli->insert_id


?>
</div>
</html>