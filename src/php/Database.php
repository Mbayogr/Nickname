<?php

/**
 * 
 * TODO : à compléter
 * 
 * Auteur : Mbayo grgeory
 * Date : 25.03.2025
 * Description : Cette page va s'occuper d'effectuer les requettes d'extraction de la base de données.
 */


 class Database {


    // Variable de classe
    private $connector;

    /**
     * Cette fonction permet de se connecter en passant par un pdo à la base de donnée
     */
    public function __construct(){

        $this->connector = new PDO('mysql:host=localhost;dbname=db_nickname_mbayogr;charset=utf8' , 'root', 'root');
    }

    /**
     * Cette fonction permet de préparer l'execution d'une requête
     */
    private function querySimpleExecute($query){

        return $this->connector->query($query);
    }

     /**
     * Cette fonction permet de préparer l'execution d'une requête de manière plus complexe
     */
    private function queryPrepareExecute($query){
        
        $req = $this->connector->prepare($query, $binds);
        $req->bindValue('varId', $id, PDO::PARAM_INT);
        $req->bindValue('varInput', $input, PDO::PARAM_STR);
        $req->execute();
    }

     /**
     * Fonction dee traitement de donnée qui sera sous forme de tableau associatif
     */
    private function formatData($req){
        return $req->fetchALL(PDO::FETCH_ASSOC);
    }
    /**
     * Sert a fermer le jeu de resultat
     */
    private function unsetData($req){

        $req->closeCursor();
    }
    /**
     * fonction qui retourne tout les enseignants de la table t_teacher
     */
    public function getAllTeachers(){

        $query = 'SELECT * FROM t_teacher';

        $req = $this->querySimpleExecute($query);

        $result = $this->formatData($req);

        $this->unsetData($req);

        return $result;
    }

     /**
     * fonction qui retourne tout les sections de la table t_sections
     */
    public function getAllSections(){

        $query = 'SELECT * FROM t_section';

        $req = $this->querySimpleExecute($query);

        $result = $this->formatData($req);

        $this->unsetData($req);

        return $result;
    }

    
    /**
     * fonction qui permet de récupérer l'information d'un seul enseignant en utilisant son ID
     */
    public function getOneTeacher($id){

    	$query = "SELECT * FROM t_teacher WHERE idTeacher=$id";

        $req = $this->querySimpleExecute($query);

        $result = $this->formatData($req);

        $this->unsetData($req);

        return $result;

    }

      /**
     * fonction qui permet de récupéré la section d'un enseignant.
     */
    public function getSectionOfTeacher($idTeacher){
            
        $query = "SELECT * FROM t_teacher, t_section, t_teacher_section_relation WHERE fkTeacher=$idTeacher AND fkTeacher=idTeacher AND fkSection=idSection";
        $req = $this->querySimpleExecute($query);
        $result = $this->formatData($req);
        return $result;
    }

        /**
     * fonction qui permet de définir l'information d'un seul enseignant en utilisant un formulaire.
     */
		public function setOneTeacher($lastName, $firstName, $gender, $nickName, $nickNameOrigin){
			
            $query = "INSERT INTO t_teacher (teaName, teaFirstname, teaGender, teaNickname, teaOrigine) VALUES ('$lastName', '$firstName', '$gender', '$nickName', '$nickNameOrigin')";
            $this->querySimpleExecute($query);
            return $this->connector->lastInsertId();
            die();
        }


    // + tous les autres méthodes dont vous aurez besoin pour la suite (insertTeacher ... etc)
 }


?>