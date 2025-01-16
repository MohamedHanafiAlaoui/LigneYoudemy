<?php

require "conte_db.php";



class cours
{
   private $id_cours;
   private $titre_cours;
   private $contenu;
   private $description;
   private $id_user;
   private $s_status;
   private $id_categories;
   private $d_date;
   private $image;
   private $conn;

   public function __construct($id_cours = null, $titre_cours = null, $contenu = null, $description = null, $id_user = null, $s_status = null, $id_categories = null, $d_date = null, $image = null)
   {
       $this->id_cours = $id_cours;
       $this->titre_cours = $titre_cours;
       $this->contenu = $contenu;
       $this->description = $description;
       $this->id_user = $id_user;
       $this->s_status = $s_status;
       $this->id_categories = $id_categories;
       $this->d_date = $d_date;
       $this->image = $image;
   }
   public function getid_cours()
   {
     return $this->id_cours;
   }
 
   public function gettitre_cours()
   {
 
     return $this->titre_cours;
     
   }

   public function getcontenu()
   {
 
     return $this->contenu;
     
   }
   public function getdescription()
   {
 
     return $this->description;
     
   }

   public function getid_user()
   {
 
     return $this->id_user;
     
   }

   public function getid_categories()
   {
 
     return $this->id_categories;
     
   }

   public function getd_date()
   {
 
     return $this->d_date;
     
   }

   public function getimage()
   {
 
     return $this->image;
     
   }
   public function newCategories()
   {
    $conn=Conte_db::getConnection()->getConn();

      try 
      {
  
          $stmt = $conn->prepare(
              "INSERT INTO cours (titre_cours,contenu,:description,id_user,s_status,id_categories,d_date,image) 
               VALUES (:titre_cours,:contenu,:description,:id_user,:s_status,:id_categories,:d_date,:image)"
          );
          $stmt-> bindParam(':titre_cours',$this->titre_cours) ;
          $stmt->bindParam(':contenu', $this->contenu);
          $stmt->bindParam(':description', $this->description);
          $stmt->bindParam(':id_user', $this->id_user);
          $stmt->bindParam(':s_status', $this->s_status);
          $stmt->bindParam(':id_categories', $this->id_categories);
          $stmt->bindParam(':d_date', $this->d_date);
          $stmt->bindParam(':image', $this->image);
          $stmt->execute();
          return true;
      } 
      catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        throw new Exception("An error occurred while adding the course: " . $e->getMessage());
    }

   }


}


            