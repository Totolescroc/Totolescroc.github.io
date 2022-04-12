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

    <body class='body-commentaire'>
        <div class='back'>
            <button>
                <a href="page-precedente">
                    <img src="image/retour.svg" alt="bouton-retour">
                </a>
            </button>
            <h1>Commentaires</h1>
        </div>

        <div class='dernier-commentaire'>
            <?php include('message-recent.php'); ?>
            <?php include('message-recent.php'); ?>
            <p>'commentaires récents auto'</p>
        </div>

        <div class='page-commentaire-rep'>
            <div class='annonce-commentaire-perso'>
                <img class='photo-utilisateur' src="image/pdp_organisateur_evenement.svg" alt="photo-utilisateur">
                <input type="text" placeholder='Je pense que...'>
                <button>
                    <img src="image/envoyer-defaut.svg" alt="">
                </button>
            </div>
        </div>
    </body>
</html>