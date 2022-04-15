<?php
require "funnction.php";
include('menu-principal.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Page d'accueil</title>
</head>
<body>
    <?php

$user = $_SESSION['membre']["email"] ?? "";
$currentUsers =  getUrrentUser($user);
 var_dump($_SESSION);




    // var_dump($currentUser);
        if(isset($_SESSION['membre'])) {
        
    ?>
        <h2>Bonjour <?php echo $_SESSION['membre']['pseudo'];?> !</h2>
    <?php
    
        
       }
    ?>
    
    <?php
    if (isset($currentUsers['id_membre'])){?>

<h1>Les posts des gens que tu follow:</h1>


<div class="card-annonce-container">    
        <?php
    $x = $pdo->query("SELECT * FROM post WHERE id_membre IN (SELECT id_suivi FROM follow WHERE id_suiveur = $currentUsers[id_membre])");
while ($post = $x-> fetch(PDO::FETCH_ASSOC)){
    $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$post[id_cat]'"); 
    $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
    $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$post[id_membre]'"); 
    $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);

    ?>


    
    <div class='card-annonce' id='card-annonce'>
    
        <div class="cat-auteur">
            <div class="card-cat">
                    <?php echo $cat['name_cat']; ?>
            </div>
            <div class="auteur">
                <img src="<?php echo $pseudo['photo_profil'] ?>" alt="">

                Fait par  &nbsp <a href="voir_profil.php?id_membre=<?= $post['id_membre'] ?>"><?php echo $pseudo['pseudo'];?> </a>
            </div>
            
        </div>
            <div class='card-annonce-titre'>
    
    <?= $post['titre'] ?>
    </div>
    <div class="card-date-adresse">
        <div class="card-adresse">
         <?php echo $post['adresse'];?>   
        </div>
        <div class="card-date">
            <?php echo $post['date_post']?>
        </div>
        
    </div>
    <a class="link-single-post" href="single-post.php?id_post=<?= $post['id_post'] ?>"></a>

    <div><?= nl2br($post['content_post']); ?></div>
                <?php
                
            $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
            $like = $get_like ->fetch(PDO::FETCH_ASSOC);
            if (isset($_POST["first".$post['id_post']])){
                $w = $pdo->query("SELECT * FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $post[id_post]");
                // S'il y a un ou plusieurs résultats :
                if($w->rowCount() >= 1) {
                    $pdo-> exec("DELETE FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $post[id_post]");
                    $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
                    $like = $get_like ->fetch(PDO::FETCH_ASSOC);
                }
                else{
            
                    $pdo-> exec("INSERT INTO reaction (id_post, id_membre, aimer) VALUES ( '$post[id_post]','$currentUsers[id_membre]', 1)");
                    $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
                    $like = $get_like ->fetch(PDO::FETCH_ASSOC);
                }
            }
            ?> 
            <div class="card-participation">
            <form method="post" >
                <input type="submit" name= "<?php echo "first".$post['id_post']?>"  class="button" value="Je participe"/>
            </form>
            <div class= participant>
                <div><?php echo implode($like);?></div>
                <div>participants </div>
            </div>
        </div>
        </div>
            
<?php
}} 

?>
</div>
 <h1> Tous les posts:</h1>

    <!-- affiche les event stockés dans la table post -->
<div class="card-annonce-container">    

    <?php
        $r = $pdo ->query('SELECT * FROM post WHERE date_post>= CURDATE() ORDER BY date_post ASC');
        while ($event = $r-> fetch(PDO::FETCH_ASSOC)) {

            $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$event[id_cat]'"); 
            $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
            $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$event[id_membre]'"); 
            $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);?>
            <div class='card-annonce' id="card-annonce">
            <a class="link-single-post" href="single-post.php?id_post=<?= $event['id_post'] ?>"></a>
            <div class= "cat-auteur">
                <div class="card-cat">
                    <?php echo $cat['name_cat']; ?>
                </div>
                <div class="auteur">
                    <img src="<?php echo $pseudo['photo_profil'] ?>" alt="">

                    Fait par  &nbsp<a href="voir_profil.php?id_membre=<?= $event['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a>
                </div>           
            </div>    
            <div class='card-annonce-titre'>

            <?= $event['titre'] ?>
            </div>
            <div class="card-date-adresse">
                <div class="card-adresse">
                 <?php echo $event['adresse']?>   
                </div>
                <div class="card-date">
                    <?php echo $event['date_post']?>
                </div>
        </div>
            <div><?= nl2br($event['content_post']); ?></div>
            
            <?php
            $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $event[id_post] ");
            $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
        
            if (isset($_POST[$event['id_post']])){
                $z = $pdo->query("SELECT * FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $event[id_post]");
                // S'il y a un ou plusieurs résultats :
                if($z->rowCount() >= 1) {
                    $pdo->exec("DELETE FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $event[id_post]");
                    $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $event[id_post] ");
                    $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
                }
                else{
            
                    $pdo->exec("INSERT INTO reaction (id_post, id_membre, aimer) VALUES ( '$event[id_post]','$currentUsers[id_membre]', 1)");
                    $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $event[id_post] ");
                    $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
                }
            }
            ?> 
            <div class="card-participation">
            <form method="post">
                <input type="submit" name= "<?php echo $event['id_post']?>" class="button" value="Je participe"/>

            </form>
            <div class= participant>
                <div><?php echo implode($like2);?></div>
                <div>participants </div>
            </div>
            </div>
            </div>
            <?php
        }
    ?>
<!-- echo $pseudo['pseudo']; -->
<script src="javascript.js"></script>

</body>
</html>