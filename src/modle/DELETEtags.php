<?php
require_once "conte_db.php";

require "../data/tags.php";

$tags = new crudtags();


var_dump($_GET["id"]);

if (isset($_GET["id"])) {
   

    

  

        try {
    
            $tag = new tags($_GET['id'], null);
            
            if ($tags->DELETEtags($tag )) {
              echo"nice";
            }
        } catch (Exception $e) {
            echo " error: " . $e->getMessage();
        }
        

    
  




}