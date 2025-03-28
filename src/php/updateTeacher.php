<?php 
  /* 
   Auteur      : Gregory Mbayo     
   Description : Cette page permet de modifier un enseignant de la base de donnée.
*/
    include'Database.php';
    $database = new Database();

    if (isset($_GET) && !empty($_GET)) {
        
        if (isset($_GET["idTeacher"]) && !empty($_GET["idTeacher"])) {
            
            $teacherID = $_GET["idTeacher"];
            $teacherInfo = $database->getOneTeacher($teacherID);
            $sections = $database->getAllSections();
            $sectionOfTeacher = $database->getSectionOfTeacher($teacherID);
        }
        else{
            echo "La requette n'a pas aboutit.1";
        }
    }
    else{
        echo "La requette n'a pas aboutit.2";
    }
?>


<!DOCTYPE html>
<html lang="fr">
    <head>    
        <title>Modifier un enseignant</title>            
    </head>
    <body> 
        <header>
            <h1>Surnom des enseignants</h1>
            <nav>
                <button class="nav-button" onClick="parent.location='index.php';">Accueil</button>
            </nav>
        </header>
        <section>           
                <h3>Modification d'un enseignant</h3>
                <form id="formAddTeacher" method="post" action="#">
                    <p>
                        <input type="radio" name="gender" value="m"<?php foreach ($teacherInfo as $info){if ($info["teaGender"]=='m'){echo 'checked="checked"';}} ?>>Homme
                        <input type="radio" name="gender" value="w"<?php foreach ($teacherInfo as $info){if ($info["teaGender"]=='w'){echo 'checked="checked"';}} ?>>Femme
                        <input type="radio" name="gender" value="o"<?php foreach ($teacherInfo as $info){if ($info["teaGender"]=='o'){echo 'checked="checked"';}} ?>>Autre
                    </p>        
                    <p>		
                        <label>Nom : </label>
                        <input id="textAddForm" type="text" name="firstName" value='<?php foreach ($teacherInfo as $info){echo $info["teaLastName"]; } ?>'>							
                    </p>
                    <p>
                        <label>Prénom : </label>
                        <input type="text" name="lastName" value='<?php foreach ($teacherInfo as $info){echo $info["teaFirstName"]; } ?>'>
                    </p>
                    <p>
                        <label>Surnom : </label>
                        <input type="text" name="nickName" value='<?php foreach ($teacherInfo as $info){echo $info["teaNickName"]; } ?>'>
                    </p>
                    <p>
                        <label>Origine : </label>
                        <textarea id="textAreaAdd" rows="4" cols="50" name="nickNameOrigin"> <?php foreach ($teacherInfo as $info){echo $info["teaNickNameOrigine"]; } ?></textarea>
                    </p>
                    <p>
                        <select name="section">
                            <option value="default">Choisir</option>
                            <?php
                                foreach($sections as $section)
                                {
                                    $idSection = $section["idSection"];
                                    echo "<option value='$idSection'";
                                    foreach ($sectionOfTeacher as $info) {
                                        if ($info["fkSection"] == $idSection) {
                                            echo "selected>".$section["secName"]."</option>";
                                        }
                                        else{
                                            echo ">".$section["secName"]."</option>";
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </p>
                    <p>
                        <input id="buttonAdd" type="submit" name="submit" value="Modifier"/>
                    </p>
                </form>
            </div>
        </section>
        <footer>
            <div id="bot">
                <p class="textBot">Ce site a été créé par Gregory Mbayo<p>
            </div>
        </footer>
    </body> 
</html>
<?php
    if(isset($_POST) && !empty($_POST))
    {
        var_dump($_POST);
        $firstName = null;
        $lastName = null;
        $nickName = null;
        $nickNameOrigin = null;
        $gender = null;
        $fkSection = null;
        
        if(isset($_POST["firstName"]) && !empty($_POST["firstName"]))
        {
            $firstName = htmlspecialchars($_POST["firstName"]);
        }
        else
        {
            echo "Le format du prénom est faux <br>";
        }

        if(isset($_POST["firstName"]) && !empty($_POST["lastName"]))
        {
            $lastName = htmlspecialchars($lastName = $_POST["lastName"]);
        }
        else
        {
            echo "Le format du nom de famille est faux <br>";
        }

        if(isset($_POST["nickName"]) && !empty($_POST["nickName"]))
        {
            
            $nickName = htmlspecialchars($_POST["nickName"]);
        }
        else
        {
            echo "Le format du surnom est faux <br>";
        }

        if(isset($_POST["nickNameOrigin"]) && !empty($_POST["nickNameOrigin"]))
        {
            $nickNameOrigin = htmlspecialchars($_POST["nickNameOrigin"]);
        }
        else
        {
            echo "Le format de l'origine du surnom est faux <br>";
        }

        if(isset($_POST["gender"]) && !empty($_POST["gender"]))
        {
            $gender = htmlspecialchars($_POST["gender"]);
        }
        else
        {
            echo "le format du genre est faux <br>";
        }

        if(isset($_POST["section"]) && $_POST["section"] != "default")
        {
            $fkSection = $_POST["section"];
        }
        else
        {
            echo "Le format de la section est faux <br>";
        }

        if($firstName != null && $lastName != null && $nickName != null && $nickNameOrigin != null && $gender !=null && $fkSection != null && $teacherID != null)
        {
           $database->UpdateOneTeacher($lastName, $firstName, $gender, $nickName, $nickNameOrigin, $teacherID, $fkSection);
        }
        else
        {
            echo "Erreur d'ajout.";
        }
    }
?>
