<?php





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

}


            