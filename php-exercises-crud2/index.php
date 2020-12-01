<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'Joann', 'becode');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

if(isset($_POST['nom'],$_POST['prenom'],$_POST['datum'])){
    if(isset($_POST['carte'])){
        $_POST['carte'] = 1;
    }else{
        $_POST['carte'] = 0;
    }
    if($_POST['carte'] == 0){$_POST['numero'] = 'NULL';}

    echo "INSERT INTO clients VALUES ('','".$_POST['nom']."', '".$_POST['prenom']."','".$_POST['datum']."',".$_POST['carte'].",".$_POST['numero'].")";

    $result = $bdd->query("INSERT INTO clients VALUES ('','".$_POST['nom']."', '".$_POST['prenom']."','".$_POST['datum']."',".$_POST['carte'].",".$_POST['numero'].")");
    $result->closeCursor();
    $_POST = array();
    header('Location: index.php');
}

if(isset($_POST['nom2'],$_POST['prenom2'],$_POST['datum2'])){
    if(isset($_POST['carte2'])){
        $_POST['carte2'] = 1;
    }else{
        $_POST['carte2'] = 0;
    }
    if($_POST['carte2'] == 0){
        $_POST['numero2'] = 'NULL';
        $result = $bdd->query("INSERT INTO clients VALUES ('','".$_POST['nom2']."', '".$_POST['prenom2']."','".$_POST['datum2']."',".$_POST['carte2'].",".$_POST['numero2'].")");
        $result->closeCursor();
        $_POST = array();
        header('Location: index.php');
    }
    else{
        $result2 = $bdd->query("
            BEGIN;
            INSERT INTO clients (clients.lastName, clients.firstName, clients.birthDate, clients.card, clients.cardNumber)
            VALUES('".$_POST['nom2']."', '".$_POST['prenom2']."','".$_POST['datum2']."',".$_POST['carte2'].",".$_POST['numero2'].");
            INSERT INTO cards (cards.cardNumber, cards.cardTypesId) 
            VALUES(".$_POST['numero2'].",(SELECT cardtypes.id FROM cardtypes WHERE cardtypes.id = ".$_POST['typecard']."));
            COMMIT;
        ");
        $result2->closeCursor();
        $_POST = array();
        header('Location: index.php');

    }  
}
?>
<!-- BEGIN;
INSERT INTO clients (clients.lastName, clients.firstName, clients.birthDate, clients.card, clients.cardNumber)
  VALUES('Ciccone', 'Louise', '1958/08/16', 1, 111111);
INSERT INTO cards (cards.cardNumber, cards.cardTypesId) 
  VALUES(111111,(SELECT cardtypes.id FROM cardtypes WHERE cardtypes.id = 2));
COMMIT; -->



<br><br><br>
<h1>Creation Client seul</h1>
<form action="" method="post">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom"><br><br>

    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom"><br><br>

    <label for="datum">Date de naissance:</label>
    <input type="date" id="datum" name="datum"><br><br>
    
    <input type="checkbox" id="carte" name="carte">
    <label for="carte"> Carte de réduction</label><br><br>
    
    <label for="numero">Numéro de carte</label>
    <input type="number" id="numero" name="numero" min=0 value=0><br><br>

    <input type="submit" value="Submit">
</form>

<hr><hr>

<br><br><br>
<h1>Creation Client + carte (type,...)</h1>
<form action="" method="post">
    <label for="nom2">Nom:</label>
    <input type="text" id="nom2" name="nom2"><br><br>

    <label for="prenom2">Prénom:</label>
    <input type="text" id="prenom2" name="prenom2"><br><br>

    <label for="datum2">Date de naissance:</label>
    <input type="date" id="datum2" name="datum2"><br><br>
    
    <input type="checkbox" id="carte2" name="carte2">
    <label for="carte2"> Carte de réduction</label><br><br>

    <input type="radio" id="tc1" name="typecard" value="1" checked>
    <label for="tc1">Fidélité</label>
    <input type="radio" id="tc2" name="typecard" value="2">
    <label for="tc2">Famille nombreuse</label>
    <input type="radio" id="tc3" name="typecard" value="3">
    <label for="tc3">Etudiant</label>
    <input type="radio" id="tc4" name="typecard" value="4">
    <label for="tc4">Employé</label><br><br>
    
    <label for="numero2">Numéro de carte</label>
    <input type="number" id="numero2" name="numero2" min=0 value=0><br><br>

    <input type="submit" value="Submit2">
</form>

<hr><hr>

<br><br><br>
<h1>Creation spectacle</h1>
<form action="" method="post">
    <label for="nom2">Nom:</label>
    <input type="text" id="nom2" name="nom2"><br><br>

    <label for="prenom2">Prénom:</label>
    <input type="text" id="prenom2" name="prenom2"><br><br>

    <label for="datum2">Date de naissance:</label>
    <input type="date" id="datum2" name="datum2"><br><br>
    
    <input type="checkbox" id="carte2" name="carte2">
    <label for="carte2"> Carte de réduction</label><br><br>

    <input type="radio" id="tc1" name="typecard" value="1" checked>
    <label for="tc1">Fidélité</label>
    <input type="radio" id="tc2" name="typecard" value="2">
    <label for="tc2">Famille nombreuse</label>
    <input type="radio" id="tc3" name="typecard" value="3">
    <label for="tc3">Etudiant</label>
    <input type="radio" id="tc4" name="typecard" value="4">
    <label for="tc4">Employé</label><br><br>
    
    <label for="numero2">Numéro de carte</label>
    <input type="number" id="numero2" name="numero2" min=0 value=0><br><br>

    <input type="submit" value="Submit2">
</form>

<!-- INSERT INTO `shows`(`id`, `title`, `performer`, `date`, `showTypesId`, `firstGenresId`, `secondGenreId`, `duration`, `startTime`)
 VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9]) -->