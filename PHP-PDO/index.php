<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'Joann', 'becode');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

if(isset($_POST['ville'],$_POST['bas'],$_POST['haut'])){
    $result = $bdd->query("INSERT INTO Météo VALUES ('','".$_POST['ville']."', '".$_POST['bas']."','".$_POST['bas']."')");
    $result->closeCursor();
    $_POST = array();
    header('Location: index.php');
}
if(isset($_POST['delete'])){
    $string ='';
    foreach($_POST['delete'] as $elem){
        $string = $string.$elem.',';
    }
    echo substr($string, 0, -1);
    $result = $bdd->query("DELETE FROM Météo WHERE PK_Météo IN (".substr($string, 0, -1).")");
    $result->closeCursor();

    $_POST = array();
    header('Location: index.php');
}

$resultat = $bdd->query('SELECT * FROM Météo');

echo '<form action="" method="post"><table style="border: 1px solid black">';
    echo '<tr>';
        echo '<th style="border: 1px solid black">PK</th>';
        echo '<th style="border: 1px solid black">ville</th>';
        echo '<th style="border: 1px solid black">bas</th>';
        echo '<th style="border: 1px solid black">haut</th>';
        echo '<th style="border: 1px solid black">delete</th>';
    echo '</tr>';
while ($donnees = $resultat->fetch())
{
    echo '<tr>';
        echo '<td style="border: 1px solid black">'.$donnees['PK_Météo'].'</td>';
        echo '<td style="border: 1px solid black">'.$donnees['ville'].'</td>';
        echo '<td style="border: 1px solid black">'.$donnees['bas'].'</td>';
        echo '<td style="border: 1px solid black">'.$donnees['haut'].'</td>';
        echo '<td style="border: 1px solid black"><input type="checkbox" value="'.$donnees['PK_Météo'].'" name="delete[]"></td>';
    echo '</tr>';
}
echo '</table><input type="submit" value="Submit"></form>';

$resultat->closeCursor();

?>
<br><br><br>
<form action="" method="post">
    <label for="ville">Ville:</label>
    <input type="text" id="ville" name="ville"><br><br>
    <label for="bas">Température basse:</label>
    <input type="text" id="bas" name="bas"><br><br>
    <label for="bas">Température haute:</label>
    <input type="text" id="haut" name="haut"><br><br>
    <input type="submit" value="Submit">
</form>
