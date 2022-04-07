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
  <h3>Tous les posts par cat</h3>
<form method="post">
    
    <select name="cat" id="cat" required>
    <?php
    $get_cat = $pdo ->query('SELECT * FROM categorie');
while ($cat = $get_cat-> fetch(PDO::FETCH_ASSOC)) {
?>
    <option value="<?php echo $cat['id_cat'];?>"><?php echo $cat['name_cat'];?></option>
    <?php } ?>
</select>
<input type="submit" value="Poster">
</form>
 </body>
</html>

<?php
//on affiche tous les postes quand il n'y a rien de poster
if(!$_POST){
    $r = $pdo ->query("SELECT * FROM post WHERE date_post>= CURDATE() ORDER BY date_post ASC");
    while ($event = $r-> fetch(PDO::FETCH_ASSOC)) {
?>
        <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
        <div style="color: #666; text-decoration: none; font-size: 28px;"><?= $event['titre'] ?></div>
        <div style="border-top: 2px solid #EEE; padding: 15px 0"><?= nl2br($event['content_post']); ?></div>
        <a href="single-post.php?id_post=<?= $event['id_post'] ?>">Voir plus</a> 
              
        <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
        <?php
        $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$event[id_membre]'"); 
        $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
        $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$event[id_cat]'"); 
        $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
        ?> 
        <img src="<?php echo $pseudo['photo_profil'] ?>" alt="" width="200px">

        Fait par <a href="voir_profil.php?id_membre=<?= $event['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a><?php  echo $cat['name_cat']; ?>
</div></div> 
    <?php 
    }}
?>


<?php
if($_POST){
   
    $r = $pdo ->query("SELECT * FROM post WHERE date_post>= CURDATE() AND id_cat = '$_POST[cat]'   ORDER BY date_post ASC");
    while ($event = $r-> fetch(PDO::FETCH_ASSOC)) {
?>
        <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
        <div style="color: #666; text-decoration: none; font-size: 28px;"><?= $event['titre'] ?></div>
        <div style="border-top: 2px solid #EEE; padding: 15px 0"><?= nl2br($event['content_post']); ?></div>
        <a href="single-post.php?id_post=<?= $event['id_post'] ?>">Voir plus</a> 
              
        <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
        <?php
        $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$event[id_membre]'"); 
        $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
        $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$event[id_cat]'"); 
        $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
        ?> 
        <img src="<?php echo $pseudo['photo_profil'] ?>" alt="" width="200px">

        Fait par <a href="voir_profil.php?id_membre=<?= $event['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a><?php  echo $cat['name_cat']; ?>
</div></div> 
    <?php 
    }}
?>