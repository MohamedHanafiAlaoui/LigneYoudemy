<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../data/conte_db.php";

require "../data/cours.php";
require "../data/tagscours.php";


$cours= new curdcours();
$tags= new crydtagscours();


if (isset($_POST['submit'])) {
   

    
        $titre_cours = $_POST['titre_cours'];
        $id_cours = $_POST['id_cours'];
        $contenu = $_POST['contenu'];
        $description = $_POST['description'];
        $s_status = $_POST['s_status'];
        $id_categories = $_POST['id_categories'];
        $image = $_POST['image'];
        try {
            $newcours= new  cours($id_cours , $titre_cours,$contenu,$description,null,$s_status,$id_categories,null,$image);            
            if ($cours->UPDATEcors( $newcours)) {
            
              
            }
        } catch (Exception $e) {
            echo " error: " . $e->getMessage();
        }


}