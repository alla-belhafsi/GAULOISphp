<!-- OBJECTIF 1 --- La liste des gaulois triés dans l'ordre alphabétique du nom du personnage -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
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

// On affiche chaque personnage un à un
?>
<table>
    <thead>
        <tr>
            <th class="table">Nom du personnage</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($personnages as $personnage) { ?>
            <tr>
                <td class="table"><?php echo $personnage['nom_personnage']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>