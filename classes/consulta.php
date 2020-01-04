<?php
Class consulta extends Database{

    public function selectAll($table, $conditionals=array()){
        $this->connect();
    
        foreach ($conditionals as $key => $value){  
            
            $column = $value[0];
            $var = $value[1];
            $operator = $value[2];
    
            if (gettype($var)=="string"){
                $query_conditional[]=$column.$operator."'".$var."'";
            }else{
                $query_conditional[]=$column.$operator.$var;
            }
        }
    
        $where="";   
        $count=0;     
        foreach ($query_conditional as $key => $value){
            if ($count==0){
                $where.="where $value";
            }else{
                $where.="and $value";
            }
            $count++;
        }
    
        echo $this->returnVar();  // fa referencia a una funcio d'una clase extesa a database

        $query = mysqli_query($this->connection,"select * from $table $where");
        $resultat = mysqli_fetch_assoc($query);
        $this->close_connection();
        return $resultat;
    }


}
?>