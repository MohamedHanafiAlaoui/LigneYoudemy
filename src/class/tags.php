<?php





class tags
{
   private $id_tag;
   private $name_tag;
   private $conn;

   public function __construct($id_tag, $name_tag)
   {
    $this->id_tag=$id_tag;
    $this->name_tag=$name_tag;
   }
   public function getid_tag()
   {
     return $this->id_tag;
   }
 
   public function getname_tag()
   {
 
     return $this->name_tag;
     
   }

}




            