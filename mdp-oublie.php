<?php
require "funnction.php";
?>

<p>
Vous vous souvenez plus de votre mot de passe, nous avons besoin 
de votre adresse mail lié à votre compte
</p>
<form method="post">
    <input type="text" name="email" id="email" placeholder="Veuillez rentrer votre mail"><br><br>
    <label> Veuillez rentrer votre nouveau mot de passe</label><br>
    <input type="password" name="pwd" id="pwd" placeholder="mot de passe"><br><br>
    <input type="submit" value="envoyer la demande">
</form>

<?php 
if ($_POST) {
    $r = $pdo->query("SELECT * FROM membre WHERE email= '$_POST[email]'");
    if($r->rowCount() >=1) {
        //je stocke toutes les infos sous forme d'array
        $membre= $r->fetch(PDO::FETCH_ASSOC);
        echo "mail verifié";
        ?>
        <?php
        $password = $_POST['pwd'];
        $password = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        $pdo->exec("UPDATE membre SET mdp = '$password' WHERE email= '$_POST[email]'");
        echo "modification effectutée";?>
        <a href="index.php">Se connecter</a>
    <?php
    } else {
    ?>
        <a href="mdp-oublie.php">veuillez rentrer le bon mail;</a>  
    <?php
    }
}
?>