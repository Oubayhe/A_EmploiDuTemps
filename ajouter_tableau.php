<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un emploi du Temps</title>
</head>
<body>
    <form action="#" method="post">

        <label for="semesttre">Semesttre : </label>
        <select required name="semesttre">
                    <?php
                    include('connexion.php');
                    $sql0="SELECT * FROM semesttre";
                    $result=mysqli_query($link,$sql0);
                    while($data=mysqli_fetch_assoc($result)) {
                        echo '<option value="'.$data['id_semesttre'].'">'.$data['nom_semesttre'].'</option>';
                    }
                    ?>
        </select><br>
        <label for="filiere">Filière : </label>            
        <select required name="filiere">
        <?php
            include('connexion.php');
            $sql0="SELECT * FROM filiere";
            $result=mysqli_query($link,$sql0);
            while($data=mysqli_fetch_assoc($result)) {
                echo '<option value="'.$data['id_filiere'].'">'.$data['nom_filiere'].'</option>';
            }
        ?>
        </select>  <br>

        <label for="section">Section : </label>            
        <select required name="section">
        <?php
            include('connexion.php');
            $sql0="SELECT * FROM section";
            $result=mysqli_query($link,$sql0);
            while($data=mysqli_fetch_assoc($result)) {
                echo '<option value="'.$data['id_section'].'">'.$data['nom_section'].'</option>';
            }
        ?>
        </select><br>
        
        <input type="submit" value="Créer" name="creer_tableau">
    </form>

    <?php
    include("connexion.php");
    if(isset($_POST['creer_tableau'])) {
        $id_section=$_POST['section'];
        $id_filiere=$_POST['filiere'];
        $id_semesttre=$_POST['semesttre'];
        $req0="SELECT * FROM section WHERE id_section=".$id_section."";
        $result=mysqli_query($link,$sql0);
        if($data=mysqli_fetch_assoc($result)) {
            if (($id_filiere == $data['id_filiere']) && ($id_semesttre == $data['id_semesttre']) ) {
                $req1="INSERT INTO tableaux_tous_emplois (id_tableau, id_semesttre, id_filiere, id_section) VALUES (NULL, $id_semesttre, $id_filiere, $id_section)";
                $result1=mysqli_query($link,$req1);
                if($result1) {
                    $req2="SELECT * FROM tableaux_tous_emplois WHERE id_semesttre=".$id_semesttre." AND id_filiere=".$id_filiere." AND id_section=".$id_section."";
                    $result2=mysqli_query($link,$req2);
                    $dataTab=mysqli_fetch_assoc($result2);
                    $id_tab=$dataTab['id_tableau'];
                    $creerTab="CREATE TABLE tab".$id_tab." (
                        id_tab INT NOT NULL,
                        id_seance INT NOT NULL,
                        id_cours INT NOT NULL,
                        PRIMARY KEY (id_tab, id_seance, id_cours),
                        FOREIGN KEY (id_tab) REFERENCES tableaux_tous_emplois(id_tableau),
                        FOREIGN KEY (id_seance) REFERENCES seance(id_seance),
                        FOREIGN KEY (id_cours) REFERENCES cours(id_cours)
                    );";
                    $resultat=mysqli_query($link,$creerTab);
                    if($resultat) {
                        header('location:ajouter_cours.php');
                    }
                } else {
                    echo "Erreur d'insertions dans la base de données.";
                }
            } else {
                echo "La semesttre ou la filière sélectionnée est n'est pas de le groupe choisit.";
            }
        }

    }
    ?>
</body>
</html>