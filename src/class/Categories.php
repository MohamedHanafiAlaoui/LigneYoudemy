<?php

require "conte_db.php";



class Categories
{
   private $id_categories;
   private $namecategories;
   private $conn;

   public function __construct($id_categories, $namecategories)
   {
    $this->id_categories=$id_categories;
    $this->namecategories=$namecategories;
   }
   public function getid_categories()
   {
     return $this->id_categories;
   }
 
   public function getnamecategories()
   {
 
     return $this->namecategories;
     
   }

   public function newCategories()
   {
    $conn=Conte_db::getConnection()->getConn();

      try 
      {
  
          $stmt = $conn->prepare(
              "INSERT INTO categories (namecategories) 
               VALUES (:namecategories)"
          );
          $stmt-> bindParam(':namecategories',$this->namecategories) ;
          $stmt->execute();
          return true;
      } 
      catch (PDOException $e) {
          error_log("Database error: " . $e->getMessage());
          throw new Exception("An error occurred while saving the user: " . $e->getMessage());
      }

   }


}


            