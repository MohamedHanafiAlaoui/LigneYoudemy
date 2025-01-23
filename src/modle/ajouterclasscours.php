

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../data/conte_db.php";

require "../data/classcours.php";


$classcours = new crudclasscours();



if (isset($_POST["submit"]))
{
    $id_cours=$_POST['id_cours'];
    $id_user=$_POST['id_user'];
    $s_status="active";

    $newCategorie= new classcours(null, $id_cours,$id_user,$s_status);

 


    if (!($classcours->COUNTclasscours($newCategorie))) {

      

        if ($classcours->newclasscours($newCategorie)) {
            header("Location:/Mentor/courses.php");
          
        }else{
    
        }
    }else {

        header("Location:/Mentor/page404.php");
        
        
    }



   
}


