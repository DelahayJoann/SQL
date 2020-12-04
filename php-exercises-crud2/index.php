<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'Joann', 'becode');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}


// Ex1
if(isset($_POST['nom'],$_POST['prenom'],$_POST['datum'])){
    if(isset($_POST['carte'])){
        $_POST['carte'] = 1;
    }else{
        $_POST['carte'] = 0;
    }
    if($_POST['carte'] == 0){$_POST['numero'] = 'NULL';}

    $result = $bdd->query("INSERT INTO clients VALUES ('','".$_POST['nom']."', '".$_POST['prenom']."','".$_POST['datum']."',".$_POST['carte'].",".$_POST['numero'].")");
    print_r($bdd->errorInfo());
    $result->closeCursor();
    $_POST = array();
    header('Location: index.php');
}

// Ex2
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
        print_r($bdd->errorInfo());
        $result2->closeCursor();
        $_POST = array();
        header('Location: index.php');

    }

}

// Ex3
if(isset($_POST['titre'],$_POST['artiste'],$_POST['datu'],$_POST['duree'],$_POST['timer'])){

    $result3 = $bdd->query("INSERT INTO shows VALUES ('','".$_POST['titre']."','".$_POST['artiste']."','".$_POST['datu']."',".$_POST['typespec'].",".$_POST['genre1spec'].",".$_POST['genre2spec'].",'".$_POST['duree']."','".$_POST['timer']."')");
    
    print_r($bdd->errorInfo());
    $result3->closeCursor();
    $_POST = array();
    header('Location: index.php');
}

// Récupère la liste de genre pour filtrer plus facilement
$result = $bdd->query("SELECT * FROM genres ORDER BY genre ASC");
    while($donnees = $result->fetch()){
        $genres[strval($donnees['id'])] = array($donnees['genre'],$donnees['showTypesId']);
    }
$result->closeCursor();
?>

<a href="ex4.php">EXERCICE 4</a>

<br><br><br>
<h1>1. Creation Client seul</h1>
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
<h1>2. Creation Client + carte (type,...)</h1>
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
<h1>3. Creation spectacle + filtrage dropdown</h1>
<form action="" method="post">
    <label for="titre">Nom du spectacle:</label>
    <input type="text" id="titre" name="titre" required><br><br>

    <label for="artiste">Artiste:</label>
    <input type="text" id="artiste" name="artiste" required><br><br>

    <label for="datu">Date:</label>
    <input type="date" id="datu" name="datu" required><br><br>

    <label for="typespec">Type de spectacle:</label>
    <select name="typespec" id="typespec">
<?php

    $result = $bdd->query("SELECT * FROM showtypes");
    while($donnees = $result->fetch()){
        echo '<option value="'.$donnees['id'].'">'.$donnees['type'].'</option>';
    }
    $result->closeCursor();
?>
    </select>
    <label for="genre1spec">Genre 1:</label>
    <select name="genre1spec" id="genre1spec">

    </select>
    <label for="genre2spec">Genre 2:</label>
    <select name="genre2spec" id="genre2spec">

    </select>
    
    <br><br>

    <label for="duree">Durée:</label>
    <input type="time" id="duree" name="duree" step="2" required> heures<br><br>

    <label for="timer">Heure de début:</label>
    <input type="time" id="timer" name="timer" min="09:00" max="23:00" step="2" required><br><br>

    <input type="submit" value="Submit">
</form>

<script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous">
</script>
<script>
// Filter Dropdowns
    $(function () {
        let genre = <?php echo json_encode($genres); ?>

        $("#typespec").change(function (e) {
            $("#genre1spec").empty();
            $("#genre2spec").empty();
            for (const [key, value] of Object.entries(genre)) {
                if(value[1] == this.value){
                    elem = document.createElement('option');
                    elem.setAttribute('value',key);
                    elem.innerHTML = value[0];
                    
                    elem2 = document.createElement('option');
                    elem2.setAttribute('value',key);
                    elem2.innerHTML = value[0];

                    $("#genre1spec").append(elem);
                    $("#genre2spec").append(elem2);
                }
            }
        });
        $("#typespec").trigger( "change" );;
    });
</script>