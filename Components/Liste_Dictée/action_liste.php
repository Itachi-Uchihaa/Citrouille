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
	echo "<pre/>";

  	if(isset($_POST['add_liste']))
	{
		mysqli_query($link, "INSERT INTO liste (liste_nom) VALUES ('".$_POST['liste_nom']."')");
        mysqli_query($link, "INSERT INTO mot (mot_nom, liste_id, image_id) VALUES ('".$_POST['mot_nom']."', ".$_POST['liste_id'].", ".$_POST['image_id'].")");
        //mysqli_query($link, "INSERT INTO image (image_nom, image_url) VALUES ('".$_POST['image_nom']."', '".$_POST['image_url']."')");
	}

    if(isset($_POST['modif_liste']))
	{
		mysqli_query($link, "UPDATE employe SET nom='{$_POST['nom']}', `prenom`='{$_POST['prenom']}', `mail_intranet`='{$_POST['mail_intranet']}', `mail_internet`='{$_POST['mail_internet']}', `telephone_civil`='{$_POST['telephone_civil']}', `telephone_militaire`='{$_POST['telephone_militaire']}', `lieu_naissance`='{$_POST['lieu_naissance']}', `id_grade`='{$_POST['grade']}' WHERE id_employe='{$_POST['id_employe']}'");
	}

	if(isset($_POST['delete_liste']))
	{
		mysqli_query($link, "DELETE FROM employe WHERE id_employe='".$_POST['delete_user']."'");
	}

	header("Location:liste_dictee.php");
?>