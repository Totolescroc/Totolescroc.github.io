<?php
include('init.php');
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
        if(isset($_SESSION['membre'])) {
    ?>
    	<a href="?action=deconnexion">Déconnexion</a>
		<br>

        <h1>Bonjour <?php echo $_SESSION['membre']['pseudo'];?> !</h1>
        <br>
    
            <a href="post.php">Poster</a>
      
        <br>
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
            echo $event['titre'] . ' ' . $event['date_post'] . ' ' . $event['heure_post']. '<br>' . $event['content_post'] . '<br>';
        }
    


?>
<?php
    if(isset($_SESSION['membre']) && $_POST) {
    
    
    // je gere les pb d'apostrophes :
	$_POST['message'] = addslashes($_POST['message']);
    //j'envoie les infos dans la base de données :
    $pdo->exec("INSERT INTO commentaire ( content, date_com) VALUES ('$_POST[message]', NOW())");
}
//je capte rien ici!!!!!! j'esssaye d'afficher les coms avec pseudo
//faire une jointure?

$x = $pdo ->query('SELECT * FROM commentaire');
while ($event = $x-> fetch(PDO::FETCH_ASSOC)) {
    echo $event['content'] . '<br>';

 }
?> 

    <hr>
<form method="post">
    <label for="message">Message</label>
    <textarea name = "message" id="message" placeholder="votre message"></textarea>
    <br><br>
    <input type="submit" value="Poster">
</form> 
</body>
</html>
