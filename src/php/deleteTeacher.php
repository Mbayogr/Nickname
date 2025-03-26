<?php 
/*
 * Auteur : Gregory Mbayo
 * Description : Cette page va permetrre de supprimer les profs
 */
//utilise la base de donnée
include'Database.php';
$database = new Database();
//suprime un enseignant de la base de données
if (isset($_GET) && !empty($_GET)) {
    
    if (isset($_GET["varDelete"]) && !empty($_GET["varDelete"])) {
        
        $database->DeleteOneTeacherRelation($_GET["varDelete"]);
    }
    else{
        echo "La requette n'a pas aboutit.";
    }
}
else{
    echo "La requette n'a pas aboutit.";
}
?>