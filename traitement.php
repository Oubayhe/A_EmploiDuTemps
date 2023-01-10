<?php
include("connexion.php");
session_start();
$id_user=$_SESSION['id_utilisateur'];
$req="SELECT * FROM utilisateur WHERE id_utilisateur=".$id_user."";
$resultat=mysqli_query($link,$req);
if($data=mysqli_fetch_assoc($resultat)) {
    if($data['type']=='ens') {
        header('location:enseignant_profile.php');
    } else {
        header('location:admin_profile.php');
    }
}
?>