<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
        <h1>Classes</h1>

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
        if (mysqli_connect_error())	{
            echo "ERROR:".mysqli_connect_error();
            exit();
        }else{
            echo "conectat<BR>";
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
    }

}

$commit = new commit;
//$commit-> insertCommit();
echo "</p>";


echo "<div class='return'><b>Informació opcions de les ultimes consultes:</b><br>";
Class infoConsult extends connection{
    function __construct(){
        $this->connect();
    }

    function update(){
        echo "<ul><li>Canvia la connexió a la base de dades: 1</li>";
        echo "<li>Charset de la bbdd:".$this->connection->character_set_name()."</li>";

        $this->connection->change_user("root", "xavisegur", "laboratory");
        $this->connection->query("update pets set name='".date('Ymdhis')."' where id=1");
        echo "<li>Files afectades:".$this->connection->affected_rows."</li>";
        
        $this->connection->query("update pets2  set name='".date('Ymdhis')."' where id=1");
        echo "<li>Codi error:".$this->connection->errno."</li>";
        
        echo "<li>Descripcio Error:".$this->connection->error."</li>";
        echo "<li>Verssio llibreria mysql: ".mysqli_get_client_info()."</li>";
        echo "<li>Verssio  mysql: ".mysqli_get_server_info($this->connection)."</li>";
         

        echo "<li>Files afectades:".$this->connection->affected_rows."</li>";
        echo "</ul>";

        echo "Array Errors:";
        echo "<pre>";
        print_r($this->connection->error_list);
        echo "<pre>";

        echo "Charset de la bbdd:";
        echo "<pre>";
        print_r(mysqli_get_charset($this->connection));
        echo "<pre>";

     


    }


}

$info = new infoConsult;
$info->update();
echo "</div>";

//$mysqli->insert_id


?>
