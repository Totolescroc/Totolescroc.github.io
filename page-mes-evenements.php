<?php
require "funnction.php";

$user = $_SESSION['membre']["email"] ?? "";
$currentUsers = getUrrentUser($user);

if (!$currentUsers) {
  header("location:index.php");
}
?>
<?php include("menu-principal.php")?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>nom-marque - Fil d'actu</title>
    <meta
      name="keywords"
      content="Trouve les personnes idéales pour vivre les évènements que tu veux, quand tu veux, où tu veux. C'est ça 'nom de marque'."
    />
    <meta name="description" content="Vivre des évènements avec les personnes idéales" />
    <meta name="author" content="Océane DERUNES" />
    <link rel="stylesheet" href="style.css"/>
  </head>

  <body class='body-parcourir'>

  <div class='page-parcourir-rechercher'>
        <section class='page-parcourir'>
          <div class='container-card-annonce'>
            <div class='card-annonce'>
              <div class='card-annonce-image-participant'>
                <img src="image/reddit-pixel.jpg" alt="">
                <div class='participant'><span>200</span>participants</div>       
              </div>
              <div class='card-annonce-titre'>
                <span>Catégorie</span> 
                <h2>Titre de l'annonce</h2> 
              </div> 
            </div>
            <div class='card-annonce'></div>            
          </div>
        </section>

        <section class='page-rechercher'>
          <h1>Cherche un de tes évènements</h1>
          <div class='container-form'>
            <form class='recherche'>
              <input class='rech-type-event' type="text" placeholder='balade dans un parc'>
              <input class='rech-lieu' type="text" placeholder='Paris'>
              <button type='submit'>
                <img src="image/icone_rechercher.svg" alt="icone-recherche">
                Rechercher
              </button>
            </form>
          </div>


        </section>
    </div>
      <h1>Tes évènements sont ici</h1>


      <?php
    if (isset($currentUsers['id_membre'])){?>
      <div class="card-annonce-container"> 
<?php
$r = $pdo->query("SELECT * FROM post WHERE id_post IN (SELECT id_post FROM reaction WHERE id_membre = $currentUsers[id_membre])");
while ($post = $r-> fetch(PDO::FETCH_ASSOC)){
    $get_cat = $pdo ->query("SELECT name_cat FROM categorie WHERE id_cat = '$post[id_cat]'"); 
    $cat = $get_cat-> fetch(PDO::FETCH_ASSOC);
?>

<div class='card-annonce'>
    <?php echo $cat['name_cat']; ?>
    <div class='card-annonce-titre'>
    <h2><?= $post['titre'] ?></h2>
    </div>    
    <div><?= nl2br($post['content_post']); ?></div>
    <a href="single-post.php?id_post=<?= $post['id_post'] ?>">Voir plus</a> 
    <?php
                $get_pseudo = $pdo ->query("SELECT pseudo, photo_profil FROM membre WHERE id_membre = '$post[id_membre]'"); 
                $pseudo = $get_pseudo-> fetch(PDO::FETCH_ASSOC);
                $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
                $like = $get_like ->fetch(PDO::FETCH_ASSOC);
                if (isset($_POST["first".$post['id_post']])){
                    $w = $pdo->query("SELECT * FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $post[id_post]");
                    // S'il y a un ou plusieurs résultats :
                    if($w->rowCount() >= 1) {
                        $pdo-> exec("DELETE FROM reaction WHERE id_membre= $currentUsers[id_membre] AND id_post= $post[id_post]");
                        $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
                        $like = $get_like ->fetch(PDO::FETCH_ASSOC);
                    }
                    else{
                
                        $pdo-> exec("INSERT INTO reaction (id_post, id_membre, aimer) VALUES ( '$post[id_post]','$currentUsers[id_membre]', 1)");
                        $get_like = $pdo ->query("SELECT COUNT(id_reaction) FROM reaction WHERE id_post = $post[id_post] ");
                        $like = $get_like ->fetch(PDO::FETCH_ASSOC);
                    }
                }
                ?> 
                <div class="auteur">
                <img src="<?php echo $pseudo['photo_profil'] ?>" alt="" width="200px">
    
                Fait par <a href="voir_profil.php?id_membre=<?= $post['id_membre'] ?>"> <?php echo $pseudo['pseudo'];?> </a>
                </div>
                <form method="post">
                    <input type="submit" name= "<?php echo "first".$post['id_post']?>" value="Nombre de participation : <?php echo implode($like);?>"/>
                </form>
                </div>
                
    <?php
    }} 
    
    ?>



      <!-- Tentative de js pour faire en sorte que la page change au clic sur 'parcourir' ou sur 'rechercher' -->
      <script type="text/javascript">
            $(document).ready (function (){
 
                //On définit ici les ids de toutes les images qui devront suivrent ce comportement  

                let page_parcourir =  document.getElementsByClassName('parcourir');
                let page_rechercher =  document.getElementsByClassName('rechercher');
 
                //On définit l'évenement du clic sur chaque image
                page_parcourir.addEventListener('click', function(){     
                  page_parcourir.innerHTML = "C'est cliqué !";  
                  event.preventDefault();             
                });

                page_rechercher.addEventListener('click', function(){     
                  page_rechercher.innerHTML = "C'est cliqué !";    
                  event.preventDefault();           
                });
 
            });
        </script>
  </body>

</html>