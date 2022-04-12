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

        <h1>Créé un évènement</h1>

        <div class='creer-evenement-titre-categorie'>
            <input type="text" placeholder="Titre de l'évènement">
            <input type="text" placeholder="Catégorie de l'évènement">
            <p>Date et heure du début de l'événement</p>

            <div class='date'>
                <input placeholder='JJ' type="text">
                <p>/</p>
                <input placeholder='MM' type="text">
                <p>/</p>
                <input placeholder='AAAA' type="text">
            </div>

            <div class='debut'>
                <p>A partir de :</p>
                <input placeholder='20' type="text">
                <p>:</p>
                <input placeholder='00' type="text">          
            </div>

            <div class='fin'>
                <p>Jusqu'à :</p>
                <input placeholder='20' type="text">
                <p>:</p>
                <input placeholder='00' type="text">
            </div>
        </div>

        <div class='creer-evenement-participant'>
            <p>Participants autorisés</p>
            <div class='type-participant'>
                <input type="checkbox">
                <div class='type-participant-detail'>
                    <p>Public</p>
                    <p>Tout le monde</p>
                </div>
            </div>
            <div class='type-participant'>
                <input type="checkbox">
                <div class='type-participant-detail'>
                    <p>Amis</p>
                    <p>Uniquement tes amis</p>
                </div>
            </div>
            <div class='type-participant'>
                <input type="checkbox">
                <div class='type-participant-detail'>
                    <p>Groupe(s)</p>
                    <p>Uniquement certains groupes d'amis</p>
                </div>
            </div>
            <div class='type-participant'>
                <input type="checkbox">
                <div class='type-participant-detail'>
                    <p>Privé</p>
                    <p>Uniquement une liste de personnes définie</p>
                </div>
            </div>
        </div>
  </body>

</html>