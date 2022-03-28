<?php
include('init.php');
?>

<?php
if($_POST) {
    $pdo->exec("INSERT INTO post (titre, date_post, content_post) VALUES ('$_POST[titre]', '$_POST[date_post]', '$_POST[description]')");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonce</title>
</head>

<body>

    <?php echo $content;?>
    <form method="post">
        <label for="titre">Titre de l'annonce</label>
        <br></br>
        <input type="text" name="titre" id="titre" required>
        <br></br>
        <input type="date" name="date_post" id="date_post" required>
        <br></br>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" required>
        <br></br>
        <input type="submit" value="Poster">
    </form>
</body>
</html>

<script>
    //empeche de selectionner date passée
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("date_post")[0].setAttribute('min', today);
</script>