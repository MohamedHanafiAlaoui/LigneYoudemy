<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../data/conte_db.php";


require "../data/tags.php";

$tags = new crudtags();



if (isset($_POST["submit"])) {
   

    

    foreach ($_POST['Tags'] as $Tags) {

        try {
    
            $tag = new tags(null, $Tags['Tag']);
            
            if ($tags->newtags($tag )) {
              echo"nice";
            }
        } catch (Exception $e) {
            echo " error: " . $e->getMessage();
        }
        

    }
  




}