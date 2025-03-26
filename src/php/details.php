<?php 
	/*auteur: grgeory Mabayo
	Description: Projet fil rouger qui consiste à pouvoir chercher des infomations sur les enseigants depuis la base de données
	*/
	include'Database.php';
	$teacherID = $_GET['idTeacher'];
	$database = new Database(); 
	$teacher = $database->getOneTeacher($teacherID);
	$Section = $database->getSectionOfTeacher($teacherID);
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
				<button class="nav-button" onClick="parent.location='index.php';">Acceuil</button>
			</nav>		
		</header>
		<main>
			<div id="mainId">
				<h2>Détails de enseignant</h2>
			</div>
			<div>
				<?php 
					foreach ($teacher as $values) {
						echo "<p>Détails : ".$values["teaFirstname"]." ".$values["teaName"]." // ". $values["teaGender"]."</p>";
						echo "<p>Surnom : ".$values["teaNickname"]."</p>";
						echo "<p>".$values["teaOrigin"]."</p>";
						echo "<p>Section : ".$Section[0]["secName"];
					}
				?>
			</div>
		</main>
		<footer>
			<div id="bot">
				<p class="textBot">Ce site a été créé par Gregory Mbayo<p>
			</div>
		</footer>
	</body>
</html>