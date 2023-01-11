<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un cours à l'Emploi du Temps</title>
</head>
<body>
<?php 
        session_start();
            $id_jour=$_SESSION['id_jours'];
            $nom_jour=$_SESSION['nom_jour'];
            $id_periode=$_SESSION['id_periode'];
            $temps_periode=$_SESSION['temps_periode'];
            echo "$nom_jour";
            ?>
    <?php
    include('connexion.php');
    if(isset($_POST['ajouter'])) {
        
        $id_jour=$_SESSION['id_jours'];
        $nom_jour=$_SESSION['nom_jour'];
        $id_periode=$_SESSION['id_periode'];
        $temps_periode=$_SESSION['temps_periode'];
        $id_utilisateur=$_POST['enseignant'];
        $id_group=$_POST['groupe_table'];
        $id_salle=$_POST['salle'];
        $id_module=$_POST['module'];

        // Trouver id_prof :
        $req="SELECT * FROM enseignant WHERE id_utilisateur=".$id_utilisateur."";
        $result=mysqli_query($link,$req);
        $data=mysqli_fetch_assoc($result);
        $id_prof=$data['id_prof'];
        
        // L'insertion de la seance du cours :
        $req1="INSERT INTO cours (id_cours, id_prof, id_group, id_salle, id_module, id_jour, id_periode) VALUES (NULL, $id_prof, $id_group, $id_salle, $id_module, $id_jour, $id_periode) ";
        $result1=mysqli_query($link,$req1);

        // Selection de id_cours:
        $req2="SELECT * FROM cours WHERE id_jour=$id_jour AND id_periode=$id_periode";
        $result2=mysqli_query($link,$req2);
        $data=mysqli_fetch_assoc($result2);
        $id_cours=$data['id_cours'];
       

        // Selection de id_seance :
        $req0="SELECT * FROM seance WHERE id_jour=".$id_jour." AND id_periode=".$id_periode."";
        $result0=mysqli_query($link,$req0);
        $data0=mysqli_fetch_assoc($result0);
        $id_seance=$data0['id_seance'];

        // Selection de id_tab :
        $tableau=$_SESSION['tableau'];
        $id_tab=intval(substr($tableau, 3));

        // L'insertion au tableau d'emploi du temps :
        
        
        $req3="INSERT INTO $tableau (id_tab, id_seance, id_cours) VALUES ($id_tab, $id_seance, $id_cours)";// il faut entrer le nom de tableau
        if($result3=mysqli_query($link,$req3)) {
            header('location:ajouter_cours.php');
            
        } else {
            echo "mochkil f tableau";
        }


    }
    ?>
    <form action="#" method="post">
        
       <h4> Jour : <?php echo "$nom_jour"; ?> Période : <?php echo "$temps_periode"; ?> <br></h4>
        <label for="module">Module : </label>
        <select name="module">
        <?php
            include('connexion.php');
            $sql0="SELECT * FROM module";
            $result=mysqli_query($link,$sql0);
            while($data=mysqli_fetch_assoc($result)) {
                echo '<option value="'.$data['id_module'].'">'.$data['nom_module'].'</option>';
            }
        ?>
        </select><br>

        <label for="enseignant">Enseignant : </label>
        <select name="enseignant">
        <?php
            include('connexion.php');
            $sql0="SELECT * FROM utilisateur WHERE type='ens'";
            $result=mysqli_query($link,$sql0);
            while($data=mysqli_fetch_assoc($result)) {
                echo '<option value="'.$data['id_utilisateur'].'">'.$data['nom'].' '.$data['prenom'].'</option>';
            }
        ?>
        </select><br>

        <label for="groupe_table">Groupe : </label>
        <select name="groupe_table">
        <?php
            include('connexion.php');
            $sql0="SELECT * FROM group_table";
            $result=mysqli_query($link,$sql0);
            while($data=mysqli_fetch_assoc($result)) {
                echo '<option value="'.$data['id_group'].'">'.$data['nom_group'].'</option>';
            }
        ?>
        </select><br>
        <label for="salle">Salle : </label>
        <select name="salle">
        <?php
            include('connexion.php');
            $sql0="SELECT * FROM salle";
            $result=mysqli_query($link,$sql0);
            while($data=mysqli_fetch_assoc($result)) {
                echo '<option value="'.$data['id_salle'].'">'.$data['nom_salle'].'</option>';
            }
        ?>
        </select><br>
        
        <input type="submit" value="Ajouter seance" name="ajouter">

    </form>

    
    
</body>
</html>
