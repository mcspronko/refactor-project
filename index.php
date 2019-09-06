<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <title>TheJournal.ie</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">

    <h1>TheJournal.ie</h1>

    <?php

    $context = stream_context_create(array(
        'http' => array(
            'header' => "Authorization: Basic ".base64_encode("sample:eferw5wr335£65")
        )
    ));

    $articles = file_get_contents("http://api.thejournal.ie/v3/sample/thejournal", false, $context);

    $articles = json_decode($articles, true);

    foreach ($articles['response']['articles'] as $article) {
        echo "<div class='media'>";

        ?>

        <div class="media-left">
            <img class="media-object" src="<?=$article['images']['river_0']['image']?>">
        </div>

        <div class="media-body">
    
        <?php

        $link = str_replace("http://www.thejournal.ie", "", $article['permalink']);

        echo "<h2><a href='$link'>".$article['title'].'</a></h2>';
        echo "<p>".$article['date']."</p>";
        echo '</div></div>';
    }

    ?>

</div>

<script src="js/vendor/jquery.min.js"></script>

<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>
</html>
