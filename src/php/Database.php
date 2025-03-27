<?php
/*
 * Auteur : Gregory Mbayo
 * Description : Cette page va s'occuper d'effectuer les requettes d'extraction de la base de données.
 */
 class Database {
    // Variable de classe
    private $connector;
    
     // Cette fonction permet de se connecter en passant par un pdo à la base de donnée
     
    public function __construct(){
        $this->connector = new PDO('mysql:host=localhost;dbname=db_nickname_mbayogr;charset=utf8' , 'root', 'root');
    }
    
      //Cette fonction permet de préparer l'execution d'une requête
     
    private function querySimpleExecute($query){
        return $this->connector->query($query);
    }
    
     //Cette fonction permet de préparer l'execution d'une requête de manière plus complexe
     
    private function queryPrepareExecute($query){ 
        $req = $this->connector->prepare($query, $binds);
        $req->bindValue('varId', $id, PDO::PARAM_INT);
        $req->bindValue('varInput', $input, PDO::PARAM_STR);
        $req->execute();
    }
    
     // Fonction dee traitement de donnée qui sera sous forme de tableau associatif
     
    private function formatData($req){
        return $req->fetchALL(PDO::FETCH_ASSOC);
    }
    
     // Sert a fermer le jeu de resultat
     
    private function unsetData($req){
        $req->closeCursor();
    }
    
     //fonction qui retourne tout les enseignants de la table t_teacher
     
    public function getAllTeachers(){
        $query = 'SELECT * FROM t_teacher';
        $req = $this->querySimpleExecute($query);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }
    
     // fonction qui retourne tout les sections de la table t_sections
     
    public function getAllSections(){
        $query = 'SELECT * FROM t_section';
        $req = $this->querySimpleExecute($query);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }
    
    // fonction qui permet de récupérer l'information d'un seul enseignant en utilisant son ID
     
    public function getOneTeacher($id){
    	$query = "SELECT * FROM t_teacher WHERE idTeacher=$id";
        $req = $this->querySimpleExecute($query);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }
    
      //fonction qui permet de définir l'information d'un seul enseignant en utilisant un formulaire.
     
		public function setOneTeacher($lastName, $firstName, $gender, $nickName, $nickNameOrigin, $fkSection){
			
            $query = "INSERT INTO t_teacher (teaLastName, teaFirstName, teaGender, teaNickName, teaNickNameOrigine, fkSection) VALUES ('$lastName', '$firstName', '$gender', '$nickName', '$nickNameOrigin', '$fkSection')";
            $this->querySimpleExecute($query);
            return $this->connector->lastInsertId();
            die();
        }
    

      // fonction qui permet de récupéré la section d'un enseignant.
     
        public function getSectionOfTeacher($idTeacher){        
            $query = "SELECT fkSection FROM t_teacher WHERE idTeacher=$idTeacher";
            $req = $this->querySimpleExecute($query);
            $result = $this->formatData($req);
            return $result;
          /*  $query = "SELECT secName FROM t_section WHERE idSection=$result";
            $req = $this->querySimpleExecute($query);
            $result = $this->formatData($req);*/

        }
    
     // fonction qui permet de supprimer un enseignant.
        
        public function DeleteOneTeacher($idTeacher){         
            $query = "DELETE FROM t_teacher WHERE idTeacher=$idTeacher";
            $this->querySimpleExecute($query);
            header("Location:index.php");
            die();
        }
    
     // fonction qui permet de modifier un enseignant.
     
        public function UpdateOneTeacher($lastName, $firstName, $gender, $nickName, $nickNameOrigin, $idTeacher, $fkSection, $vote){       
            $query = "UPDATE `t_teacher` SET `teaLastName` = '$lastName', `teaFirstName` = '$firstName', `teaGender` = '$gender', `teaNickName` = '$nickName', `teaNickNameOrigine` = '$nickNameOrigin' WHERE `idTeacher` = '$idTeacher'";
            $this->querySimpleExecute($query);
            $this->UpdateOneTeacherRelation($idTeacher, $fkSection);
        }    
    
 }
?>