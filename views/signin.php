<!DOCTYPE html>
<html lang="en">
<head>
    <title>Aaron</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-override/acceuil.css" id="css-override"/>
</head>
<body>
    <div class="row">
        <?php include 'html-includes/index-headerbar.php' ?>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    if ($taken_email) {
                        echo "<div class=\"alert alert-danger\">
                        Cette adresse mail est déjà utilisée.
                        </div>";
                    }
                    if ($taken_username) {
                        echo "<div class=\"alert alert-danger\">
                        Ce nom d'utilisateur est indisponnible.
                        </div>";
                    }
                    if ($incorrect_password) {
                        echo "<div class=\"alert alert-danger\">
                        Votre mot de passe n'est pas valide (PLACEHOLDER : il doit par exemple faire entre 6 et 8 charactères).
                        </div>";
                    }
                    if ($not_matching_password) {
                        echo "<div class=\"alert alert-danger\">
                        Vos mots de passe ne correspondent pas.
                        </div>";
                    }
                    ?>
                    <h3>Inscription :</h3>
                    <form action="TestInscription.php" method="post">
                        <div class="form-group">
                            <label for="email">Adresse mail :</label>
                            <input type="email" class="form-control input-md" required="required" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pseudo">Pseudo :</label>
                            <input type="text" class="form-control input-md" required="required" name="username" id="pseudo">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mot de passe :</label>
                            <input type="password" class="form-control input-md" required="required" name="password" id="pwd">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Confirmez le mot de passe :</label>
                            <input type="password" class="form-control input-md" required="required" id="conf-pwd">
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox"> J'accepte les <a href="http://mamytwink.com">conditions d'utilisation</a></label>
                        </div>
                        <button type="submit" value="send-signin-request" name="register" class="btn btn-primary">S'inscrire</button>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'html-includes/footer.php' ?>
    </div>
</body>
