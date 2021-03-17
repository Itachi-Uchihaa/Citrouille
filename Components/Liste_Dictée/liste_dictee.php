<!DOCTYPE html>
<html lang="en">
<?php include("../Navbar/navbar.php") ?>
<?php
$db_id = 'root';
$db_utilisateur_password = '';
$db_name = 'citrouille';
$db_host = 'localhost';
//var_dump($db_host, $db_id, $db_utilisateur_password, $db_name);
$db = mysqli_connect($db_host, $db_id, $db_utilisateur_password, $db_name) or die('Connexion échoué');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats Dictée</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div>
        <table class="table">
            <?php
            $req = 'SELECT * FROM liste, mot WHERE liste.liste_id = mot.liste_id';
            $exec_req = mysqli_query($db, $req);
            $reponse = mysqli_fetch_row($exec_req);
            ?>
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php
                foreach ($exec_req as $dictee) {
                    echo '<td>' . $dictee['mot_nom'] . '</td>';
                }

                echo '</tr>';

                ?>
            </tbody>
        </table>

    </div>
</body>

</html>