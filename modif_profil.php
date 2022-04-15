<?php
require "funnction.php";

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);

if (!$currentUsers) {
    header("location:accueil.php");
}
?>



<?php
if (isset($_POST['modif_email'])) {
    $r = $pdo->query("SELECT * FROM membre WHERE email = '$currentUsers[email]' and id_membre != '$currentUsers[id_membre]'");
	// S'il y a un ou plusieurs résultats :
	if ($r->rowCount() >= 1) {
		$erreur .= '<p>Email déjà utilisé.</p>';
	} else {
    $z = $pdo->exec("UPDATE membre SET email = '$_POST[email]' WHERE id_membre = '$currentUsers[id_membre]'");
    echo "Email modifié";
    }
}

if(isset($_POST['modif_pseudo'])){

    if(!preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['modif_pseudo'])) {
    $erreur .= '<p>Format de prénom invalide.</p>';
} else{
    $x = $pdo->exec("UPDATE membre SET pseudo = '$_POST[pseudo]'  WHERE id_membre = '$currentUsers[id_membre] AND '");
    echo "Pseudo modifié";
    echo $currentUsers['pseudo'];
    echo $currentUsers['pseudo'];
    $get_pseudo = $pdo ->query("SELECT pseudo FROM membre WHERE id_membre = '$_SESSION[id_membre]'"); 
    $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
    $_SESSION['pseudo']=$pseudo;
    echo implode($_SESSION['pseudo']);
}  

}  

if (isset($_POST['modif_mdp'])){

    $_POST['modif_mdp'] = password_hash($_POST['modif_mdp'], PASSWORD_DEFAULT);
    $w = $pdo->exec("UPDATE membre SET mdp = '$_POST[mdp]' WHERE id_membre = '$currentUsers[id_membre]'");

    echo "Mot de passe modifié";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier profil</title>
</head>
<body>
<form method="post">
	<label for="pseudo">pseudo</label>
	<input type="text" name="pseudo" id="pseudo">
    <input type="submit" class="button" name="modif_pseudo" value="Modifier">
</form>

<form method="post">
	<label for="email">Adresse mail</label>
	<input type="email" name="email" id="email">
    <input type="submit" class="button" name="modif_email" value="Modifier">
</form>
<form method="post">
	<label for="mdp">Mot de passe</label>
	<input type="password" name="mdp" id="mdp">
    <input type="submit" class="button" name="modif_mdp" value="Modifier">

</form>

<?php include("upload_img.php");?>

</body>
</html>