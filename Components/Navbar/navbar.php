<?php
require_once "../../fonctions.php";
session_start();
?>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="d-flex flex-grow-1">
        <div>
            <a class="navbar-brand" href="#" style="padding-left: 1em;">
                <img src="../../Images/logo.png" width="60em" alt="">
            </a>
        </div>
        <div>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../Accueil/accueil_Eleve.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Dictées</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mots</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Resultats/resultats_dictee.php">Résultats</a>
                </li>
            </ul>
        </div>
    </div>
    <div>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" style="color: white; font-size: 25px">
                <?php
                    echo "<p>".$_SESSION['role_id']."</p>";

                ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Connexion/deconnexion.php"><i class="fa fa-sign-out-alt fa-2x"></i></a>
            </li>
        </ul>
    </div>
</nav>
