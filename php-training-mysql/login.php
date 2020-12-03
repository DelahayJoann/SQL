<?php
if (isset($_POST['login']) && isset($_POST['pwd'])) {
    include "connectDB.php";

    $check = $bdd->query("SELECT * FROM users WHERE login = '".$_POST['login']."' AND password = '".sha1($_POST['pwd'])."';");
    $count = 0;

    if($check != false){
        while($donnees = $check->fetch()){
            $count = $count + 1;
            $editor = $donnees['editor'];
        }
    }
   
	if ($count) {
		session_start ();
		
		$_SESSION['login'] = $_POST['login'];
        $_SESSION['pwd'] = sha1($_POST['pwd']);
        $_SESSION['editor'] = $editor;
        
        $check->closeCursor();
		header ('location: read.php');
	}
	else {
		// Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
		echo '<body onLoad="alert(\'Membre non reconnu...\')">';
		// puis on le redirige vers la page d'accueil
		//echo '<meta http-equiv="refresh" content="0;URL=index.htm">';
    }
}
else {
	echo 'Les variables du formulaire ne sont pas déclarées.';
}
?>
<html>
<head>
<title>Formulaire d'identification</title>
</head>

<body>
<p>TEST: admin/admin (est editor) | user/user (n'est pas editor)</p>
<form action="" method="post">
Votre login : <input type="text" name="login">
<br />
Votre mot de passé : <input type="password" name="pwd"><br />
<input type="submit" value="connexion">
</form>

</body>
</html>