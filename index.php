<?php
require "funnction.php";
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
</head>
<body>
    <?php
//   echo "<pre>";
//     print_r($_SESSION);
//   echo "</pre>";
$user = $_SESSION['membre']["email"] ?? "";

    $currentUsers =  getUrrentUser($user);
    $currentUsers = array($currentUsers);

  

//   foreach ($currentUsers as $currentUser) {
//     echo "<pre>";
//     var_dump($currentUser);
//     echo "</pre>";
//   }

    // var_dump($currentUser);
        if(isset($_SESSION['membre'])) {
    ?>
    	<a href="?action=deconnexion">Déconnexion</a>
		<br>

        <h1>Bonjour <?php echo $_SESSION['membre']['pseudo'];?> !</h1>
    <?php
        } else {
    ?>
        
    <a href="inscription.php">inscription</a>

    -

    <a href="connexion.php">connexion</a>
    <br>
    <?php
       }
    ?>
    <?php
    //affiche les event stockés dans la table post
        $r = $pdo ->query('SELECT * FROM post');
        while ($event = $r-> fetch(PDO::FETCH_ASSOC)) {
?>
            <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
            <div style="color: #666; text-decoration: none; font-size: 28px;"><?= $event['titre'] ?></div>
            <div style="border-top: 2px solid #EEE; padding: 15px 0"><?= nl2br($event['content_post']); ?></div>
            <a href="single-post.php?id_post=<?= $event['id_post'] ?>">Voir plus</a> 
                  
            <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
            <?php
            $get_pseudo = $pdo ->query("SELECT pseudo FROM membre WHERE id_membre = '$event[id_membre]'"); 
            $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);

            ?> 
            Fait par  <?php echo $pseudo['pseudo'];;?> </div></div>  
              
                    <?php
        }
    ?>
<!-- echo $pseudo['pseudo']; -->

</body>
</html>
