<?php 
        /*auteur: Gregory Mbayo
        Description: Projet fil rouger qui consiste à pouvoir chercher des infomations sur les enseigants depuis la base de données
        */
	include'Database.php';
	$database = new Database(); 
	$teachers = $database->getAllTeachers();
 ?>

<!DOCTYPE html>
<html lang="fr">
	<head>	
		<title>Surnom des enseignants</title>
		<meta charset="utf-8">
	</head>
	<body>
		<header>
			<h1>Surnom des enseignants</h1>
			<nav>
				<button class="nav-button" onClick="parent.location='index.php';">Accueil</button>
				<button class="nav-button" onClick="parent.location='addTeacher.php';">Ajout d'un enseignant</button>
			</nav>		
		</header>
		<main>
			<div id="mainId">
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
						echo "<td>".$teacher["teaFirstname"]." ".$teacher["teaName"]."</td>";
						echo "<td>".$teacher["teaNickname"]."</td>";
						echo (
                            '<td id="modification">
                                <a class="aModification" href="modificationTeacher.php?idTeacher='.$teacherId.'">Modifier</a>
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
			<div id="bot">
				<p class="textBot">Ce site a été créé par Gregory Mbayo<p>
			</div>
		</footer>
	</body>
</html>