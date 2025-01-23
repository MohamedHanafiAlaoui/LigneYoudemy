<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../data/conte_db.php";

require "../data/classcours.php";



$cours= new crudclasscours();



if (isset($_POST['submit'])) {
   

        $s_status ;
        $id_classcours = $_POST['id_classcours'];

        if ($_POST['Status'] == "active") {
        $s_status = 'not_active';
            
        }else
        {
        $s_status = 'active';

        }
 
        try {
            $newcours= new  classcours($id_classcours, null,null,$s_status);            
            if ($cours->UPDATEclasscours( $newcours)) {
                
                header("Location: /Mentor/ClassCourses.php");
              
            }
        } catch (Exception $e) {
            echo " error: " . $e->getMessage();
        }


}