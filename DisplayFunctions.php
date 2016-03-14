<?php

function displayRSS($feed) {
    echo '<h1>'. $feed->title .'</h1><br/>' . "\n";
    echo '<img src="'. $feed->image->url .'"/><br/>' . "\n";
    foreach ($feed->getItems() as $item) {
        $item->display();
    }
}

function displayYoutube($feed) {
    foreach ($feed->getItems() as $item) {
        $item->display();
    }
}

function displayRSSItem($item) {
    echo '<div class="news-container">
					<h2>'. $item->getTitle() .'</h2>
					<p class="article-content">';
    if ($item->getThumbnail() !== null) {
        echo '<img src="'. $item->getThumbnail() .'" alt="AND HIS NAME IS" class="article-img">';
    }
    echo $item->getDescription() .'</p>
        <div class="row">
            <div class="col-sm-6">
                <p class="article-date">'. /*$item->getPubDate()->format(DATE_FORMAT)*/ '</p>
            </div>
            <div class="col-sm-6"><a class="article-source-link" href="'. $item->getLink() .'">Lien vers l\'article</a></div>
        </div>
    </div>';
}

function displayYoutubeItem($item) {
    echo '<h2>' . $item->getTitle() . '</h2><br/>' . "\n";
    echo '<iframe width="560" height="315" src="'. getEmbedUrl($item->getLink()) .'" frameborder="0" allowfullscreen></iframe><br/>' . "\n";
    echo '<p>'. $item->getPubDate()->format(DATE_FORMAT) .'</p><br/>' . "\n";
}
