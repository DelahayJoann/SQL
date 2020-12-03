<?php
include './connectDB.php';

session_start();

if (isset($_SESSION['login'],$_SESSION['pwd'],$_SESSION['editor'])) {
	  echo "TEST PURPOSE: ".$_SESSION['login']." ".$_SESSION['pwd'];
if($_SESSION['editor']){

if(isset($_POST['delete'])){
    $string ='';
    foreach($_POST['delete'] as $elem){
        $string = $string.$elem.',';
    }
    $result = $bdd->query("DELETE FROM hiking WHERE id IN (".substr($string, 0, -1).")");

    print_r($bdd->errorInfo());
    $result->closeCursor();
    $_POST = array();
    header('Location: read.php');
}

}
else{
	header('Location: read.php');
}
}
