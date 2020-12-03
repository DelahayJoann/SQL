<?php
	include './connectDB.php';

	session_start();

if (isset($_SESSION['login'],$_SESSION['pwd'],$_SESSION['editor'])) {
	  echo "TEST PURPOSE: ".$_SESSION['login']." ".$_SESSION['pwd'];
if($_SESSION['editor']){

	if(isset($_POST['name'],$_POST['distance'],$_POST['duration'],$_POST['height_difference'])){
		if (!filter_var($_POST['distance'], FILTER_VALIDATE_INT) || !filter_var($_POST['height_difference'], FILTER_VALIDATE_INT)) {
			echo "<h1 style='color: red;'>Entrez des données correctes!</h1>";
		}
		else{
			($_POST['available'] == 'on') ? $_POST['available'] = 1 : $_POST['available'] = 0;
			$_POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
			$_POST = filter_var_array($_POST,FILTER_SANITIZE_ADD_SLASHES);

			$result = $bdd->query("INSERT INTO hiking VALUES ('','".$_POST['name']."','".$_POST['difficulty']."',".$_POST['distance'].",'".$_POST['duration']."',".$_POST['height_difference'].",".$_POST['available'].")");
			print_r($bdd->errorInfo());
			$result->closeCursor();
			$_POST = array();
			header('Location: create.php');
		}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<br><a href="./read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<?php if (isset($_SESSION['login'],$_SESSION['pwd'],$_SESSION['editor'])) {
	  echo '<p><a href="./logout.php">Logout</a></p>';
	}
    ?>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="number" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="number" name="height_difference" value="">
		</div>
		<div>
			<label for="available">Disponible</label>
			<input type="checkbox" name="available" checked>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
<?php
}
else{
	header('Location: read.php');
}
}
?>