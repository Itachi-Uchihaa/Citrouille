<?php
session_start(); // On démarre la session AVANT toute chose
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Liste Dictée</title>
  <script src="formapost.js" type="text/javascript"></script>
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


    $tab_mot_img = array(
        array("mot_1", "mot_2"),
        array("image_1", "image_2")
        // array("mot_1", "mot_2", "mot_3", "mot_4", "mot_5", "mot_6", "mot_7", "mot_8", "mot_9", "mot_10"),
        // array("image_1", "image_2", "image_3", "image_4", "image_5", "image_6", "image_7", "image_8", "image_9", "image_10")
    );
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
            <a class="nav-link" href="#">Dictées</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Mots</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Résultats</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="nav justify-content-end">
      <button id="add_liste" name="button_liste" style="margin-right: 10px" onclick="openPopUp(this)">
        <img src="../../Images/icones/add_liste.png" />
      </button>
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
      <div id="popup_add_liste" class="overlay">
        <div class="popup">
          <h2 style="text-align: center;">Création Liste</h2>
          <a style="padding-top:0%; margin-top:0%;" class="close" onclick="closePopUp()">&times;</a>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-manuel" role="tabpanel" aria-labelledby="pills-manuel-tab">
              <form method="POST" enctype="multipart/form-data" action="action_liste.php">
                <ul>
                  <div>
                    <label style="display: block;">Nom Liste</label>
                    <input type="text" name="liste_nom" class="field-style field-full align-none" placeholder="" required>
                  </div>
                  <?php 
                    for ($i = 0; $i < count($tab_mot_img[0]); $i++) {
                      echo "
                        <div style='display: inline-block;'>
                          <label style='display: block; margin-top: 20px;'>Mot " . ($i+1) . "</label>
                          <input type='text' name='" . $tab_mot_img[0][$i] ."' class='field-style field-full align-none' required>
                          <input type='hidden' name='MAX_FILE_SIZE' value='900000000'/>
                          <input type='file' name='" . $tab_mot_img[1][$i] . "'/>
                        </div>
                      ";
                    }
                  ?>
                  </br>
                  </br>
                  <input type="submit" name="add_liste" value="Créer liste" style="margin-top: 2.5rem; margin-left: 60rem;">
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="table-wrapper">
        <table class="table table-bordered table-striped center">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col"></th>
              <th scope="col">Liste Nom</th>
              <th scope="col">Mot 1</th>
              <th scope="col">Mot 2</th>
              <th scope="col">Mot 3</th>
              <th scope="col">Mot 4</th>
              <th scope="col">Mot 5</th>
              <th scope="col">Mot 6</th>
              <th scope="col">Mot 7</th>
              <th scope="col">Mot 8</th>
              <th scope="col">Mot 9</th>
              <th scope="col">Mot 10</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $req_liste = mysqli_query($link, "SELECT * FROM liste");
            $reponse1 = mysqli_fetch_row($req_liste);
            foreach($req_liste as $liste) 
            {
              echo'<tr>
                <td scope="row">
                  <button id='.$liste['liste_id'].' name="button_liste" onclick="openPopUp(this)">
                    <img src="../../Images/icones/pencil.png"/>
                  </button>
                  <div id="popup_'.$liste['liste_id'].'" class="overlay">
                    <div class="popup">';                       
                      echo'<h2 style="margin-bot:0%">'.$liste['liste_nom'].'</h2>
                      <a style="padding-top:0%; margin-top:0%;" class="close" onclick="closePopUp()">&times;</a>
                      <div class=" container">
                        <div class="row row-cols-2">
                          <div class="col">';
                            echo'<form class="form-style-9" method="POST" action="action_liste.php">
                              <ul>
                                <p> 
                                  Liste Nom: <input type="text" name="liste_nom" class="field-style field-full align-none" value="' .$liste['liste_nom'].'" required>
                                </p>
                                <p> 
                                  Mot 1: <input type="text" name="mot_1" class="field-style field-full align-none" value="' .$mot['mot_nom'].'" required>
                                </p>
                                <p> 
                                  Mot 2: <input type="text" name="mot_2" class="field-style field-full align-none" value="' .$mot['mot_nom'].'" required>
                                </p>
                                <p> 
                                  Mot 3: <input type="text" name="mot_3" class="field-style field-full align-none" value="' .$mot['mot_nom'].'" required>
                                </p>
                                <p> 
                                  Mot 4: <input type="text" name="mot_4" class="field-style field-full align-none" value="' .$mot['mot_nom'].'" required>
                                </p>
                                <p> 
                                  Mot 5: <input type="text" name="mot_5" class="field-style field-full align-none" value="' .$mot['mot_nom'].'" required>
                                </p>
                                <p> 
                                  Mot 6: <input type="text" name="mot_6" class="field-style field-full align-none" value="' .$mot['mot_nom'].'" required>
                                </p>
                                <p> 
                                  Mot 7: <input type="text" name="mot_7" class="field-style field-full align-none" value="' .$mot['mot_nom'].'" required>
                                </p>
                                <p> 
                                  Mot 8: <input type="text" name="mot_8" class="field-style field-full align-none" value="' .$mot['mot_nom'].'" required>
                                </p>
                                <p> 
                                  Mot 9: <input type="text" name="mot_9" class="field-style field-full align-none" value="' .$mot['mot_nom'].'" required>
                                </p>
                                <p> 
                                  Mot 10: <input type="text" name="mot_10" class="field-style field-full align-none" value="' .$mot['mot_nom'].'" required>
                                </p>
                                </br>
                                </br>
                                <button name="modif_liste">Modifier liste</button>
                              </ul>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  <form method="POST" action="action_liste.php">
                    <button type="submit" name="delete_liste" value="'.$liste['liste_id'].'">
                      <img src="../../Images/icones/bin.png" />
                    </button>
                  </form>
                </td>
                <td>'.$liste['liste_nom'].'</td>';
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