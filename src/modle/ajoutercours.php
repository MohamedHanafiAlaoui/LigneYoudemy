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
        $contenu = $_POST['contenu'];
        $description = $_POST['description'];
        $id_user = $_POST['id_user'];
        $s_status = $_POST['s_status'];
        $id_categories = $_POST['id_categories'];
        $d_date = date(format: 'Y-m-d H:i:s');;
        $image = $_POST['image'];


       
        try {
            $newcours= new cours(null, $titre_cours,$contenu,$description,$id_user,$s_status,$id_categories,$d_date,$image);

    

            
            if ($cours->createCourse( $newcours)) {
              $number=$cours-> lastid();

            
              foreach($_POST['tags'] as $idtags)
              {
                $newtags= new Tagscours(null,$idtags, $number);

                $tags->newtagscours($newtags);
              }
              
            }

            


        } catch (Exception $e) {
            echo " error: " . $e->getMessage();
        }


}