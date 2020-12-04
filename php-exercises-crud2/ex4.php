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

    if($_POST['carte'] == 0){
        $_POST['numero'] = 'NULL';
        $result = $bdd->query("UPDATE clients SET lastName = '".$_POST['nom']."', firstName = '".$_POST['prenom']."', birthDate = '".$_POST['datum']."', card = 0, cardNumber = NULL WHERE id = ".$_POST['id']."");
        $result->closeCursor();
        $_POST = array();
        header('Location: ex4.php');
    }
    else{
        $result = $bdd->query("
            BEGIN;
            INSERT INTO clients (clients.lastName, clients.firstName, clients.birthDate, clients.card, clients.cardNumber)
            VALUES('".$_POST['nom']."', '".$_POST['prenom']."','".$_POST['datum']."',".$_POST['carte'].",".$_POST['numero'].");
            INSERT INTO cards (cards.cardNumber, cards.cardTypesId) 
            VALUES(".$_POST['numero'].",(SELECT cardtypes.id FROM cardtypes WHERE cardtypes.id = ".$_POST['typecard']."));
            COMMIT;
        ");
        print_r($bdd->errorInfo());
        $result->closeCursor();
        $_POST = array();
        header('Location: ex4.php');
    }

}

if(isset($_POST['searchnom'],$_POST['searchprenom'])){
    $result = $bdd->query("SELECT * FROM clients WHERE lastName ='".$_POST['searchnom']."' AND firstName = '".$_POST['searchprenom']."'");
    $result2 = $bdd->query("SELECT * FROM cardtypes");
    while ($donnees = $result->fetch()){
        $result3 = $bdd->query("SELECT * FROM cards WHERE cardNumber = ".$donnees['cardNumber']."");
        if($result3 != false){
            while ($donnees3 = $result3->fetch()){
                $cardTypesId = $donnees3['cardTypesId'];
            }
        }
        else{
            $cardTypesId = null;
        }
        if($result3 != false)$result3->closeCursor();
?>
<h1>4. Update Client</h1>
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $donnees['id'] ?>">

    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" value="<?php echo $donnees['lastName'] ?>"><br><br>

    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo $donnees['firstName'] ?>"><br><br>

    <label for="datum">Date de naissance:</label>
    <input type="date" id="datum" name="datum" value="<?php echo $donnees['birthDate'] ?>"><br><br>
    
    <input type="checkbox" id="carte" name="carte" <?php if($donnees['card']){ echo "checked";}  ?>>
    <label for="carte"> Carte de réduction</label><br><br>

<?php
    while ($donnees2 = $result2->fetch()){

                if($donnees2['id'] == $cardTypesId){
                    echo '<input type="radio" id="tc'.$donnees2['id'].'" name="typecard" value="'.$donnees2['id'].'" checked >';
                    echo '<label for="tc'.$donnees2['id'].'">'.$donnees2['type'].'</label>';
                }
                else{
                    echo '<input type="radio" id="tc'.$donnees2['id'].'" name="typecard" value="'.$donnees2['id'].'">';
                    echo '<label for="tc'.$donnees2['id'].'">'.$donnees2['type'].'</label>';
                }
        }
?>
    <br><br>
    
    <label for="numero">Numéro de carte</label>
    <input type="number" id="numero" name="numero" min=0 value=<?php echo $donnees['cardNumber'] ?>><br><br>

    <input type="submit" value="Submit">
</form>
<?php
    }
    $result2->closeCursor();
    $result->closeCursor();
}
?>

<h1>4. Search Client</h1>
<form action="" method="post">
    <label for="searchnom">Nom:</label>
    <input type="text" id="searchnom" name="searchnom"><br><br>

    <label for="searchprenom">Prénom:</label>
    <input type="text" id="searchprenom" name="searchprenom"><br><br>

    <input type="submit" value="Submit">
</form>