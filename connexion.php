<?php
require ("funnction.php");



//si la session membre existe alors je redirige vers l 'acceuil:
if(isset($_SESSION['membre'])) {
    header('location:index.php');
}
//si le form est posté:
if($_POST) {
    //je vérifie si je réupere bien les infos
    // var_dump($_POST);

    //je récupere les infos correspondants à l'email dans la table
    $r = $pdo->query("SELECT * FROM membre where email= '$_POST[email]'");

    //si le nb de résultat est plus grans que 1 , alors le compte existe:
    if($r->rowCount() >=1) {
        //je stocke toutes les infos sous forme d'array
        $membre= $r->fetch(PDO::FETCH_ASSOC);
        // je verifie 
        // print_r($membre);
        //si le mdp correspond à celui présent dans $membre:
        if(password_verify($_POST['mdp'], $membre['mdp'])) {
            //je teste si le mdp fonctionne:
            $content .= '<p>email + MDP : ok</p>';
            //j'enregistre les infos dans la session:
            $_SESSION['membre']['pseudo'] = $membre['pseudo'];
            $_SESSION['membre']['email'] = $membre['email'];

            //je redirige vers la page d'acceuil
            header('location:index.php');

        } else {
            //le mdp est incorrect :
            $content .= '<p>Mot de passe incorrect</p>';
        }
    } else {
        $content .= '<p>compte inexistant</p>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <?php echo $content;?>
    <div class="connexion-form">
        <form method="post">
            <label for="email">Adresse mail</label>
            <input type="email" name="email" id="email" placeholder="email" required>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>