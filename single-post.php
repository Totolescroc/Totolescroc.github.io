<?php
require "funnction.php";
include('header.php');
?>

<?php
$single = $pdo ->query("SELECT * FROM post WHERE id_post = '$_GET[id_post]'"); 
$singlesingle = $single-> fetch(PDO::FETCH_ASSOC);
// echo implode($singlesingle);

?>

<div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
<div style="color: #666; text-decoration: none; font-size: 28px;"><?= $singlesingle['titre'] ?></div>
<div style="border-top: 2px solid #EEE; padding: 15px 0"><?= nl2br($singlesingle['content_post']); ?></div>
<div>debute à <?= $singlesingle['heure_post'] ?> le <?= $singlesingle['date_post']; ?></div>



<?php

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);

$commentaire =[ 
    'id_membre' => $currentUsers['id_membre'],
    'id_post' => $_GET['id_post'],
];
?>

<?php
if (isset($_POST["commenter"])) {
    	// Je gère les problèmes d'apostrophes pour chaque champs grâce à une boucle :
	foreach($_POST as $indice => $valeur) {
		$_POST[$indice] = addslashes($valeur);
	}
    $pdo->exec("INSERT INTO commentaire (id_membre, id_post, content) VALUES ('$currentUsers[id_membre]', '$_GET[id_post]', '$_POST[commentaire]')");
}
?>

<div>
<h3>Commentaire</h3>

<form method="post">
    <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
    <br><br>
    <input type="submit" name="commenter" value="commenter">
</form>
</div>

<div>
    <?php
        $com = $pdo ->query("SELECT * FROM commentaire WHERE id_post = '$_GET[id_post]'"); 
        while ($comcom = $com-> fetch(PDO::FETCH_ASSOC)) {  
        // var_dump($comcom); 
    ?>
     <?php
    $get_pseudo = $pdo ->query("SELECT pseudo FROM membre WHERE id_membre = '$commentaire[id_membre]'"); 
    $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);  
    echo implode($pseudo);              
    ?>
    <div>
        <?php echo $comcom['date_com'];?> <br>
    </div>
    <div>
        <?php echo $comcom['content'];?> <br><br>
    </div>

        
    <?php
        }
    ?>
    
</div>