<?php

require "conte_db.php";



class classcours
{
   private $id_classcours	;
   private $id_cours;
   private $id_user;
   private $s_status;
   private $conn;

   public function __construct($id_classcours	, $id_cours,$id_user,$s_status)
   {
    $this->id_classcours	=$id_classcours	;
    $this->id_cours=$id_cours;
    $this->id_user=$id_user;
    $this->s_status=$s_status;
   }
   public function getid_classcours	()
   {
     return $this->id_classcours	;
   }
 
   public function getid_cours()
   {
 
     return $this->id_cours;
     
   }
   public function getid_user()
   {
 
     return $this->id_user;
     
   }
   public function gets_status()
   {
 
     return $this->s_status;
     
   }   







   public function newclasscours()
   {
    $conn=Conte_db::getConnection()->getConn();

      try 
      {
  
          $stmt = $conn->prepare(
              "INSERT INTO classcours (id_cours,id_user,s_status) 
               VALUES (:id_cours,:id_user,:s_status)"
          );
          $stmt-> bindParam(':id_cours',$this->id_cours) ;
          $stmt-> bindParam(':id_user',$this->id_user) ;
          $stmt-> bindParam(':s_status',$this->s_status) ;
          $stmt->execute();
          return true;
      } 
      catch (PDOException $e) {
          error_log("Database error: " . $e->getMessage());
          throw new Exception("An error occurred while saving the user: " . $e->getMessage());
      }

   }


}



            