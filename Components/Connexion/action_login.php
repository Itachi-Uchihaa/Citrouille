<?php
session_start();
if(isset($_POST['utilisateur_login']) && isset($_POST['utilisateur_password']))
{
    $db_id = 'root';
    $db_utilisateur_password = '';
    $db_name = 'citrouille';
    $db_host = 'localhost';
    var_dump($db_host, $db_id, $db_utilisateur_password, $db_name);
    $db = mysqli_connect($db_host, $db_id, $db_utilisateur_password, $db_name) or die('Connexion échoué');

    $utilisateur_login = mysqli_real_escape_string($db, htmlspecialchars($_POST['utilisateur_login']));
    $utilisateur_password = mysqli_real_escape_string($db, htmlspecialchars($_POST['utilisateur_password']));

    if($utilisateur_login !== "" && $utilisateur_password !== "")
    {
        $req = "SELECT count(*) FROM utilisateur WHERE utilisateur_login = '".$utilisateur_login."' AND utilisateur_password = '".$utilisateur_password."' ";
        $exec_req = mysqli_query($db, $req);
        $reponse = mysqli_fetch_array($exec_req);
        $count = $reponse['count(*)'];

        if($count != 0) // id et mdp correctes
        {
            $_SESSION['utilisateur_login'] = $utilisateur_login;
            echo"Page accueil existe pas";
            //header('Location: accueil.php');
        }

        else
        {
            header('Location: login.php?erreur=1'); // id ou mdp incorrect
        }
    }

    else
    {
        header('Location: login.php?erreur=2'); // id ou mdp vide
    }
}

else
{
    header('Location: login.php');
}

mysqli_close($db);
?>