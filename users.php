<?php
require "funnction.php";
include('header.php');

$user = $_SESSION['membre']["email"] ?? "";

$allusers =  getAllUser($user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
 <body>
  <div>Utilisateurs</div>
  <table>
   <tr>
    <th>Pseudo</th>
    <th>Email</th>
    <th>Voir le profil</th>
   </tr>
   <?php
    
    foreach($allusers as $ap){
    ?>
     <tr>    
      <td><?= $ap['pseudo'] ?></td>
      <td><?= $ap['email'] ?></td>
      <td><a href="voir_profil.php?id_membre=<?= $ap['id_membre'] ?>">Aller au profil</a></td>
     </tr>
    <?php
    }
   ?>
  </table>
 </body>
</html>
