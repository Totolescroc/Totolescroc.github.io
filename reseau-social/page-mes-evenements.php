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

      <h1>Tes évènements sont ici</h1>

      <nav class='type-participation'>
        <ul>
          <a class='je-participe' href=#><li>Je participe</li></a>
          <a class='peut-etre' href=#><li>Peut-être</li></a>
          <a class='interessant' href=#><li>Intéressant</li></a>
        </ul>
      </nav>

          <!-- Faire en sorte que la div suivante wrap au bout de 2 card par ligne -->
          <div class='container-resume-annonce annonce-je-participe'>
            <?php include('annonce-resume.php');?>        
            <?php include('annonce-resume.php');?>             
            <?php include('annonce-resume.php');?>            
            <?php include('annonce-resume.php');?>             
          </div>

          <div class='container-resume-annonce annonce-peut-etre'>
            <?php include('annonce-resume.php');?>        
            <?php include('annonce-resume.php');?>             
            <?php include('annonce-resume.php');?>            
            <?php include('annonce-resume.php');?>             
          </div>

          <div class='container-resume-annonce annonce-interesse'>
            <?php include('annonce-resume.php');?>        
            <?php include('annonce-resume.php');?>             
            <?php include('annonce-resume.php');?>            
            <?php include('annonce-resume.php');?>             
          </div>
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