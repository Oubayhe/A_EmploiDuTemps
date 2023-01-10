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
            if(isset($_POST['submit_cours'])) {
                include('connexion.php');
                $id_seance=intval($_POST['submit_cours']);
                $req="SELECT * FROM seance WHERE id_seance=".$id_seance."";
                $result=mysqli_query($link,$req);
                if($data=mysqli_fetch_assoc($result)) {
                    $id_jour=$data['id_jour'];
                    $id_periode=$data['id_periode'];
                    
                    $req1="SELECT * FROM jour WHERE id_jour=".$id_jour."";
                    $resul1=mysqli_query($link,$req1);
                    $data1=mysqli_fetch_assoc($resul1);
                    $nom_jour=$data1['nom_jour'];

                    $req2="SELECT * FROM periode WHERE id_periode=".$id_periode."";
                    $resul2=mysqli_query($link,$req2);
                    $data2=mysqli_fetch_assoc($resul2);
                    $temps_periode=$data2['temps_periode'];
                }
            }
            ?>
    <form action="#" method="post">
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
        </select>

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
        </select>

        <label for="groupe_table">Groupe : </label>
        <select name="groupe_table">
        <?php
            include('connexion.php');
            $sql0="SELECT * FROM groupe_table";
            $result=mysqli_query($link,$sql0);
            while($data=mysqli_fetch_assoc($result)) {
                echo '<option value="'.$data['id_group'].'">'.$data['nom_group'].'</option>';
            }
        ?>
        </select>

        

    </form>
</body>
</html>