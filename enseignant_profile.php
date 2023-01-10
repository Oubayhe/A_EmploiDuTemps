<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Enseigant</title>
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
	$email = $data['email'];

?>
<div class="c">
	  <div id="left"></div>
	    	<h2>Profile</h2>
	  </div>
 </div>
  


<div id="container1">
	<img id="profil" src="photo/<?php echo "$photo";?>">
	<img id="camera" src="photo/camera.png" ></img>

	<div id="container2">

		<label>Nom:</label>
		<p><?php echo "$nom"; ?></p></br>


		<label>Prenom:</label>
		<p><?php echo "$prenom"; ?></p></br>

		
		<label>Email:</label>
		<p><?php echo "$email"; ?></p>


		<form action="modifier_profile.php" method="post">
       		<button><img  id="pencil" src="photo/pencil.png" ><input style="display: none" type="submit" value="Modifier Profile" name="submit_modifier">Modifier Profile</button>
    	</form>
    	
	</div>
</div>

</body>
</html>
