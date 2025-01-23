<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../data/conte_db.php";

require "../data/Categories.php";

$Categories = new crudCategories();

if (isset($_POST["submit"])) {
   
    $CategoriesError = "";
    $isValid = true;
    // $Categories = $_POST["categoryName"];

    foreach ($_POST['Categorys'] as $Category) {

        try {
    
            $newCategorie= new Categories(null, $Category['Category']);
            
            if ($Categories->newCategories( $newCategorie)) {
              echo"nice";
            }
        } catch (Exception $e) {
            echo " error: " . $e->getMessage();
        }
        

    }
}