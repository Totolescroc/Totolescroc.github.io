<?php
require ("funnction.php");

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);

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
	<title>Messagerie</title>
</head>
<body>
	<h1>Messagerie</h1>



<?php

if ($_POST) {
	foreach($_POST as $indice => $valeur) {
		$_POST[$indice] = addslashes($valeur);
	}
		$messagerie = [
			'id_from' => $currentUsers['id_membre'],
			'id_to' => $_GET['id_membre'],
			'message' => $_POST['messagerie'],
		];
		$pdo->exec("INSERT INTO messagerie (id_from, id_to, message) VALUES ('$messagerie[id_from]', '$messagerie[id_to]', '$messagerie[message]')");

	}



// var_dump($_POST);
// var_dump($_GET['id_membre']);
// die;
$r = $pdo->query("SELECT * FROM messagerie WHERE id_from = '$currentUsers[id_membre]' AND id_to = '$_GET[id_membre]' OR id_from = '$_GET[id_membre]' AND id_to = '$_GET[id_membre]'");
$get_pseudo_receveur = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$_GET[id_membre]'"); 
$pseudo_receveur = $get_pseudo_receveur-> fetch(PDO::FETCH_ASSOC);
$get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$_GET[id_membre]'"); 
$pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC); 
?>

<div class="top_messagerie_bar">
<img src="<?php echo $pseudo['photo_profil']?>" alt="">
<h2><?php echo $pseudo_receveur['pseudo']; ?></h2>	
</div>
<?php
while ($messagerie = $r-> fetch(PDO::FETCH_ASSOC)){
	$get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$currentUsers[id_membre]'"); 
    $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC); 

	if ($messagerie['id_from'] == $currentUsers['id_membre']) {
		$get_pseudo_sender = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$currentUsers[id_membre]'"); 
		$pseudo_sender = $get_pseudo_sender-> fetch(PDO::FETCH_ASSOC);
		?>

		<div class="message_sender">
			
			<div class="image_sender">
				<img src="<?php echo $pseudo['photo_profil'] ?>" alt="">
			</div>
			<div class="text_sender">
				<p style = "color:red"> <?php echo $messagerie['message'] . "<br>";?></p>
				<p> <?php echo $messagerie['date_message'] . "<br>"; ?></p>
			</div>		
		


		</div>
	<?php
	} elseif ($messagerie['id_from'] == $_GET['id_membre']) {
		$get_pseudo_receveur = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$_GET[id_membre]'"); 
		$pseudo_receveur = $get_pseudo_receveur-> fetch(PDO::FETCH_ASSOC);

	?>
		<div class="message_receveur">
			
			<p style = "color:green"> <?php echo $messagerie['message'] . "<br>";
			echo $messagerie['date_message']; ?></p>
		</div>
				

		
	<?php
	}
}
?>

<form method="post">
    <textarea name="messagerie" id="messagerie" cols="30" rows="4"required></textarea>
    <br><br>
    <input type="submit" name="envoyer" class="button" value="envoyer">


</form>


</body>
</html>

