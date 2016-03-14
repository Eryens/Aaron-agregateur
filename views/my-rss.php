<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php'; ?>
<body>
	<?php include 'templates/menu-bar.php' ?>
    <div class="container">
        <div class="panel panel-default" id="rss-panel">
            <div class="panel-body">
				<div class="affiche-boutons">
				<?php
					echo '<p>Bienvenue '. $_SESSION['username'] .' !</p>';
					echo '<form action="index.php" method="get">';
					foreach ($subscriptions as $sub) {
						echo'<button type="submit" class="btn-primary btn" name="action" value="'. $sub[1] .'">'. $sub[0] .'</button><br/>';
					}
					echo '</form>';
				?>
				</div>
                <?php $displayer->displayAll(); ?>

                <div class="container-fluid text-center">
                    <ul class="pager">
                        <li><a href="#pagePrecedente">Page précédente</a></li>
                        <li><a href="#pageSuivante">Page suivante</a></li>
                    </ul>
                </div>
                <div class="container-fluid text-right">
                    <a href="#" title="To Top"><span class="glyphicon glyphicon-chevron-up" id="apropos-glyphicon"></span></a>
                </div>
			</div>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</body>
