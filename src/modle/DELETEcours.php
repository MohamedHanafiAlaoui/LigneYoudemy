<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../data/conte_db.php";

require "../data/cours.php";
require "../data/tagscours.php";


$cours= new curdcours();
$tags= new crydtagscours();


if (isset($_GET['id'])) {
        $id_cours = $_GET['id'];

        try {
            $newcours= new  cours($id_cours , null,null,null,null,null,null,null,null);            
            if ($cours->DELETEcours( $newcours)) {
                echo "nice";
              
            }
        } catch (Exception $e) {
            echo " error: " . $e->getMessage();
        }


}