<?php
    require_once('../config/Database.class.php');

    class Produto extends Database 
    {
        private $table_name = "products";
        public $id;
        public $name;
        public $tags;
        

/* "INSERT into". $this->table_name . "(id,name,tags) 
                values (:id,:name,:tags)" */
        public function create(){
                $stmt = $this->conn->prepare("INSERT INTO
                    " . $this->table_name . "
                SET
                id=:id,name=:name,tags=:tags");


                $this->name=htmlspecialchars(strip_tags($this->name));
                $this->id=htmlspecialchars(strip_tags($this->id));
                $this->tags=htmlspecialchars(strip_tags($this->tags));


                    $stmt->bindParam(":id", $this->id);
                    $stmt->bindParam(":name", $this->name);
                    $stmt->bindParam(":tags", $this->tags);   
                    if($stmt->execute()){
                        return true;
                    }
                    return false;
        }
        
    }
    