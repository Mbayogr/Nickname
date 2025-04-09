<?php 
		/*  auteur:	Gregory Mbayo
			Description: Projet fil rouger qui consiste à pouvoir chercher des infomations sur les enseigants depuis la base de données
        */
        //utilise la base de donnée
	include'Database.php';
	$database = new Database(); 
	$teachers = $database->getAllTeachers();
 ?>
<!DOCTYPE html>
<html lang="fr">
	<head>	
		<title>Surnom des enseignants</title>		
	</head>
	<body style="overflow: visible">
		<header>
			<h1>Surnom des enseignants</h1>
			<nav>
				<button class="nav-button" onClick="parent.location='index.php';">Accueil</button>
				<?php
                //pour la connexion
                        if(isset($_SESSION) && !empty($_SESSION))
                        {
                            if($_SESSION["login"] == "admin") 
                            {
                                echo(
                                    '
                                    	<button class="nav-button" onClick="parent.location="addTeacher.php";">Ajout 
                                    '
                                );
                            }
                        }
                        else
                        {
                      
                        }
                    ?>
				<button class="nav-button" onClick="parent.location='addTeacher.php';">Ajout d'un enseignant</button>
                <?php
			
                    ?>
			</nav>		
		</header>
		<main>
			
				<h2>Liste des enseignants</h2>
			</div>
			<table class="tableProf">
				<tr>
					<th>Nom</th>
					<th>Surnom</th>
					<th>Options</th>
				</tr>
				<?php
					foreach ($teachers as $teacher) {
						$teacherId = $teacher["idTeacher"];
						echo "<tr>";
						echo "<td>".$teacher["teaFirstName"]." ".$teacher["teaLastName"]."</td>";
						echo "<td>".$teacher["teaNickName"]."</td>";
						echo (
                            //liens pour acceder a la modification, supprimer un prof, les détails, pour voter et voir la liste des votes
                        '<td id="modification">
                            <a class="aModification" href="updateTeacher.php?idTeacher='.$teacherId.'">Modifier</a>
                            <a class="aModification" onClick="return confirm(\'Supprimer ?\');" href="deleteTeacher.php?varDelete='.$teacherId.'">Supprimer</a>
                            <a class="aModification" href="details.php?idTeacher='.$teacherId.'">Détails</a>
                        </td>'
                        
                        );
						echo "</tr>";
					}
				?>
			</table>
		</main>
		<footer>
			
				<p class="textBot">Ce site a été créé par Gregory Mbayo<p>
			</div>
		</footer>
	</body>
</html>