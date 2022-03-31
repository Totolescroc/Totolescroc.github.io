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
    echo "<pre>";
    print_r($currentUser);
    echo "</pre>";
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

    <h3>Commentaire</h3>

    <form method="post">
        <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
        <br><br>
		<input type="submit" value="commenter">
    </form>

    <?php
if(isset($_SESSION['membre']) && $_POST) {


    // je gere les pb d'apostrophes :
    // $_POST['commentaire'] = addslashes($_POST['commentaire']);
    //j'envoie les infos dans la base de données :
    $pdo->exec("INSERT INTO commentaire (content) VALUES ('$_POST[commentaire]')");
}

$x = $pdo ->query('SELECT * FROM commentaire');
while ($commentaire = $x-> fetch(PDO::FETCH_ASSOC)) {
    echo $commentaire['content'] . '<br>';
}
?>
</body>
</html>
