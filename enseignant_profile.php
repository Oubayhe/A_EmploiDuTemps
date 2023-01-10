<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du Temps</title>
</head>
<body>
<?php
include("connexion.php");
session_start();
$id_user=$_SESSION['id_utilisateur'];
$req="SELECT * FROM utilisateur WHERE id_utilisateur=".$id_user."";
$resultat=mysqli_query($link,$req);
$data=mysqli_fetch_assoc($resultat);
$nom=$data['nom'];
$prenom=$data['prenom'];
$photo=$data['photo'];
echo "<p>$nom</p>";
echo "<p>$prenom</p>";
echo "<img width='80px' height='80px' src='photo/$photo'>";
// Modifier profile:?>
    <form action="modifier_profile.php" method="post">
        <input type="submit" value="Modifier" name="submit_modifier">
    </form>
<?php
?>
</body>
</html>