<?php
require "funnction.php";
include('header.php');

$user = $_SESSION['membre']["email"] ?? "";

$currentUsers =  getUrrentUser($user);


$get_receveur = $pdo ->query("SELECT DISTINCT(id_to) FROM messagerie WHERE id_from = '$currentUsers[id_membre]'");
while ($receveur = $get_receveur-> fetch(PDO::FETCH_ASSOC)) {
    // var_dump($receveur);
    $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$receveur[id_to]'"); 
    $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
    // var_dump($pseudo);
    ?>
    <div>
    <?php
    echo $pseudo['pseudo'];
    ?>
    <a href="messagerie.php?id_membre=<?= $receveur['id_to'] ?>">Envoyer un message</a>
    </div>

<?php
}
?>

 </body>
</html>

