<?php
require "funnction.php";
include('menu-principal.php');
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single post</title>
</head>
<body>

<div class="card-annonce-container">    

<div class='card-annonce'>
    <div class="cat-auteur">
        <div class="card-cat">
            <?php echo $cat['name_cat'];?>
        </div>
        <div class="auteur">
            <img src="<?php echo $pseudo['photo_profil'] ?>" alt="">
            fait par <a href="voir_profil.php?id_membre=<?= $singlesingle['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a>
        </div>
    </div>
        
    <div class='card-annonce-titre'>
        <?= $singlesingle['titre']; ?>
    </div>
    <div class="card-date-adresse">
        <div class="card-adresse">
            <?php echo $singlesingle['adresse'];?>   
        </div>
        <div class="card-date">debute le <?= $singlesingle['date_post'] ?> 
        </div>
    </div>

        <div>
            <?= nl2br($singlesingle['content_post']); ?>
        </div>
    <!-- <input>nombre de like : </div> -->
    <div class="card-participation">
        <form method="post" >
            <input type="submit" name= "<?php echo "first".$post['id_post']?>"  class="button" value="Je participe"/>
        </form>
        <div class= participant>
            <div><?php echo implode($like);?></div>
            <div>participants</div>
        </div>
    </div>
</div>
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

<h3>Commentaire</h3>

<div >
            <form method="post" class="commentaire_form_container">
                <textarea name="commentaire" id="commentaire" cols="30" rows="3"></textarea>
                <input type="submit" name="commenter" class="button" value="commenter">
            </form>
</div>

    <?php
        $com = $pdo ->query("SELECT * FROM commentaire WHERE id_post = '$_GET[id_post]'"); 
        while ($comcom = $com-> fetch(PDO::FETCH_ASSOC)) {  
        // var_dump($comcom); 
    
    $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$comcom[id_membre]'"); 
    $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC); 
    ?> 

<div class="commentaire_container">
    <div class="commentaire_auteur">
        <div class="commentaire_pseudo">
            <img src="<?php echo $pseudo['photo_profil'] ?>" alt="" width="200px">
            <a href="voir_profil.php?id_membre=<?= $comcom['id_membre'] ?>"> <?php echo $pseudo['pseudo']?> </a>   
        </div>
        <div class="commentaire_date">
            <?php echo $comcom['date_com'];?> <br>
        </div> 
    </div>
    <div class="commentaire_content">
        <?php echo $comcom['content'];?> <br><br>
    </div>
</div>    
    

        
    <?php
        }
    ?>
    


</body>
</html>

<?php
include('menu-principal.php');
?>