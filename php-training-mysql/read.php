<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'Joann', 'becode');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <table>
    <?php
    $resultat = $bdd->query('SELECT * FROM hiking');
    echo '<tr>';
        echo '<th style="border: 1px solid black">ID</th>';
        echo '<th style="border: 1px solid black">Name</th>';
        echo '<th style="border: 1px solid black">Difficulty</th>';
        echo '<th style="border: 1px solid black">Distance</th>';
        echo '<th style="border: 1px solid black">Duration</th>';
        echo '<th style="border: 1px solid black">Height difference</th>';
        echo '<th style="border: 1px solid black">Update</th>';
    echo '</tr>';
    while ($donnees = $resultat->fetch())
    {
        echo '<tr>';
            echo '<td style="border: 1px solid black">'.$donnees['id'].'</td>';
            echo '<td style="border: 1px solid black">'.$donnees['name'].'</td>';
            echo '<td style="border: 1px solid black">'.$donnees['difficulty'].'</td>';
            echo '<td style="border: 1px solid black">'.$donnees['distance'].'</td>';
            echo '<td style="border: 1px solid black">'.$donnees['duration'].'</td>';
            echo '<td style="border: 1px solid black">'.$donnees['height_difference'].'</td>';
            echo '<td style="border: 1px solid black"><a href="./update.php?id='.$donnees['id'].'">update</a></td>';
        echo '</tr>';
    }
    ?>
    </table>
  </body>
</html>
