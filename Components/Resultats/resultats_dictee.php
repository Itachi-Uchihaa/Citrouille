<!DOCTYPE html>
<html lang="en">
    
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
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Liste</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Note</th>
                    <th scope="col">Appréciation</th>
                </tr>
            </thead>
            <tbody>
                <?php $req = 'SELECT note.note_id, note.liste_id, note.utilisateur_id, note.note_appreciation, liste.liste_nom, utilisateur.utilisateur_nom, utilisateur.utilisateur_prenom, note.note FROM note, liste, utilisateur WHERE note.liste_id = liste.liste_id AND note.utilisateur_id = utilisateur.utilisateur_id';
                $exec_req = mysqli_query($db, $req);
                $reponse = mysqli_fetch_array($exec_req);       
                foreach ($exec_req as $note) {                        
                ?>
                <tr>
                    <th scope="row"><?php echo $note['note_id']; ?></th>
                    <td><?php echo utf8_encode($note['liste_nom']); ?></td>
                    <td><?php echo utf8_encode($note['utilisateur_nom']); ?></td>
                    <td><?php echo utf8_encode($note['utilisateur_prenom']); ?></td>
                    <td><?php echo utf8_encode($note['note']); ?></td>
                    <td><?php echo utf8_encode($note['note_appreciation']); ?></td>
                </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>