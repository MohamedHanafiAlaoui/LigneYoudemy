<?php

require( __DIR__ . "/../class/tags.php");



class crudtags
{

   private $conn;

   public function __construct()
   {
    $this->conn=Conte_db::getConnection()->getConn();

   }

   public function get_tags()
   {
      try {
         $query ="SELECT * FROM tags";
         $stmt= $this->conn->prepare($query);
         $stmt->execute();

         $tagsdata = $stmt-> fetchAll(PDO::FETCH_ASSOC);

         $tags=[];

         foreach ($tagsdata as $Data) {
            $tags[]=new tags($Data['id_tag'],$Data['name_tag']);
         }

         return $tags;
      } catch (PDOException $e) {
         echo "Error: " . $e->getMessage();

         return [];
      }
   }


   public function newtags(tags $tags)
   {
   

      try 
      {

        $query = "INSERT INTO tags (name_tag) 
               VALUES (:name_tag)";
        $stmt = $this -> conn->prepare($query);
        $name_tag=$tags->getname_tag();

        $stmt->bindParam(':name_tag',$name_tag);
        $stmt->execute();
          return true;
      } 
      catch (PDOException $e) {
          error_log("Database error: " . $e->getMessage());
          throw new Exception("An error occurred while saving the user: " . $e->getMessage());
      }

   }


   public function DELETEtags(tags $tags)
   {
   

      try 
      {

        $query = "DELETE FROM tags WHERE tags.id_tag =:id_tag ";
        $stmt = $this -> conn->prepare($query);
        $id_tag=$tags->getid_tag();

        $stmt->bindParam(':id_tag',$id_tag);
        $stmt->execute();
          return true;
      } 
      catch (PDOException $e) {
          error_log("Database error: " . $e->getMessage());
          throw new Exception("An error occurred while saving the user: " . $e->getMessage());
      }

   }


}


            