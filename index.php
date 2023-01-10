<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <title>ENSAK - Emploi du Temps</title>
</head>
<body>
    <form action="#" method="POST">
        <h2>Connexion</h2><br>
        <label for="email">Login:</label> <br>
        <input class="info_input" type="email" name="email" required> <br>
        <label for="password">Password:</label> <br>
        <input class="info_input" type="password" name="password" required> <br>
        <input name="submit" class="submit_input" type="submit" value="Se connecter">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        if(!empty($_POST['email']) && !empty($_POST['password'])) {
            include("connexion.php");
            $email=$_POST['email'];
            $password=$_POST['password'];
            $req="SELECT * FROM utilisateur WHERE email='".$email."' AND password='".$password."'";
            $resultat=mysqli_query($link,$req);
            if($data=mysqli_fetch_assoc($resultat)) {
                session_start();
                $_SESSION['id_utilisateur']=$data['id_utilisateur'];
                header('location:traitement.php');
            } else {
                echo "Email ou mot de passe est incorrecte";
            }
            
        
        } else {
            echo "Vous devez entrez l'email et le mot de passe.";
        }
    }
    ?>
</body>
</html>
