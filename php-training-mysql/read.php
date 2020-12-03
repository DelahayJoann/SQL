<?php
  include './connectDB.php';
  session_start();

  if (isset($_SESSION['login'],$_SESSION['pwd'],$_SESSION['editor'])) {
    echo "TEST PURPOSE: ".$_SESSION['login']." ".$_SESSION['pwd'];
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
    <p><a href="./login.php">Login</a></p>
    <?php if (isset($_SESSION['login'],$_SESSION['pwd'],$_SESSION['editor'])) {
      echo '<p><a href="./logout.php">Logout</a></p>';
      if($_SESSION['editor'])echo '<a href="./create.php">Ajouter des données</a>';
    ?>
    <form action="delete.php" method="post"><table>
    <?php
    $resultat = $bdd->query('SELECT * FROM hiking');
    echo '<tr>';
        echo '<th style="border: 1px solid black">ID</th>';
        echo '<th style="border: 1px solid black">Name</th>';
        echo '<th style="border: 1px solid black">Difficulty</th>';
        echo '<th style="border: 1px solid black">Distance</th>';
        echo '<th style="border: 1px solid black">Duration</th>';
        echo '<th style="border: 1px solid black">Height difference</th>';
        echo '<th style="border: 1px solid black">Available</th>';
       
        if (isset($_SESSION['login'],$_SESSION['pwd'],$_SESSION['editor'])) {
          if($_SESSION['editor']){
            echo '<th style="border: 1px solid black">Update</th>';
            echo '<th style="border: 1px solid black">Delete</th>';
          }
        }
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
            echo ($donnees['available'] == 1) ? '<td style="border: 1px solid black">Yes</td>' : '<td style="border: 1px solid black">No</td>';
            
            if (isset($_SESSION['login'],$_SESSION['pwd'],$_SESSION['editor'])) {
              if($_SESSION['editor']){
                echo '<td style="border: 1px solid black"><a href="./update.php?id='.$donnees['id'].'">update</a></td>';
                echo '<td style="border: 1px solid black"><input type="checkbox" value="'.$donnees['id'].'" name="delete[]"></td>';
              }
            }

        echo '</tr>';
    }
    ?>
    <?php
      if (isset($_SESSION['login'],$_SESSION['pwd'],$_SESSION['editor'])) {
        if($_SESSION['editor']){
          echo '</table><input type="submit" value="Delete"></form>';
        }
      }
    }
    ?>
  </body>
</html>
