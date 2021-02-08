<?php
namespace DataBase;
require_once (realpath(dirname(__FILE__)."/CreateDB.php"));
use DataBase\CreateDB;
// require_once ("jdf.php");
use DateTime;
use PDO;
use PDOException;

class DataBase{
    private $connection;
    private $option = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8");
    private $databasehost = "localhost";
    private $databasename = "Your_database";
    private $username = "Your_username";
    private $password = "Yourpassword";

    function __construct()
    {
        try{
        $this->connection = new PDO("mysql:host=".$this->databasehost.";dbname=".
        $this->databasename,$this->username,$this->password,$this->option);
       }
       catch(PDOException $e){
           echo "<div style='color:red; font-size:20px;'><p>there is some problem a 🤔 i found:</p></div>".$e->getMessage();
          
       }

    }
    public function select ($sql,$values=NULL)
    {
        try {
            if($values == NULL){
                return $this->connection->query($sql);
            }
            else{
                $query = $this->connection->prepare($sql);
                $query->execute($values);
                $result = $query;
                return $result;
            }
            

        } catch (PDOException $e) {
            echo "<div style='color:red; font-size:20px;'><p>there is some problem b 🤔 i found:</p></div>".$e->getMessage();
            return false;
            

        }

    }


    
    public function update($tablename,$fields,$values,$id)
    {    

        $sql ="UPDATE `".$tablename."` SET ";

        foreach(array_combine($fields,$values) as $field=>$value){
           if ($values) {
            $sql .=" `" . $field . "`= ? ,";
           }
           else{
               $sql .="`" . $field . "`=NULL,";
           }

        }
        $sql .= "updated_at = now()";
        $sql .= " WHERE `id` = ?";

        try{

            $query = $this->connection->prepare($sql);
            $affectedrows = $query->execute(array_merge(array_filter(array_values($values)),[$id]));

            if (isset($affectedrows)) {
                return true;
            }

        }
        
        catch (PDOException $e) {
            echo "<div style='color:red; font-size:20px;'><p>there is some problem b 🤔 i found:</p></div>".$e->getMessage();
            return true;      
        }
      
    }

    public function delete($tablename,$id)
    {
        try {

            $sql ="DELETE FROM ".$tablename." WHERE `id` = ?";
            $query = $this->connection->prepare($sql);
            $affectedrows = $query->execute([$id]);
            if(isset($affectedrows)){
                return true;
            }
        
        }
         catch (PDOException $e)
          {
            echo "<div style='color:red; font-size:20px;'><p>there is some problem  d 🤔 i found:</p></div>".$e->getMessage();
            return false;
        }
    }


    public function insert($tablename,$fields,$values)
    {
        try {
            // jdate('Y-n-j','','','Asia/Tehran','en') 
            // jdate('H:i:s','','','Asia/Tehran','en')
            $sql = "INSERT INTO ".$tablename."(".implode(',',$fields).",created_at) VALUES( :" . implode(', :',$fields).", now() )";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array_combine($fields,$values));
           return true;
           
        } catch (PDOException $e) {
            echo "<div style='color:red; font-size:20px;'><p>there is some problem  e 🤔 i found:</p></div>".$e->getMessage();
            return false;
            
        }

    }

    public function createTable($sql)
    {
        try {
            $this->connection->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo "<div style='color:red; font-size:20px;'><p>there is some problem f  🤔 i found:</p></div>".$e->getMessage();
            return false; 
        }
    }

}










?>