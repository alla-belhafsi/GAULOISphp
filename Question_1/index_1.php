<!-- OBJECTIF 1 --- La liste des gaulois triés dans l'ordre alphabétique du nom du personnage -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Question 1</title>
</head>
<body>
<?php
try
{
	// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost;dbname=gaulois;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table recipes
$sqlQuery = 'SELECT personnage.nom_personnage FROM personnage ORDER BY nom_personnage ASC';
$personnageStatement = $mysqlClient->prepare($sqlQuery);
$personnageStatement->execute();
$personnages = $personnageStatement->fetchAll();

// On affiche chaque recette une à une
foreach ($personnages as $personnageData) {
?>
    <p><?php echo $personnageData['nom_personnage']; ?></p>
<?php
}
?>
</body>
</html>