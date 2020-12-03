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