<?php
    $user = 'root';
    $password = '';
    $bdd = 'citrouille';
    $port = '3306'; 
    $link = mysqli_connect("localhost", $user, $password, $bdd, $port);
    $link->set_charset("utf8");
    mysqli_select_db ($link, $bdd);

    if(isset($_POST['valider']))
    {
        $image_nom = $_FILES['image']['name'];
        $image_taille = $_FILES['image']['size'];
        $image_type = $_FILES['image']['type'];
        $image_blob = $_FILES['image']['tmp_name'];

        $donnees = addslashes(fread(fopen($image_blob, "r"), $image_taille));
        $result = mysqli_query($link, "INSERT INTO image(image_nom, image_taille, image_type, image_blob) VALUES('$image_nom', '$image_taille', '$image_type', '$donnees')");
        $id = mysqli_insert_id($link);
        mysqli_close($link);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
    </head>
    <body>
        <form name="fo" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="900000000"/>
            <input type="file" name="image"/>
            <input type="submit" name="valider" value="Créer"/>
        </form>
    </body>
</html>