<?php 
/*
 * Auteur : Gregory Mbayo
 * Description : Cette page va permetrre de supprimer les profs
 */

 session_start();
 $DATABASE_HOST = 'localhost';
 $DATABASE_USER = 'root';
 $DATABASE_PASS = 'root';
 $DATABASE_NAME = 'db_nickname_mbayogr';
 // connexion a la base de donnée
 $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
 if ( mysqli_connect_errno() ) {
     // affiche le message d'erreur en cas d'echec de connexion
     exit('Failed to connect to MySQL: ' . mysqli_connect_error());
 }
 
//utilise la base de donnée
include'Database.php';
$database = new Database();
//suprime un enseignant de la base de données
if (isset($_GET) && !empty($_GET)) {
    
    if (isset($_GET["varDelete"]) && !empty($_GET["varDelete"])) {
        
        $database->DeleteOneTeacher($_GET["varDelete"]);
    }
    else{
        echo "La requette n'a pas aboutit.";
    }
}
else{
    echo "La requette n'a pas aboutit.";
}
?>