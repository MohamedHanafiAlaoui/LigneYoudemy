<?php

require( __DIR__ . "/../class/tagscours.php");




class crydtagscours
{


   private $conn;

   public function __construct()
   {
    $this->conn=Conte_db::getConnection()->getConn();
   }

 



   public function newtagscours(tagscours $tagscours)
   {
    $conn=Conte_db::getConnection()->getConn();

      try 
      {
  
          $stmt = $conn->prepare(
              "INSERT INTO tagscours (id_tag,id_cours) 
               VALUES (:id_tag,:id_cours)"
          );

          $id_cours=$tagscours->getid_cours();
          $id_tag=$tagscours->getid_tag();


          $stmt-> bindParam(':id_tag',$id_tag) ;

          $stmt-> bindParam(':id_cours',$id_cours) ;
          $stmt->execute();
          return true;
      } 
      catch (PDOException $e) {
          error_log("Database error: " . $e->getMessage());
          throw new Exception("An error occurred while saving the user: " . $e->getMessage());
      }

   }








}






            