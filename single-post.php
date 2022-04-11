<?php
require "funnction.php";
include('header.php');
?>

<?php

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);

$commentaire =[ 
    'id_membre' => $currentUsers['id_membre'],
    'id_post' => $_GET['id_post'],
];

?>

<?php
$single = $pdo ->query("SELECT * FROM post WHERE id_post = '$_GET[id_post]'"); 
$singlesingle = $single-> fetch(PDO::FETCH_ASSOC);
// echo implode($singlesingle);

$get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$singlesingle[id_membre]'"); 
$pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
// fonctionne mais il faut rafraichir la page pour voir +1 like

$get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $_GET[id_post] ");
$like = $get_like ->fetch(PDO::FETCH_ASSOC);
$get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$singlesingle[id_cat]'"); 
$cat = $get_cat-> fetch(PDO::FETCH_ASSOC);

?>
<?php
if (isset($_POST['like'])){
    $r = $pdo->query("SELECT * FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $_GET[id_post]");
	// S'il y a un ou plusieurs résultats :
	if($r->rowCount() >= 1) {
        $pdo->exec("DELETE FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $_GET[id_post]");
        $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $_GET[id_post] ");
        $like = $get_like ->fetch(PDO::FETCH_ASSOC);
    }
    else{

        $pdo->exec("INSERT INTO reaction (id_post, id_membre, aimer) VALUES ( '$_GET[id_post]','$currentUsers[id_membre]', 1)");
        $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $_GET[id_post] ");
        $like = $get_like ->fetch(PDO::FETCH_ASSOC);
    }
}


?>

<div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
<div style="color: #666; text-decoration: none; font-size: 28px;"><?= $singlesingle['titre']; ?> <?php echo $cat['name_cat'];?>
</div>
<div><a href="voir_profil.php?id_membre=<?= $singlesingle['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a></div>
<img src="<?php echo $pseudo['photo_profil'] ?>" alt="" width="200px">

<div style="border-top: 2px solid #EEE; padding: 15px 0"><?= nl2br($singlesingle['content_post']); ?></div>

<div>debute à <?= $singlesingle['heure_post'] ?> le <?= $singlesingle['date_post']; ?></div>

<!-- <input>nombre de like : </div> -->
<form method="post">
  <input type="submit" name="like" value="like <?php echo implode($like);?>"/>
</form>
</div>



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
    
    $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$comcom[id_membre]'"); 
    $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC); 
    ?> 
    <a href="voir_profil.php?id_membre=<?= $comcom['id_membre'] ?>"> <?php echo $pseudo['pseudo']?> </a></div></div> 

    <div>
        <img src="<?php echo $pseudo['photo_profil'] ?>" alt="" width="200px">

        <?php echo $comcom['date_com'];?> <br>
    </div>
    <div>
        <?php echo $comcom['content'];?> <br><br>
    </div>

        
    <?php
        }
    ?>
    
</div>