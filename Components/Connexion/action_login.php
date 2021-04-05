<?php
session_start();
if(!empty($_POST['utilisateur_login']) AND !empty($_POST['utilisateur_password']))
{
    $login=htmlspecialchars($_POST['utilisateur_login']);
    $password= htmlspecialchars($_POST['utilisateur_password']);
    $bdd=mysqli_connect("localhost","root","","citrouille");


    if($bdd)
    {
        $req = "SELECT * FROM utilisateur WHERE utilisateur_login = '".$login."' AND utilisateur_password = '".$password."' ";
        $res = mysqli_query($bdd, $req);
        $num = mysqli_num_rows($res);

        if($num == 1) // id et mdp correctes
        {
            // CONNEXION
            $ligne=mysqli_fetch_array($res); // prends la ligne une
            //var_dump($ligne);
            $_SESSION['utilisateur_login'] = $login;
            $_SESSION['role_id'] = $ligne["role_id"];
            echo $_SESSION['utilisateur_login'];
            if($_SESSION['role_id'] == "2")
            {
                header("location: ../Accueil/accueil_Professeur.php");
            }
            else
            {
                header("location: ../Accueil/accueil_Eleve.php");
            }
            mysqli_free_result($res); // libération de la mémoire des resultats
        }
        else
        {
            header('Location: login.php?erreur=1'); // id ou mdp incorrect
            echo "<script>alert('Votre nom utilisateur ou mot de passe est incorrect')</script>";
        }
    }
    mysqli_close($bdd); // fermeture de la connexion
}
else
{
    echo "<p> probleme de connexion au serveur</p>";
}

?>
