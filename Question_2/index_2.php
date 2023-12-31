<!-- OBJECTIF 1 --- La liste des villages avec le nombre d'habitants de chaque village (un tableau HTML à 2 colonnes: nom du lieu / nombre d'habitants) -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Question 2</title>
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
    $sqlQuery = 'SELECT 
                 lieu.nom_lieu, 
                 COUNT(personnage.id_personnage) AS nbHabitants 
            FROM lieu
            INNER JOIN personnage ON lieu.id_lieu = personnage.id_lieu
            GROUP BY lieu.id_lieu
            ORDER BY nbHabitants ASC';
$lieuStatement = $mysqlClient->prepare($sqlQuery);
$lieuStatement->execute();
$lieux = $lieuStatement->fetchAll();

// Affichage dans un tableau HTML à deux colonnes
?>

<table>
    <thead>
        <tr>
            <th class="table">Nom du lieu</th>
            <th class="table">Nombre d'habitants</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lieux as $lieu) { ?>
            <tr>
                <td class="tableLieu"><?php echo $lieu['nom_lieu']; ?></td>
                <td class="table"><?php echo $lieu['nbHabitants']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>    
</body>
</html>