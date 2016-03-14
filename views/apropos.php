<!DOCTYPE html>
<html lang="en">
<head>
    <title>Aaron</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap-override/rss-feed.css" id="css-override"/>
</head>
<body>
	<?php include 'templates/menu-bar.php' ?>
    <div class="container">
        <div class="panel panel-default" id="rss-panel">
            <div class="container-fluid text-center">
                <h2>Aaron, votre actualité</h2>
                <h3>A propos</h3>
                <br/>
                <div class="row">
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-paperclip logo-small" id="apropos-glyphicon"></span>
                         <h4>Quel est le but du site ?</h4>
                         <p>Aaron est un agrégateur de flux et permet de suivre des flux RSS personnalisés et mis en page.
                         </p>
                    </div>
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-pencil logo-small" id="apropos-glyphicon"></span>
                        <h4>Cadre de réalisation</h4>
                        <p>Ce site a été réalisé dans le cadre du projet PHP du 3ème semestre du DUT Informatique de l'unniversité d'Aix-en-Provence
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-bold logo-small" id="apropos-glyphicon"></span>
                         <h4>Bootstrap</h4>
                         <p>Etant développé dans une optique "Mobile first", le site utilise Bootstrap afin d'être responsif et efficace.
                         </p>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-ok logo-small" id="apropos-glyphicon"></span>
                        <h4>Validation W3C</h4>
                        <p>Les code HTML et Javascript ainsi que tout le CSS <b>écrit par l'équipe de développement</b> sont valides.
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-user logo-small" id="apropos-glyphicon"></span>
                        <h4>Qui sommes nous ?</h4>
                        <p>Les personnes qui ont participés au développement d'Aaron sont Romain Roux, Hugo Ros, David Saigne, Vivien Scavino et Quentin Villecroze
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-lock logo-small" id="apropos-glyphicon"></span>
                         <h4>Ou vont mes informations ?</h4>
                         <p>Dans la base de données du site les mot de passes sont cryptés et invisible à tous, même aux yeux des administrateurs.
                         </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'templates/footer.php' ?>
</body>
