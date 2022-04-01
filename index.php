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
?>
            <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px"><a href="xxx/<?= $event['id_post'] ?>" style="color: #666; text-decoration: none; font-size: 28px;"><?= $event['titre'] ?></a><div style="border-top: 2px solid #EEE; padding: 15px 0"><?= nl2br($event['content_post']); ?></div><a href="xxx/<?= $event['id_post'] ?>">Voir plus</a> 
                  <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
                    Fait par  <?php $event['pseudo']?> </div></div>  
              
                    <?php
            // echo $event['titre'] . ' ' . $event['date_post'] . '<br>' . $event['content_post'] . '<br>';
        }
    ?>


<?php
// $commentaire =[ 
//     'id_membre' => $currentUsers['id_membre'],
//     'id_post' => $
//     'titre' => $_POST['titre'],
//     'date_post'=> $_POST['date_post'],
//     'content_post' => $_POST['description'],
//     'heure_post' => $_POST['heure_post']
// ]


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