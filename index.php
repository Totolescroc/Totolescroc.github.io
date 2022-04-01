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
  

  foreach ($currentUsers as $currentUser) {
    // echo "<pre>";
    var_dump($currentUser);
    // echo "</pre>";
  }

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
            echo $event['titre'] . ' ' . $event['date_post'] . '<br>' . $event['content_post'] . '<br>';
        }
    ?>


<?php
$t = $pdo ->query("SELECT id_post FROM post");
var_dump($t);



if($_POST) {
    
    
    // je gere les pb d'apostrophes :
    // $_POST['commentaire'] = addslashes($_POST['commentaire']);
    //j'envoie les infos dans la base de données :
$pdo->exec("INSERT INTO commentaire (id_membre, id_post, content) VALUES (' $currentUsers[0]', '$_POST[commentaire]')");
}

$x = $pdo ->query('SELECT * FROM commentaire');
while ($event = $x-> fetch(PDO::FETCH_ASSOC)) {
    echo $event['content'] . '<br>';
    
}
?> 

<h3>Commentaire</h3>

<form method="post">
    <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
    <br><br>
    <input type="submit" value="commenter">
</form>