<!-- OBJECTIF 1 --- La liste des villages avec le nombre d'habitants de chaque village (un tableau HTML à 2 colonnes: nom du lieu / nombre d'habitants) -->

<?php
try
{
	// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost;dbname=gaulois;charset=utf8', 'root', '');
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
            <th style="border: 1px solid black; padding: 8px; text-align: center;">Nom du lieu</th>
            <th style="border: 1px solid black; padding: 8px; text-align: center;">Nombre d'habitants</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lieux as $lieuData) { ?>
            <tr>
                <td style="border: 1px solid black; padding: 8px;"><?php echo $lieuData['nom_lieu']; ?></td>
                <td style="border: 1px solid black; padding: 8px; text-align: center;"><?php echo $lieuData['nbHabitants']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

