<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php'; ?>
<body>
	<?php include 'templates/menu-bar.php' ?>
    <div class="container">
        <div class="panel panel-default" id="rss-panel">
            <div class="panel-body">
				<h2>Rediger un article<h2>
	            <form action="#envoyer-article.php" method="post">
					<div class="form-group">
						<label>Titre:</label>
						<input type="text" class="form-control" name="article-titre" id="article-titre">
					</div>
					<div class="form-group">
						<label>Contenu :</label>
						<textarea class="form-control" rows="5" name="article-contenu" id="article-contenu"></textarea>
					</div>
					<div class="form-group">
						<label>Image (URL) :</label>
						<input type="text" class="form-control" name="article-image" id="article-image">
					</div>
					<button type="submit" value="send-publish-request" class="btn btn-primary" name="publish">Publier</button>
				</div>
			</div>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</body>
