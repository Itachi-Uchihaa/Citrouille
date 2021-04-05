<?php
session_start(); // On démarre la session AVANT toute chose
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Liste Mots</title>
  <link rel="stylesheet" type="text/css" href="formapost.css">
  <script src="jquery.js" type="text/javascript"></script>
  <script src="bootstrap.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
  <?php
    $user = 'root';
    $password = '';
    $bdd = 'citrouille';
    $port = '3306'; 
    $link = mysqli_connect("localhost", $user, $password, $bdd, $port);
    $link->set_charset("utf8");
    mysqli_select_db ($link, $bdd);
  ?>
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
            <a class="nav-link" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Liste Mots</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Dictées</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Résultats</a>
          </li>
        </ul>
      </div>
    </div>
    <div>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="../../Connexion/login.php?deconnexion=true">
              <i class="fa fa-sign-out-alt fa-2x"></i>
            </a>
        </li>
        <?php
          if(isset($_POST['deconnexion']))
          {
            if($_POST['deconnexion']==true)
            {
              session_unset();
              header("location:Connexion/login.php");
            }
          }
          else if($_SESSION['utilisateur_login'] !== "")
          {
            $user = $_SESSION['utilisateur_login'];
          }
        ?>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div id="droite">
      <div class="table-wrapper">
        <table class="table table-bordered table-striped center">
          <thead>
            <tr>
              <th scope="col">Liste Nom</th>
              <th scope="col">Mot 1</th>
              <th scope="col">Mot 2</th>
              <th scope="col">Mot 3</th>
              <th scope="col">Mot 4</th>
              <th scope="col">Mot 5</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $req_liste = mysqli_query($link, "SELECT * FROM liste");
                $reponse1 = mysqli_fetch_row($req_liste);
                foreach($req_liste as $liste) 
                {
                    echo'<td>'.$liste['liste_nom'].'</td>';
                    $req_liste_id = mysqli_query($link, "SELECT * FROM liste NATURAL JOIN mot WHERE liste_id = ".$liste['liste_id']);
                    $reponse2 = mysqli_fetch_row($req_liste_id);
                    foreach($req_liste_id as $liste_id)
                    {
                        echo '<td>'.$liste_id['mot_nom'].'</td>';
                    }
                    echo '</tr>';
                }
            ?>
          </tbody> 
        </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>