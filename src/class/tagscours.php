<?php





class Tagscours
{
   private $id_tagscours;
   private $id_tag;
   private $id_cours;
  //  private $conn;

   public function __construct($id_tagscours, $id_tag,$id_cours)
   {
    $this->id_tagscours=$id_tagscours;
    $this->id_tag=$id_tag;
    $this->id_cours=$id_cours;
   }
   public function getid_tagscours()
   {
     return $this->id_tagscours;
   }
 
   public function getid_tag()
   {
 
     return $this->id_tag;
     
   }
 
   public function getid_cours()
   {
 
     return $this->id_cours;
     
   }


}


            