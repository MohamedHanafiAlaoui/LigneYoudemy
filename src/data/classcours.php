<?php
require( __DIR__ . "/../class/classcours.php");




class crudclasscours
{

   private $conn;

   public function __construct()
   {
    $this-> conn=Conte_db::getConnection()->getConn();
   }

 

   public function newclasscours(classcours $classcour)
   {

      try 
      {
  
        $query ="INSERT INTO classcours (id_cours,id_user,s_status) 
               VALUES (:id_cours,:id_user,:s_status)";

          $stmt = $this -> conn->prepare($query);
          $id_cours=$classcour->getid_cours();
          $id_user=$classcour->getid_user();
          $s_status=$classcour->gets_status();
  
          $stmt->bindParam(':id_cours',$id_cours);
          $stmt->bindParam(':id_user',$id_user);
          $stmt->bindParam(':s_status',$s_status);
          $stmt->execute();

     
      } 
      catch (PDOException $e) {
          error_log("Database error: " . $e->getMessage());
          throw new Exception("An error occurred while saving the user: " . $e->getMessage());
      }

   
   }


   public function COUNTclasscours(classcours $classcour)
     {
 
       try 
       {
   
         $query ="SELECT COUNT(*) as total FROM classcours WHERE  id_cours=:id_cours and  id_user=:id_user";
 
           $stmt = $this -> conn->prepare($query);
           $id_cours=$classcour->getid_cours();
           $id_user=$classcour->getid_user();   
           $stmt->bindParam(':id_cours',$id_cours);
           $stmt->bindParam(':id_user',$id_user);
           $stmt->execute();
           $COUNTdata = $stmt-> fetch(PDO::FETCH_ASSOC);
 
           return $COUNTdata['total'];
      
       } 
       catch (PDOException $e) {
           error_log("Database error: " . $e->getMessage());
           throw new Exception("An error occurred while saving the user: " . $e->getMessage());
       }
 
    
   }


   public function get_classcours()
   {
      try {
         $query ="SELECT classcours.* ,cours.titre_cours,user.FullName FROM
classcours JOIN cours ON  cours.id_cours = classcours.id_cours JOIN user 
on user.id_user = classcours.id_user";
         $stmt= $this->conn->prepare($query);
         $stmt->execute();

         $cours = $stmt-> fetchAll(PDO::FETCH_ASSOC);

         $classcours=[];

         foreach ($cours as $Data) {
            $classcours[]=new dclasscours($Data['id_classcours'],$Data['id_cours'],$Data['id_user'],$Data['s_status'],$Data['titre_cours'],$Data['FullName']);
         }

         return $classcours;
      } catch (PDOException $e) {
         echo "Error: " . $e->getMessage();

         return [];
      }
   }



   public function UPDATEclasscours(classcours $classcours)
   {

     try 
     {
       $query ="UPDATE classcours SET s_status =:s_status  WHERE id_classcours = :id_classcours;";
           $stmt = $this -> conn->prepare($query);
 
        
           $s_status = $classcours->gets_status();
           $id_classcours = $classcours->getid_classcours();


           $stmt->bindParam(':s_status', $s_status);
           $stmt->bindParam(':id_classcours', $id_classcours);


           

         $stmt->execute();
         return true;
     } 
     catch (PDOException $e) {
       error_log("Database error: " . $e->getMessage());
       throw new Exception("An error occurred while adding the classcours: " . $e->getMessage());
     }

   }



}



            