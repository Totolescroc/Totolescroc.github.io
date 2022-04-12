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

    <body class='body-annonce'>
        <?php include("back.php")?>

        <div class='annonce-couverture'>
            <img src="image/reddit-pixel.jpg" alt="">
        </div>

        <div class='horaire-lieu'>
            <div class='horaire'>
                <img src="image/horaire.svg" alt="icone horaire">
                <p>'jour auto' 'date auto' 'annee auto', 'horaire auto'</p>
            </div>
            <div class='lieu'>
                <img src="image/lieu.svg" alt="icone lieu">
                <p>'adresse auto'</p>
            </div>
        </div>

        <div class='organisateur'>
            <img src="image/pdp_organisateur_evenement.svg" alt="">
            <p><span>Nom organisateur</span></p>
        </div>

        <div class='titre-evenement'>
            <h1 class='titre'>Titre de l'évènement</h1>
            <p class='description'> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the... (max 100caractère)</p>
            <button class='participer'>
                Participer
                <img src="image/derouler.svg" alt="">
            </button>
        </div>

        <div class='reponse'>
            <h2>Réponses</h2>
            <div class='rep'>
                <div class='rep-participe'>
                    <p><span>'nb participant auto'</span></p>
                    <p>Paticipants</p>
                </div>
                <div class='rep-peut-etre'>
                    <p><span>'nb peut-être auto'</span></p>
                    <p>Peut-être</p>
                </div>
                <div class='rep-interesse'>
                    <p><span>'nb intéressés auto'</span></p>
                    <p>Intéressés</p>
                </div>
            </div>
            <div class='participant-total'>            
                <p>Partcipants ('total des participants auto')</p>
                <div class='participant-avatar'>
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
            <div class='annonce-commentaire'>            
                <h2>Commentaires</h2>
                <div class='annonce-commentaire-perso'>
                    <img class='photo-utilisateur' src="image/pdp_organisateur_evenement.svg" alt="photo-utilisateur">
                    <input type="text" placeholder='Je pense que...'>
                    <button>
                        <img src="image/envoyer-defaut.svg" alt="">
                    </button>
                </div>
                <h3>Messages épinglés</h3>
                <div class='message-epingle'>
                    <?php include('message-epingle.php'); ?>
                </div>
                <h3>Messages récents</h3>
                <div class='message-recent'>
                    <?php include('message-recent.php'); ?>
                    <?php include('message-recent.php'); ?>
                </div>
            </div>
        </div>
     
        <nav class='annonce-participer'>
            <div class='annonce-participer-cta'>
                <button class='participer'>Participer</button>
            </div>
        </nav>
    </body>
</html>