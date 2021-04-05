<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Connexion</title>
</head>
<body>
    <?php
        $user = 'root';
        $utilisateur_password = '';
        $bdd = 'citrouille';
        $port = '3306';
        $link = mysqli_connect("localhost", $user, $utilisateur_password, $bdd, $port);

        $link->set_charset("utf8");
        mysqli_select_db ($link, $bdd);
    ?>
    <div class="container">
        <div class="logo">
            <i class="fas fa-user"></i>
        </div>
        <div class="tab-body" data-id="connexion">
            <form action="action_login.php" method="POST">
                <div class="row" style="margin-top: 5rem;">
                    <i class="far fa-user"></i>
                    <input type="text" name="utilisateur_login" class="input" placeholder="Identifiant">
                </div>
                <div class="row" style="margin-top: 5rem;"  >
                    <i class="fas fa-lock"></i>
                    <input placeholder="Mot de Passe" type="password" name="utilisateur_password" class="input">
                </div>
                <button class="btn" type="submit">Connexion</button>
                <?php
                if(isset($_GET['erreur']))
                {
                    $err = $_GET['erreur'];

                    if($err == 1 || $err == 2)
                    {
                        echo "<p style='color: #ff0000; text-align: center;'>Identifiant ou Mot de passe incorrect</p>";
                    }
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>
