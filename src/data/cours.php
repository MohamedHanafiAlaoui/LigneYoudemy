<?php


require( __DIR__ . "/../class/cours.php");



class curdcours
{

  private $conn;
   public function __construct()
   {
    $this ->conn=Conte_db::getConnection()->getConn();

   }
   
   public function createCourse(cours $cours)
   {

      try 
      {
        $query ="INSERT INTO cours (titre_cours,contenu,description,id_user,s_status,id_categories,d_date,image) 
               VALUES (:titre_cours,:contenu,:description,:id_user,:s_status,:id_categories,:d_date,:image)"
          ;
            $stmt = $this -> conn->prepare($query);
  
            $titre_cours = $cours->getTitreCours();
            $contenu = $cours->getContenu();
            $description = $cours->getDescription();
            $id_user = $cours->getIdUser();
            $id_categories = $cours->getIdCategories();
            $d_date = $cours->getDate();
            $image = $cours->getImage();
            $s_status =  $cours->gets_status();
            
            $stmt->bindParam(':titre_cours', $titre_cours);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':s_status', $s_status);
            $stmt->bindParam(':id_categories', $id_categories);
            $stmt->bindParam(':d_date', $d_date);
            $stmt->bindParam(':image', $image);

            

          $stmt->execute();
          return true;
      } 
      catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        throw new Exception("An error occurred while adding the course: " . $e->getMessage());
    }

   }







   public function get_cours($iduser)
   {
      try {
         $query ="SELECT cours.*, user.FullName, GROUP_CONCAT(tags.name_tag) AS tags_names FROM cours JOIN tagscours ON cours.id_cours = tagscours.id_cours JOIN tags ON tags.id_tag = tagscours.id_tag JOIN user ON cours.id_user = user.id_user  where cours.id_user = :iduser  GROUP BY cours.id_cours";
         $stmt= $this->conn->prepare($query);
         $stmt->bindParam(':iduser', $iduser);
         $stmt->execute();
         $coursdata = $stmt-> fetchAll(PDO::FETCH_ASSOC);
         $cours=[];
         foreach ($coursdata as $Data) {
            $cours[]=new cours($Data['id_cours'],$Data['titre_cours'],$Data['contenu'],$Data['id_user'],$Data['FullName'],$Data['s_status']);
         }
         return $cours;
      } catch (PDOException $e) {
         echo "Error: " . $e->getMessage();

         return [];
      }
   }

   


   private $lignes_par_page = 5;

   public function getLinesParPage()
   {
       return $this->lignes_par_page  ;
   }

   public function Nbr_cours($search)
   {
       $query = $this->conn->prepare("SELECT count(*) AS total FROM cours where s_status='active' AND cours.titre_cours LIKE :search ;");
       if ($search != null) {
        $searchTerm = "%$search%"; 
        $query->bindParam(':search', $searchTerm);
    }else {
     $searchTerm = "%%"; 
     $query->bindParam(':search', $searchTerm);
      }
       $query->execute();
       $result = $query->fetch();
       return $result['total'];

   }

   public function Getcours($page = 1, $search , $nametags )
   {

    try {
       $offset = ($page - 1) * $this->lignes_par_page;
   
       $queryStr = "SELECT cours.*, user.FullName, categories.namecategories, GROUP_CONCAT(tags.name_tag) AS tags_names FROM cours JOIN tagscours ON cours.id_cours = tagscours.id_cours JOIN tags ON tags.id_tag = tagscours.id_tag JOIN user ON cours.id_user = user.id_user  JOIN categories ON cours.id_categories = categories.id_categories where cours.s_status='active'AND cours.titre_cours LIKE :search AND tags.name_tag LIKE :nametags GROUP BY cours.id_cours";
   
       $queryStr .= " LIMIT :offset, :limit";
   
       $query = $this->conn->prepare($queryStr);
       
       
       if ($search != null) {
           $searchTerm = "%$search%"; 
           $query->bindParam(':search', $searchTerm);
       }else {
        $searchTerm = "%%"; 
        $query->bindParam(':search', $searchTerm);
       }
       if ($nametags != null) {
           $nametagsTerm = "%$nametags%"; 
           $query->bindParam(':nametags', $nametagsTerm);
       }else {
        $nametagsTerm = "%%"; 
        $query->bindParam(':nametags', $nametagsTerm);
       }
   
       
       $query->bindParam(':offset', $offset, PDO::PARAM_INT);
       $query->bindParam(':limit', $this->lignes_par_page, PDO::PARAM_INT);
   
       $query->execute();

       $coursdata = $query->fetchAll(PDO::FETCH_ASSOC);
    
           
       $cours = [];
       foreach ($coursdata as $data) {
         $cours[] = new CoursAll(
           $data['id_cours'],
           $data['titre_cours'],
           $data['contenu'],
           $data['description'],    
           $data['id_user'],
           $data['s_status'],
           $data['id_categories'],  
           $data['d_date'],         
           $data['image'],          
           $data['FullName'],        
           $data['namecategories'],  
           $data['tags_names']       
       );
       
       }

       return $cours ;

      } catch (PDOException $e) {
          
        echo "Erreur : " . $e->getMessage();
        return [];
    }

   }



   

    public function lastid()
    {
      $query ="SELECT cours.id_cours as namber FROM cours ORDER BY cours.id_cours DESC LIMIT 1;";

      $stmt = $this -> conn->prepare($query);
      $stmt->execute();
      $result=  $stmt->fetch(PDO::FETCH_ASSOC); 
      
      return $result ? $result['namber'] :null;
    }

    public function detailscours($id_cours)
    {
        try {
            
            $query = "
                SELECT 
                    cours.id_cours,
                    cours.titre_cours,
                    cours.contenu,
                    cours.description,
                    cours.id_user,
                    cours.s_status,
                    cours.id_categories,
                    cours.d_date,
                    cours.image,
                    user.FullName,
                    categories.namecategories,
                    GROUP_CONCAT(tags.name_tag SEPARATOR ', ') AS tags_names
                FROM 
                    cours
                JOIN 
                    tagscours ON cours.id_cours = tagscours.id_cours
                JOIN 
                    tags ON tags.id_tag = tagscours.id_tag
                JOIN 
                    user ON cours.id_user = user.id_user
                JOIN 
                    categories ON cours.id_categories = categories.id_categories
                WHERE 
                    cours.s_status = 'active' 
                    AND cours.id_cours = :id_cours
                GROUP BY 
                    cours.id_cours;
            ";
    
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
            $stmt->execute();
    
            
            $coursdata = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
           
            $cours = [];
            foreach ($coursdata as $data) {
              $cours[] = new CoursAll(
                $data['id_cours'],
                $data['titre_cours'],
                $data['contenu'],
                $data['description'],    
                $data['id_user'],
                $data['s_status'],
                $data['id_categories'],  
                $data['d_date'],         
                $data['image'],          
                $data['FullName'],        
                $data['namecategories'],  
                $data['tags_names']       
            );
            
            }
    
            return $cours;
    
        } catch (PDOException $e) {
          
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }





    public function detailUPDATcours($id_cours)
    {
        try {
            
            $query = "
                SELECT 
                    cours.id_cours,
                    cours.titre_cours,
                    cours.contenu,
                    cours.description,
                    cours.id_user,
                    cours.s_status,
                    cours.id_categories,
                    cours.d_date,
                    cours.image,
                    user.FullName,
                    categories.namecategories,
                    GROUP_CONCAT(tags.name_tag SEPARATOR ', ') AS tags_names
                FROM 
                    cours
                JOIN 
                    tagscours ON cours.id_cours = tagscours.id_cours
                JOIN 
                    tags ON tags.id_tag = tagscours.id_tag
                JOIN 
                    user ON cours.id_user = user.id_user
                JOIN 
                    categories ON cours.id_categories = categories.id_categories
                WHERE 
                   cours.id_cours = :id_cours
                GROUP BY 
                    cours.id_cours;
            ";
    
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
            $stmt->execute();
    
            
            $coursdata = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
           
            $cours = [];
            foreach ($coursdata as $data) {
              $cours[] = new CoursAll(
                $data['id_cours'],
                $data['titre_cours'],
                $data['contenu'],
                $data['description'],    
                $data['id_user'],
                $data['s_status'],
                $data['id_categories'],  
                $data['d_date'],         
                $data['image'],          
                $data['FullName'],        
                $data['namecategories'],  
                $data['tags_names']       
            );
            
            }
    
            return $cours;
    
        } catch (PDOException $e) {
          
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }

    public function UPDATEcors(cours $cours)
    {

      try 
      {
        $query ="UPDATE cours 
                SET titre_cours = :titre_cours, 
                    contenu = :contenu, 
                    description = :description, 
                    s_status = :s_status, 
                    id_categories = :id_categories, 
                    image = :image
                WHERE id_cours = :id_cours ;";
            $stmt = $this -> conn->prepare($query);
  
         
            $titre_cours = $cours->getTitreCours();
            $contenu = $cours->getContenu();
            $description = $cours->getDescription();
            $s_status = $cours->gets_status();
            $id_categories = $cours->getIdCategories();
            $image = $cours->getImage();
            $id_cours = $cours->getid_cours();

            $stmt->bindParam(':titre_cours', $titre_cours);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':s_status', $s_status);
            $stmt->bindParam(':id_categories', $id_categories);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':id_cours', $id_cours);

            

          $stmt->execute();
          return true;
      } 
      catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        throw new Exception("An error occurred while adding the course: " . $e->getMessage());
      }

    }


    public function DELETEcours(cours $cours)
    {
        try {
            
            $query = "DELETE FROM cours WHERE id_cours = :id_cours";
    
            
            $stmt = $this->conn->prepare($query);

            $id_cours = $cours->getid_cours();

            $stmt->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
            $stmt->execute();
            return true;
    
        } catch (PDOException $e) {
          
            echo "Erreur : " . $e->getMessage();
            throw new Exception("An error occurred while DELETEcours the course: " . $e->getMessage());

        }
    }


}

