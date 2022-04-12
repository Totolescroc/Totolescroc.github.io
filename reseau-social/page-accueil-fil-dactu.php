<?php
require "funnction.php";

$user = $_SESSION['membre']["email"] ?? "";
$currentUsers =  getUrrentUser($user);

if(isset($_SESSION['membre'])) {
?>
  <a href="?action=deconnexion">Déconnexion</a>
<br>

<h1>Bonjour <?php echo $_SESSION['membre']['pseudo'];?> !</h1>
  
<?php
$get_image = $pdo ->query("SELECT photo_profil FROM membre WHERE id_membre = '$currentUsers[id_membre]'"); 
$image = $get_image-> fetch(PDO::FETCH_ASSOC);
?>

<img src="<?php echo $image['photo_profil'] ?>" alt="" width="200px">

<?php
} else {
?> 
  <a href="inscription.php">inscription</a>

  <a href="mdp-oublie.php">mot de passe oublié</a>

  -

  <a href="connexion.php">connexion</a>
  <br>
  <?php
     }
  ?>


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
      <?php include("menu-principal.php")?>

      <nav class='parcourir-rechercher'>
        <ul>
          <a class='parcourir' href=#><li>Parcourir</li></a>
          <a class='rechercher' href=#><li>Rechercher</li></a>
        </ul>
      </nav>

      <div class='page-parcourir-rechercher'>
        <section class='page-parcourir'>
          <h1>Coucou [nom utilisateur], voici les activités du jour</h1>
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
          <h1> Que cherches-tu ?</h1>
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

          <!-- Faire en sorte que la div suivante wrap au bout de 2 card par ligne -->
          <div class='container-card-annonce'>
            <?php include('annonce-card.php');?>        
            <?php include('annonce-card.php');?>          
            <?php include('annonce-card.php');?>          
            <?php include('annonce-card.php');?>        
          </div>
        </section>
      </div>

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