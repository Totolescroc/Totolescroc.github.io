<?php
require "funnction.php";


$id = (int) $_GET['id_membre'];
$afficher_profil = $pdo->query("SELECT * FROM membre WHERE id_membre = $id");
$afficher_profil = $afficher_profil->fetch();

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers = getUrrentUser($user);

if (!$currentUsers) {
  header("location:accueil.php");
}
$get_mesfollows = $pdo->query("SELECT COUNT(id_membre) FROM membre WHERE id_membre IN (SELECT id_suivi FROM follow WHERE id_suiveur = $currentUsers[id_membre])");
$mes_follows = $get_mesfollows-> fetch(PDO::FETCH_ASSOC); 
$get_suiveur = $pdo->query("SELECT COUNT(id_membre) FROM membre WHERE id_membre IN (SELECT id_suiveur FROM follow WHERE id_suivi = $currentUsers[id_membre])");
$suiveur = $get_suiveur-> fetch(PDO::FETCH_ASSOC); 
$get_nb_post = $pdo->query("SELECT COUNT(id_post) FROM post WHERE id_membre =  '$_GET[id_membre]'");
$nb_post = $get_nb_post -> fetch(PDO::FETCH_ASSOC);
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
<div class="profil_info">
    <img src="<?php echo $afficher_profil['photo_profil'] ?>" alt="">
    <h2>Profil de <?= $afficher_profil['pseudo'] ?></h2>
  

</div>
<div class="voir_profil_stat">
    <div class="nb_posts">
        <p><?php echo implode($nb_post);?></p>
        <p>Annonces postées</p>
    </div>
    <div class="nb_followers">
        <p><?php echo implode($suiveur);?></p>
        <p>Followers</p>
    </div>
    <div class="nb_follows">
        <p><?php echo implode($mes_follows);?></p>
        <p>Follows</p>
    </div>
</div>

<form method="post" class="profil_form_container">
      <input type="submit" name="demander" class="button" value="Ajouter en ami"/>
      <a href="messagerie.php?id_membre=<?= $id ?>">Envoyer un message</a>
</form>

<?php
if(isset($_POST['demander'])){
    $erreur = '';
    $r = $pdo->query("SELECT * FROM follow WHERE id_suiveur= $currentUsers[id_membre] AND id_suivi=$id");
	// S'il y a un ou plusieurs résultats :
	if($r->rowCount() >= 1) {
		$erreur .= '<p>deja follow.</p>';
    echo $erreur;
  
	}
  else{

    $pdo->exec("INSERT INTO follow (id_suiveur, id_suivi) VALUES ('$currentUsers[id_membre]', '$id')");
    $content .= '<p>follow validé !</p>';
    echo $content;
  }
}
?>
<h2>Ses annonces:</h2>

<?php
// affiche les post de l'id du profil consulté
?>
<div class="card-annonce-container">

<?php
$r = $pdo->query("SELECT * FROM post WHERE id_membre= $id");
while ($post = $r-> fetch(PDO::FETCH_ASSOC)) {
    ?>

    <div class='card-annonce' id="card-annonce">
        <div class= "cat-auteur">
            <div class="card-cat">
                <?php
                $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$post[id_cat]'"); 
                $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
                echo $cat['name_cat']; ?>
            </div>
            <div class="auteur">
                <?php
                    $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$post[id_membre]'"); 
                    $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
                ?>
                <img src="<?php echo $pseudo['photo_profil'] ?>" alt="">
                Fait par  &nbsp<a href="voir_profil.php?id_membre=<?= $post['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a>   
            </div>
        </div>
    <div class='card-annonce-titre'>
        <?= $post['titre'] ?>
    </div>
    
    <div class="card-date-adresse">
        <div class="card-adresse">
            <?php echo $post['adresse']?>   

        </div>
        <div class="card-date">
            <?php echo $post['date_post']?>

        </div>
    </div>
    <div><?= nl2br($post['content_post']); ?></div>
    <!-- <a href="single-post.php?id_post=<?= $post['id_post'] ?>">Voir plus</a> </div> -->
    <div class= participant>
        <?php
            $pdo->exec("INSERT INTO reaction (id_post, id_membre, aimer) VALUES ( '$post[id_post]','$currentUsers[id_membre]', 1)");
            $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
            $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
            
        ?>
        <div><?php echo implode($like2);?></div>
        <div>participants </div>
    </div>
    </div>
<?php
}
?>

</body>
</html>

<?php
include('menu-principal.php')
?>

