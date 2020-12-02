<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'Joann', 'becode');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	if(isset($_POST['name'],$_POST['distance'],$_POST['duration'],$_POST['height_difference'])){

		$result = $bdd->query("UPDATE hiking SET
			name = '".$_POST['name']."',
			difficulty = '".$_POST['difficulty']."',
			distance = ".$_POST['distance'].",
			duration = '".$_POST['duration']."',
			height_difference = ".$_POST['height_difference']."
		WHERE id = ".$_GET['id']."");

		print_r($bdd->errorInfo());
		$result->closeCursor();
		$_POST = array();
		header('Location: read.php');
	}

	$resultat = $bdd->query('SELECT * FROM hiking WHERE id = '.$_GET['id']);
	while ($donnees = $resultat->fetch()){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mise à jour d'une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
	<script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
</head>
<body>
	<a href="./read.php">Liste des données</a>
	<h1>Mettre à jour</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo $donnees['name'] ?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select id="difficulty" name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $donnees['distance'] ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $donnees['duration'] ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $donnees['height_difference'] ?>">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
	<script>
		$('#difficulty option[value="<?php echo $donnees['difficulty'] ?>"]').attr('selected', true)
	</script>
</body>
</html>
	<?php }?>