<?php
    require_once('../config/Database.class.php');

    class Produto extends Database 
    {
        private $table_name = "products";
        public $id;
        public $name;
        public $tags;

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
        
        public function read()
        {
            $stmt = $this->conn->prepare("SELECT *  from products where id=".$this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC); 

            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->tags = $row['tags']; 
        }

        public function read_name($name)
        {
            
          try {

              $stmt = $this->conn->prepare("SELECT * from  products where name ='{$name}'");
              $stmt->execute();
              $listaDeProdutos = $stmt->fetchAll(PDO::FETCH_ASSOC);  
    
            return $listaDeProdutos;
            
          } catch (\Throwable $th) {
            echo "deu ruim".$th->getMessage();
          }
        }

    }
    