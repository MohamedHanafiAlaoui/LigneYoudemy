<?php



class classcours
{
   private $id_classcours	;
   private $id_cours;
   private $id_user;
   private $s_status;


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

}


class dclasscours extends classcours
{

  private $titre_cours;
  private $FullName;

  public function __construct($id_classcours	, $id_cours,$id_user,$s_status,$titre_cours,$FullName)
  {

    parent::__construct($id_classcours	, $id_cours,$id_user,$s_status);

   $this->titre_cours=$titre_cours;
   $this->FullName=$FullName;
  }

  public function gettitre_cours()
  {

    return $this->titre_cours;
    
  }   

  public function getFullName()
  {

    return $this->FullName;
    
  }   


}


            