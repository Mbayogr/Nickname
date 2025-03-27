<?php 
		/*	auteur:	Gregory Mbayo	
			Description: Projet fil rouger qui consiste à pouvoir chercher des infomations sur les enseigants depuis la base de données
		*/
	//utilise la base de donnée

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

	include'Database.php';
	$teacherID = $_GET['idTeacher'];
	$database = new Database(); 
	$teacher = $database->getOneTeacher($teacherID);
	$Section = $database->getSectionOfTeacher($teacherID);
 ?>

<!DOCTYPE html>
<html lang="fr">
<!-- affiche les informations sur l'enseignat selectioné-->
	
	<head>	
		<title>Surnom des enseignants</title>
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
					echo "<p>Détails : ".$values["teaFirstName"]." ".$values["teaLastName"]."<p>" ;
					echo "<p>Genre :".$values["teaGender"]."</p>";
					echo "<p>Surnom : ".$values["teaNickName"]."</p>";
					echo "<p>Origine :".$values["teaNickNameOrigine"]."</p>";
					echo "<p>Section : ".$Section[0]["fkSection"];
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