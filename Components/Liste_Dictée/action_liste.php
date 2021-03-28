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
		mysqli_query($link, "INSERT INTO liste (liste_nom) VALUES ('".$_POST['liste_nom']."')");
		$id_liste = mysqli_insert_id($link);

		// Insertion Image & Mot
		$i = 1;
		foreach ($_FILES as $image_name) {
			$image_id = add_Image($image_name['tmp_name'], $image_name['size'],$image_name['name'],$image_name['type'], $link);
			add_Mot($link, $_POST['mot_'.$i], $id_liste, $image_id);
			$i++;
		}
	}
	else{
		echo'ça marche pas :(';
	}

    if(isset($_POST['modif_liste']))
	{
		mysqli_query($link, "UPDATE employe SET nom='{$_POST['nom']}', `prenom`='{$_POST['prenom']}', `mail_intranet`='{$_POST['mail_intranet']}', `mail_internet`='{$_POST['mail_internet']}', `telephone_civil`='{$_POST['telephone_civil']}', `telephone_militaire`='{$_POST['telephone_militaire']}', `lieu_naissance`='{$_POST['lieu_naissance']}', `id_grade`='{$_POST['grade']}' WHERE id_employe='{$_POST['id_employe']}'");
	}

	if(isset($_POST['delete_liste']))
	{
		delete_liste($link, $_POST['delete_liste']);
		//mysqli_query($link, "DELETE FROM employe WHERE id_employe='".$_POST['delete_user']."'");
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
	function add_Image($image_blob, $image_taille, $image_nom, $image_type, $link) {
		$donnees = addslashes(fread(fopen($image_blob, "r"), $image_taille));
        $result = mysqli_query($link, "INSERT INTO image(image_nom, image_taille, image_type, image_blob) 
			VALUES('$image_nom', '$image_taille', '$image_type', '$donnees')");
        return mysqli_insert_id($link);
	}

	function add_Mot($link, $mot, $id_liste, $id_image)
	{
		mysqli_query($link, "INSERT INTO mot (mot_nom, liste_id, image_id) VALUES ('".$mot."', ".$id_liste.", ".$id_image.")");
	}

	function delete_liste($link, $id_liste)
	{
		delete_image_from_liste_id($link, $id_liste);
		mysqli_query($link, "DELETE FROM mot WHERE liste_id =".$id_liste);
		mysqli_query($link, "DELETE FROM liste WHERE liste_id =".$id_liste);
	}

	function delete_image_from_liste_id($link, $liste_id)
	{
		// Recuperation des image_id associe a un id de liste
		$images_id = mysqli_query($link, "SELECT image_id FROM mot WHERE liste_id =".$liste_id);

		// Suppression des images associes a l'id de la liste
		while($value = mysqli_fetch_array($images_id)) 
		{
			mysqli_query($link, "DELETE FROM image WHERE image_id =".$value['image_id']);
		}
	}

	//header("Location:liste_dictee.php");
?>