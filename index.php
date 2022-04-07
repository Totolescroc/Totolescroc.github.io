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
        $get_image = $pdo ->query("SELECT photo_profil FROM membre WHERE id_membre = '$currentUsers[id_membre]'"); 
        $image = $get_image-> fetch(PDO::FETCH_ASSOC);
    ?>
        <img src="<?php echo $image['photo_profil'] ?>" alt="" width="200px">

    <?php
        } else {
    ?>
        
    <a href="inscription.php">inscription</a>

    <a href="mdp-oublie.php">mot de passe oublié</a>

    -

    <a href="connexion.php">connexion</a>
    <br>
    <?php
       }
    ?>
    <h3> Les posts des gens que tu follow:</h3>
    <?php
    $x = $pdo->query("SELECT * FROM post WHERE id_membre IN (SELECT id_suivi FROM follow WHERE id_suiveur = $currentUsers[id_membre])");
while ($post = $x-> fetch(PDO::FETCH_ASSOC)){
    ?>
    <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
    <div style="color: #666; text-decoration: none; font-size: 28px;"><?= $post['titre'] ?></div>
    <div style="border-top: 2px solid #EEE; padding: 15px 0"><?= nl2br($post['content_post']); ?></div>
    <a href="single-post.php?id_post=<?= $post['id_post'] ?>">Voir plus</a> </div>
    <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
            <?php
            $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$post[id_membre]'"); 
            $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
            $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$post[id_cat]'"); 
            $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
            ?> 
            <img src="<?php echo $pseudo['photo_profil'] ?>" alt="" width="200px">

            Fait par <a href="voir_profil.php?id_membre=<?= $post['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a><?php  echo $cat['name_cat']; ?>
</div></div>  
<?php
}

?>
 <h3> Tous les posts:</h3>

    <!-- affiche les event stockés dans la table post -->
    <?php
        $r = $pdo ->query('SELECT * FROM post WHERE date_post>= CURDATE() ORDER BY date_post ASC');
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
        }
    ?>
<!-- echo $pseudo['pseudo']; -->

</body>
</html>
