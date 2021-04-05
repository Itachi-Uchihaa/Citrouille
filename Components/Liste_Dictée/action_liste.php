<?php
$user = 'root';
$password = ''; //To be completed if you have set a password to root
$bdd = 'citrouille'; //To be completed to connect to a database. The database must exist.
$port = '3306'; //Default must be NULL to use default port
$link = mysqli_connect("localhost", $user, $password, $bdd, $port);
$link->set_charset("utf8");
mysqli_select_db ($link , $bdd );

echo "<pre>";
print_r ($_POST);
print_r ($_FILES);
echo "<pre/>";

if(isset($_POST['add_liste']) && isset($_FILES))
{
    // Insertion Liste
    mysqli_query($link, "INSERT INTO liste(liste_nom) VALUES('".$_POST['liste_nom']."')");
    $id_liste = mysqli_insert_id($link);

    // Insertion Image & Mot
    $i = 1;
    foreach ($_FILES as $image_name)
    {
        $image_id = add_Image($link, $image_name['tmp_name'], $image_name['size'], $image_name['name'], $image_name['type']);
        add_Mot($link, $_POST['mot_'.$i], $id_liste, $image_id);
        $i++;
    }
}

if(isset($_POST['modif_liste']))
{
    $liste_id = $_POST['liste_id'];
    edit_liste($link, $liste_id);
}

if(isset($_POST['delete_liste']))
{
    delete_liste($link, $_POST['delete_liste']);
}


/**
 * Add new image in database
 * @param $image_blob : image tmp name
 * @param ...
 * @param ...
 * @param ...
 * @param ...
 * @return $id last insertion in database
 */
function add_Image($link, $image_blob, $image_taille, $image_nom, $image_type)
{
    $donnees = addslashes(fread(fopen($image_blob, "r"), $image_taille));
    $result = mysqli_query($link, "INSERT INTO image(image_nom, image_taille, image_type, image_blob) 
			VALUES('$image_nom', '$image_taille', '$image_type', '$donnees')");
    return mysqli_insert_id($link);
}

function add_Mot($link, $mot, $id_liste, $id_image)
{
    mysqli_query($link, "INSERT INTO mot(mot_nom, liste_id, image_id) VALUES('".$mot."', ".$id_liste.", ".$id_image.")");
}

function delete_liste($link, $id_liste)
{
    delete_image_from_liste_id($link, $id_liste);
    mysqli_query($link, "DELETE FROM mot WHERE liste_id = ".$id_liste);
    mysqli_query($link, "DELETE FROM liste WHERE liste_id = ".$id_liste);
}

function delete_image_from_liste_id($link, $liste_id)
{
    // Recuperation des image_id associe a un id de liste
    $images_id = mysqli_query($link, "SELECT image_id FROM mot WHERE liste_id = ".$liste_id);

    // Suppression des images associes a l'id de la liste
    while($value = mysqli_fetch_array($images_id))
    {
        mysqli_query($link, "DELETE FROM image WHERE image_id = ".$value['image_id']);
    }
}

function edit_liste($link, $liste_id)
{
    mysqli_query($link, "UPDATE liste SET liste_nom = '".$_POST['liste_nom']."' WHERE liste_id = ".$liste_id);

    for($i = 0; $i < count($_POST['mot']); $i++)
    {
        edit_mot_from_liste_id($link, $liste_id, $_POST['mot'][$i], $_POST['mot_id'][$i]);
        if (isset($_FILES[$_POST['image_id'][$i]]['name']) && !empty($_FILES[$_POST['image_id'][$i]]['name']))
        {
            $donnees = addslashes(fread(fopen($_FILES[$_POST['image_id'][$i]]['tmp_name'], "r"), $_FILES[$_POST['image_id'][$i]]['size']));

            mysqli_query($link, "UPDATE image SET image_nom = '".$_FILES[$_POST['image_id'][$i]]['name']."', 
					image_taille = '".$_FILES[$_POST['image_id'][$i]]['size']."', 
					image_type = '".$_FILES[$_POST['image_id'][$i]]['type']."', 
					image_blob = '".$donnees."' 
					WHERE image_id = ".$_POST['image_id'][$i]);
        }
    }
}

function edit_mot_from_liste_id($link, $liste_id, $mot_nom, $mot_id)
{
    mysqli_query($link, "UPDATE mot SET mot_nom = '". $mot_nom ."' WHERE mot_id = ".$mot_id);
}

header("Location:liste_dictee.php");
?>
