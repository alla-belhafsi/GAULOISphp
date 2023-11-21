<!-- QUESTION 3 --- La liste des personnages + nom de leur spécialité + nom de leur village -->

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
                 personnage.nom_personnage AS nom_personnage,
                 specialite.nom_specialite,
                 lieu.nom_lieu
            FROM personnage
            INNER JOIN lieu ON personnage.id_lieu = lieu.id_lieu
            INNER JOIN specialite ON personnage.id_specialite = specialite.id_specialite
            GROUP BY personnage.id_personnage, specialite.id_specialite, lieu.id_lieu
            ORDER BY personnage.id_personnage';
$personnageStatement = $mysqlClient->prepare($sqlQuery);
$personnageStatement->execute();
$personnages = $personnageStatement->fetchAll();

// Affichage dans un tableau HTML à deux colonnes
?>
<link rel="stylesheet" href="css/style.css">
<table>
    <thead>
        <tr>
            <th class="table">Nom du personnage</th>
            <th class="table">Nom de la spécialité</th>
            <th class="table">Nom du village</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($personnages as $personnage) { ?>
            <tr>
                <td class="table"><?php echo $personnage['nom_personnage']; ?></td>
                <td class="table"><?php echo $personnage['nom_specialite']; ?></td>
                <td class="table"><?php echo $personnage['nom_lieu']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>