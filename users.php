

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.csss">
    <title>Document</title>
</head>
 <body>
  
 <div class="barre_recherche">

<form action="" method="post">
<input type="text" name="rechercher" id="rechercher" placeholder="rechercher" required>
<input type="submit" class="button" value="Rechercher">
</form>
</div>

<?php 

//affiche les users avec la lettre tapée
if (isset($_POST['rechercher'])) {
    // $getallpseudo =  $pdo ->query("SELECT id_membre, pseudo FROM membre");
    $get_pseudo = $pdo ->query("SELECT id_membre, pseudo, photo_profil FROM membre WHERE pseudo LIKE '%$_POST[rechercher]%'");
        if ($get_pseudo -> rowCount() >= 1 ){
            while ($pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC)) {

                // echo 'reussi';
                ?> 
                <div class="user_name_photo">
                    <img src="<?php echo $pseudo['photo_profil']; ?>" alt="" width="200px">
                    <div>
                        <a href="voir_profil.php?id_membre=<?= $pseudo['id_membre'] ?>"> <?php echo $pseudo['pseudo'] ;?></a>
                    </div> 

                </div>
                
                
                <?php }   
            } else {
                echo "utitilsateur introuvable";
            }      

    };
    // var_dump($pseudo);


?>
<br>
<?php
if (isset($_POST['rechercher'])) {
    // $getallpseudo =  $pdo ->query("SELECT id_membre, pseudo FROM membre");

?>
                <div class="card-annonce-container">   
                    <?php 
                $get_titre = $pdo ->query("SELECT * FROM post WHERE titre LIKE '%$_POST[rechercher]%'");
        if ($get_titre -> rowCount() >= 1 ){
            while ($titre = $get_titre-> fetch(PDO::FETCH_ASSOC)) {
                        $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$titre[id_cat]'"); 
                        $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
                        $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$titre[id_membre]'"); 
                        $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);?>
                        <div class='card-annonce' id="card-annonce">
                        <a class="link-single-post" href="single-post.php?id_post=<?= $titre['id_post'] ?>"></a>
                        <div class= "cat-auteur">
                            <div class="card-cat">
                                <?php echo $cat['name_cat']; ?>
                            </div>
                            <div class="auteur">
                                <img src="<?php echo $pseudo['photo_profil'] ?>" alt="">
            
                                Fait par  &nbsp<a href="voir_profil.php?id_membre=<?= $titre['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a>
                            </div>           
                        </div>    
                        <div class='card-annonce-titre'>
            
                        <?= $titre['titre'] ?>
                        </div>
                        <div class="card-date-adresse">
                            <div class="card-adresse">
                             <?php echo $titre['adresse']?>   
                            </div>
                            <div class="card-date">
                                <?php echo $titre['date_post']?>
                            </div>
                    </div>
                        <div><?= nl2br($titre['content_post']); ?></div>
                        
                        <?php
                        $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $titre[id_post] ");
                        $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
                    
                        if (isset($_POST[$titre['id_post']])){
                            $z = $pdo->query("SELECT * FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $titer[id_post]");
                            // S'il y a un ou plusieurs résultats :
                            if($z->rowCount() >= 1) {
                                $pdo->exec("DELETE FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $titre[id_post]");
                                $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $titre[id_post] ");
                                $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
                            }
                            else{
                        
                                $pdo->exec("INSERT INTO reaction (id_post, id_membre, aimer) VALUES ( '$titre[id_post]','$currentUsers[id_membre]', 1)");
                                $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $titre[id_post] ");
                                $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
                            }
                        }
                        ?> 
                        <div class="card-participation">
                        <form method="post">
                            <input type="submit" name= "<?php echo $titre['id_post']?>" class="button" value="Je participe"/>
            
                        </form>
                        <div class= participant>
                            <div><?php echo implode($like2);?></div>
                            <div>participants </div>
                        </div>
                        </div>
                        </div>
                        <?php
                    }
                ?>
            
            <?php }   
            } else {
                echo "Aucun post n'existe";
            }      


    // var_dump($pseudo);


?>






  <h3>Tous les posts par cat</h3>

<form method="post">
    
    <select name="cat" id="cat" required>
    <?php
    $get_cat = $pdo ->query('SELECT * FROM categorie');

while ($cat = $get_cat-> fetch(PDO::FETCH_ASSOC)) {
?>
    <option value="<?php echo $cat['id_cat'];?>"><?php echo $cat['name_cat'];?></option>
    <?php } ?>
</select>
<input type="submit" name="post_cat" class="button" value="Filtrer">
</form>


<?php
if (isset($_POST['post_cat'])){
 ?>  
    <div class="card-annonce-container">    
    <?php
        $r = $pdo ->query('SELECT * FROM post WHERE date_post>= CURDATE() ORDER BY date_post ASC');
        while ($event = $r-> fetch(PDO::FETCH_ASSOC)) {

            $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$event[id_cat]'"); 
            $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
            $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$event[id_membre]'"); 
            $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);?>
            <div class='card-annonce' id="card-annonce">
            <a class="link-single-post" href="single-post.php?id_post=<?= $event['id_post'] ?>"></a>
            <div class= "cat-auteur">
                <div class="card-cat">
                    <?php echo $cat['name_cat']; ?>
                </div>
                <div class="auteur">
                    <img src="<?php echo $pseudo['photo_profil'] ?>" alt="">

                    Fait par  &nbsp<a href="voir_profil.php?id_membre=<?= $event['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a>
                </div>           
            </div>    
            <div class='card-annonce-titre'>

            <?= $event['titre'] ?>
            </div>
            <div class="card-date-adresse">
                <div class="card-adresse">
                 <?php echo $event['adresse']?>   
                </div>
                <div class="card-date">
                    <?php echo $event['date_post']?>
                </div>
        </div>
            <div><?= nl2br($event['content_post']); ?></div>
            
            <?php
            $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $event[id_post] ");
            $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
        
            if (isset($_POST[$event['id_post']])){
                $z = $pdo->query("SELECT * FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $event[id_post]");
                // S'il y a un ou plusieurs résultats :
                if($z->rowCount() >= 1) {
                    $pdo->exec("DELETE FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $event[id_post]");
                    $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $event[id_post] ");
                    $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
                }
                else{
            
                    $pdo->exec("INSERT INTO reaction (id_post, id_membre, aimer) VALUES ( '$event[id_post]','$currentUsers[id_membre]', 1)");
                    $get_like2 = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $event[id_post] ");
                    $like2 = $get_like2 ->fetch(PDO::FETCH_ASSOC);
                }
            }
            ?> 
            <div class="card-participation">
            <form method="post">
                <input type="submit" name= "<?php echo $event['id_post']?>" class="button" value="Je participe"/>

            </form>
            <div class= participant>
                <div><?php echo implode($like2);?></div>
                <div>participants </div>
            </div>
            </div>
            </div>
            <?php
        }}
    ?>

</body>
</html>