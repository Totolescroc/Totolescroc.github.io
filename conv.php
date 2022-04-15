<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Conversation</title>
</head>
<body>

<h2>Vos messages</h2>

<?php
require "funnction.php";
include('menu-principal.php');

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);

if (!$currentUsers) {
    header("location:accueil.php");
}


$get_receveur = $pdo ->query("SELECT DISTINCT(id_to)  FROM messagerie WHERE id_from = '$currentUsers[id_membre]'");






$get_sender = $pdo ->query("SELECT DISTINCT(id_from) FROM messagerie WHERE id_to = '$currentUsers[id_membre]'");

while ($sender = $get_sender-> fetch(PDO::FETCH_ASSOC)) {


// var_dump($receveur);
$get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$sender[id_from]'"); 
$pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
$get_last_message = $pdo -> query("SELECT * FROM messagerie WHERE id_to = '$currentUsers[id_membre]' AND id_from = '$sender[id_from]' OR id_to = '$sender[id_from]' AND id_from = '$currentUsers[id_membre]' ORDER BY date_message DESC");
$last_message = $get_last_message -> fetch(PDO::FETCH_ASSOC);
// var_dump($pseudo);
?>

<div class ="conv_all_message">

<div class="conv_img">
<img src="<?php echo $pseudo['photo_profil'] ?>" alt="">
</div>
<div class ="conv_pseudo_message">
<div class="conv_pseudo">
    <?php echo $pseudo['pseudo']; ?>
</div>
<div class ="conv_message">
    <?php echo $last_message['message']; ?>
</div>
</div>
<a href="messagerie.php?id_membre=<?= $sender['id_from'] ?>" class="link_messagerie"></a>
</div>

<?php
}
?>

<script src="javascript.js"></script>
 </body>
</html>

