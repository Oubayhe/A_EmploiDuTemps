<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
</head>
<body>
    <?php
    include("connexion.php");
    session_start();
    $id_user=$_SESSION['id_utilisateur'];
    $req="SELECT * FROM utilisateur WHERE id_utilisateur=".$id_user."";
    $resultat=mysqli_query($link,$req);
    $data=mysqli_fetch_assoc($resultat);
    $email=$data['email'];
    $password=$data['password'];
    $nom=$data['nom'];
    $prenom=$data['prenom'];
    $photo=$data['photo'];
    $type=$data['type'];
    ?>
    <form action="#" method="post" enctype="multipart/form-data">
    <label>Photo</label> <br>
        <input class="info_input" type="file" name="fichier"> <br>
        <label for="nom">Nom : </label>
        <input type="text" name="nom" value="<?php echo"$nom"; ?>"><br>
        <label for="prenom">Préom : </label>
        <input type="text" name="prenom" value="<?php echo"$prenom"; ?>"><br>
        <label for="email">Email : </label>
        <input type="email" name="email" value="<?php echo"$email"; ?>"><br>
        <label for="password">Mot de passe : </label>
        <input type="text" name="password" value="<?php echo"$password"; ?>"><br>
        <input type="submit" name="modifier" value="modifier">
    </form>
    <?php
    if(isset($_POST['modifier'])) {
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        
        $fnamePhoto=$nom."_".$prenom;
        if(isset($_FILES['fichier']) and $_FILES['fichier']['error'] == 0) {
            $dossier = 'photo/';
            $temp_name = $_FILES['fichier']['tmp_name'];
            if(!is_uploaded_file($temp_name)) {
                exit("le fichier est untrouvable");
            }
            if($_FILES['fichier']['size'] >= 1000000) {
                exit("Erreur, le fichier est volumineux");
            }
            $infosfichier = pathinfo($_FILES['fichier']['name']);
            $extension_upload = $infosfichier['extension'];
            $extension_upload = strtolower($extension_upload);
            $extension_autorisees = array('png', 'jpeg', 'jpg');
            if(!in_array($extension_upload, $extension_autorisees)) {
                exit("Erreur, Veuillez inserer une image svp (extensions autorisées : png, jpeg, jpg)");
            }
            $nom_photo=$fnamePhoto.".".$extension_upload;
            if(!move_uploaded_file($temp_name, $dossier.$nom_photo)) {
                exit("Problem dans le telechargement de l'image, Ressayer");
            }
            $photo = $nom_photo;
        } else {
            $photo = "inconnu.png";
        }


        $req="UPDATE utilisateur SET nom='".$nom."', prenom='".$prenom."', email='".$email."', password='".$password."', photo='".$photo."' WHERE id_utilisateur=".$id_user."";
        
        if($result=mysqli_query($link,$req)) {
            if($type=='ens') {
                header('location:enseignant_profile.php');
            } else {
                header('location:admin_profile.php');
            }
        }
    }
    ?>
</body>
</html>