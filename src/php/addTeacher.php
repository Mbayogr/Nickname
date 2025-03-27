<?php
/*
Auteur      : Gregory Mbayo        
Description : Cette page permet d'ajouter un enseignant à une base de donnée.
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
    include 'Database.php';
    $database = new Database();
    $sections = $database->getAllSections();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>    
        
        <title>Ajouter un enseignant</title>     
  
      
    </head>
    <body> 
        <header>
            <h1>Surnom des enseignants</h1>
            <nav>
            <!-- boutons pour l'acceuil ou l'ajout d'enseignant
                -->
                <button class="nav-button" onClick="parent.location='index.php';">Accueil</button>
                <button class="nav-button" onClick="parent.location='addTeacher.php';">Ajout d'un enseignant</button>
            </nav>
        </header>
        <section> 
            <div id="divAdd">
                <h3>Ajout d'un enseignant</h3>
                <!--formulaire pour les informations sur les enseignants
                    -->
                <form id="formAddTeacher" method="post" action="#">
                    <p>
                        <input type="radio" name="gender" value="h">Homme
                        <input type="radio" name="gender" value="f">Femme
                        <input type="radio" name="gender" value="a">Autre
                    </p>        
                    <p>				
                        <label>Nom : </label>
                        <input id="textAddForm" type="text" name="firstName">							
                    </p>
                    <p>
                        <label>Prénom : </label>
                        <input type="text" name="lastName">
                    </p>
                    <p>
                        <label>Surnom : </label>
                        <input type="text" name="nickName">
                    </p>
                    <p>
                        <label>Origine : </label>
                        <textarea id="textAreaAdd" rows="4" cols="50" name="nickNameOrigin"></textarea>
                    </p>
                    <p>
                        <select name="section">
                            <option value="default">Choisir</option>
                            <?php
                                foreach($sections as $section)
                                {
                                  ?>
                                 <option value="<?php echo $section['idSection']?>"><?php echo $section['secName']?></option>
                                  <?php
                                }
                            ?>
                        </select>
                    </p>
                    <p>
                        <input id="buttonAdd" type="submit" name="submit" value="Ajouter"/>
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
//inscrit les informations dans la bse de données et sinon renvoie une erreur
    if(isset($_POST) && !empty($_POST))
    {
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
        if(isset($_POST["lastName"]) && !empty($_POST["lastName"]))
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
        if($firstName != null && $lastName != null && $nickName != null && $nickNameOrigin != null && $gender !=null && $fkSection != null)
        {
            $fkTeacher = $database->setOneTeacher($lastName, $firstName, $gender, $nickName, $nickNameOrigin);
        }
        else
        {
            echo "Erreur d'ajout.";
        }
    }
?>
