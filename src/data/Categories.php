<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// echo realpath('../class/Categories.php');

require_once(__DIR__ . '/../class/Categories.php');



class crudCategories
{

   private $conn;

   public function __construct()
   {
    $this->conn=Conte_db::getConnection()->getConn();

   }


   public function get_Categories()
   {
      try {
         $query ="SELECT * FROM categories";
         $stmt= $this->conn->prepare($query);
         $stmt->execute();

         $Categoriesdata = $stmt-> fetchAll(PDO::FETCH_ASSOC);

         $Categors=[];

         foreach ($Categoriesdata as $Data) {
            $Categors[]=new Categories($Data['id_categories'],$Data['namecategories']);
         }

         return $Categors;
      } catch (PDOException $e) {
         echo "Error: " . $e->getMessage();

         return [];
      }
   }





   public function newCategories(Categories $Categorie)
   {

      try 
      {
        $query =  "INSERT INTO categories (namecategories) 
                    VALUES (:namecategories)";
        $stmt = $this -> conn->prepare($query);
        $namecategories=$Categorie->getnamecategories();

        $stmt->bindParam(':namecategories',$namecategories);
        $stmt->execute();
          return true;
      } 
      catch (PDOException $e) {
          error_log("Database error: " . $e->getMessage());
          throw new Exception("An error occurred while saving the user: " . $e->getMessage());
      }

   }


}


            