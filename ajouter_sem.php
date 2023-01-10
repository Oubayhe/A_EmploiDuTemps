<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
</head>
<body>
    <!-- Ajouter une semesttre -->
    <form action="#" method="post">
        <label for="semesttre">Ajouter une Semesttre</label>
        <input type="text" required placeholder="Nom de semesttre" name="sem">
        <input type="submit" value="Ajouter" name="submit-sem">
    </form>
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

    if(isset($_POST['submit-sem'])) {
        $sem=$_POST['sem'];
        $req2="INSERT INTO `semesttre` (`id_semesttre`, `nom_semesttre`) VALUES (NULL, '$sem')";
        if($result=mysqli_query($link,$req2)) {
            echo"La semesttre est ajoutée";
        }
    }
    ?>
</body>
</html>