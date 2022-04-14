<?php
require "funnction.php";


$id = (int) $_GET['id_membre'];
$afficher_profil = $pdo->query("SELECT * 
FROM membre 
WHERE id_membre = $id",);
$afficher_profil = $afficher_profil->fetch();

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers = getUrrentUser($user);

if (!$currentUsers) {
  header("location:accueil.php");
}

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
<h2>Profil de <?= $afficher_profil['pseudo'] . " " . $afficher_profil['email']; ?></h2>
<form method="post">
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
<h3>Ses annonces:</h3>

<?php
// affiche les post de l'id du profil consulté
$r = $pdo->query("SELECT * FROM post WHERE id_membre= $id");
while ($post = $r-> fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div>
    <div><?= $post['titre'] ?></div>
    <div><?= nl2br($post['content_post']); ?></div>
    <a href="single-post.php?id_post=<?= $post['id_post'] ?>">Voir plus</a> </div>
<?php
}
?>
</body>
</html>

<?php
include('menu-principal.php')
?>

