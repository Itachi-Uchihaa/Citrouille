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
  mysqli_select_db($link, $bdd);
  ?>
  <?php
  include("../Navbar/navbar.php");
  ?>

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
            foreach ($req_liste as $liste) {
              echo '<td>' . $liste['liste_nom'] . '</td>';
              $req_liste_id = mysqli_query($link, "SELECT * FROM liste NATURAL JOIN mot WHERE liste_id = " . $liste['liste_id']);
              $reponse2 = mysqli_fetch_row($req_liste_id);
              foreach ($req_liste_id as $liste_id) {
                echo '<td>' . $liste_id['mot_nom'] . '</td>';
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