<?php
require "funnction.php";

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);

$commentaire =[ 
    'id_membre' => $currentUsers['id_membre'],
    'id_post' => $_GET['id_post'],
];

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);

$commentaire =[ 
    'id_membre' => $currentUsers['id_membre'],
    'id_post' => $_GET['id_post'],
];

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
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
    </head>
    
    <div class='annonce-resume'>
        <!-- affiche le nom de la categorie -->
            <p><?php echo $cat['name_cat'];?></p>
            <!-- affiche le titre  -->
            <h3><?= $singlesingle['titre']; ?></h3>
        <div class='resume-horaire-lieu'>
            <div class='horaire'>
                <img src="image/horaire.svg" alt="icone horaire">
                <!-- affiche la date et lheure du rdv  -->
                <p><?= $singlesingle['heure_post'] ?> le <?= $singlesingle['date_post']; ?></p>
            </div>
            <div class='lieu'>
                <img src="image/lieu.svg" alt="icone lieu">
                <p>'adresse auto'</p>
            </div>
        </div>
        <div class='resume-button'>
            <!-- bouton like/participer -->
        <form method="post">
            <input type="submit" name="like" value="like <?php echo implode($like);?>"/>
        </form>
            <button class='resume-participer'>
                Participer
                <img src="image/derouler.svg" alt="">
            </button>
        </div>
        <div class='resume-participant-total'>
            <div class='resume-participant'>
                <span>'nb auto participants'</span>participants</div>
            <div class='resume-participant-avatar'>
                <div class='avatar avatar1'>
                    <img src="image/pdp_organisateur_evenement.svg" alt="">
                </div>
                <div class='avatar avatar2'>
                    <img src="image/pdp_organisateur_evenement.svg" alt="">
                </div>
                <div class='avatar avatar3'>
                    <img src="image/pdp_organisateur_evenement.svg" alt="">
                </div>                
            </div>
        </div>
    </div>
</html>