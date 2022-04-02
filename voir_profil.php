<?php
require "funnction.php";
include('header.php');

$id = (int) $_GET['id_membre'];
$afficher_profil = $pdo->query("SELECT * 
FROM membre 
WHERE id_membre = $id",);
$afficher_profil = $afficher_profil->fetch();

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers = getUrrentUser($user);
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
  <input type="submit" name="demander" value="Ajouter en ami"/>
</form>
</body>
</html>

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
