<?php





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
 
   public function getTitreCours()
   {
 
     return $this->titre_cours;
     
   }

   public function getContenu()
   {
 
     return $this->contenu;
     
   }
   public function getDescription()
   {
 
     return $this->description;
     
   }

   public function getIdUser()
   {
 
     return $this->id_user;
     
   }

   public function getIdCategories()
   {
 
     return $this->id_categories;
     
   }

   public function getDate()
   {
 
     return $this->d_date;
     
   }

   public function getImage()
   {
 
     return $this->image;
     
   }

   public function gets_status()
   {
 
     return $this->s_status;
     
   }



}

class CoursAll extends cours
{
    private $FullName;
    private $namecategories;
    private $tags_names;

    public function __construct(
        $id_cours = null,
        $titre_cours = null,
        $contenu = null,
        $description = null,
        $id_user = null,
        $s_status = null,
        $id_categories = null,
        $d_date = null,
        $image = null,
        $FullName = null,
        $namecategories = null,
        $tags_names = null
    ) {
        
        parent::__construct($id_cours, $titre_cours, $contenu, $description, $id_user, $s_status, $id_categories, $d_date, $image);

        
        $this->FullName = $FullName;
        $this->namecategories = $namecategories;
        $this->tags_names = $tags_names;
    }

   
    public function getFullName()
    {
        return $this->FullName;
    }

    
    public function getNameCategories()
    {
        return $this->namecategories;
    }

 
    public function getTagsNames()
    {
        return $this->tags_names;
    }

  }

            