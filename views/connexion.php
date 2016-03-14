<!DOCTYPE html>
<html lang="en">
<head>
    <title>Aaron</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap-override/acceuil.css" id="css-override"/>
</head>
<body>
    <?php include 'html-includes/index-headerbar.php' ?>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                    if ($connexionReussie) {
                        echo '<div class="alert alert-success">
                                <strong>Connexion réussie !</strong> Vous serez redirigé dans 3 sec
                            </div>';
                    }
                    else if ($connexionReussie === false) {
                        echo "<div class=\"alert alert-danger\">
                            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                            Nom d'utilisateur ou mot de passe incorrect.
                        </div>" ;
                    }
                ?>
                <form action="connexion.php" method="post">
                    <div class="form-group">
                        <label for="email">Adresse mail :</label>
                        <input type="email" class="form-control input-lg" required="required" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mot de passe :</label>
                        <input type="password" class="form-control input-lg" required="required" name="password" id="pwd">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox">Se souvenir de moi</label>
                    </div>
                    <p><a href="TestInscription.php">Inscrivez vous dès maintenant !</a></p>
                    <button type="submit" value="send-login-request" class="btn btn-primary" name="connect">Connexion</button>
                </form>
            </div>
        </div>
    </div>
    <?php include 'html-includes/footer.php' ?>
</body>
