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
    
    <?php
    if (isset($currentUsers['id_membre'])){?>
     
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
            $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
            $like = $get_like ->fetch(PDO::FETCH_ASSOC);
            $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$post[id_cat]'"); 
            $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
            if (isset($_POST[$post['id_post']])){
                $w = $pdo->query("SELECT * FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $post[id_post]");
                // S'il y a un ou plusieurs résultats :
                if($w->rowCount() >= 1) {
                    $pdo->exec("DELETE FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $post[id_post]");
                    $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
                    $like = $get_like ->fetch(PDO::FETCH_ASSOC);
                }
                else{
            
                    $pdo->exec("INSERT INTO reaction (id_post, id_membre, aimer) VALUES ( '$post[id_post]','$currentUsers[id_membre]', 1)");
                    $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
                    $like = $get_like ->fetch(PDO::FETCH_ASSOC);
                }
            }var_dump($like);
            ?> 
            <img src="<?php echo $pseudo['photo_profil'] ?>" alt="" width="200px">

            Fait par <a href="voir_profil.php?id_membre=<?= $post['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a><?php  echo $cat['name_cat']; ?>
</div></div> 
<form method="post">
  <input type="submit" name= "<?php echo $post['id_post']?>" value="like <?php echo implode($like);?>"/>
</form> 
<?php
} }

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
            $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
            $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
            $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$post[id_membre]'"); 
            $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
            $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$post[id_cat]'"); 
            $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
            if (isset($_POST[$event['id_post']])){
                $z = $pdo->query("SELECT * FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $post[id_post]");
                // S'il y a un ou plusieurs résultats :
                if($z->rowCount() >= 1) {
                    $pdo->exec("DELETE FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $post[id_post]");
                    $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
                    $like = $get_like ->fetch(PDO::FETCH_ASSOC);
                }
                else{
            
                    $pdo->exec("INSERT INTO reaction (id_post, id_membre, aimer) VALUES ( '$post[id_post]','$currentUsers[id_membre]', 1)");
                    $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
                    $like = $get_like ->fetch(PDO::FETCH_ASSOC);
                }
            }var_dump($like);
            ?> 
            <img src="<?php echo $pseudo['photo_profil'] ?>" alt="" width="200px">

            Fait par <a href="voir_profil.php?id_membre=<?= $event['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a><?php  echo $cat['name_cat']; ?>
</div></div>  
<form method="post">
  <input type="submit" name= "<?php echo $post['id_post']?>" value="like <?php echo implode($like2);?>"/>
</form>
            <?php
        }
    ?>
<!-- echo $pseudo['pseudo']; -->

</body>
</html>