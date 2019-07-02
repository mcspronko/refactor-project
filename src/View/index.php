<?php include 'header.php'; ?>

<h1><?php echo (@$tag) ? "&#35;".$tag : "TheJournal.ie"; ?></h1>


<?php
    foreach($data as $article):
?>
<div class="clearfix">
    <div style="float: left; margin-right: 20px;">
        <a href="/article/<?php echo $article['id']; ?>" style="width:230px; height:150px;">
            <img src="<?php echo $article["image"]; ?>" width="230" height="150" style="width:230px; height:150px;" />
        </a>
    </div>
    <div>
        <h4> <a href="/article/<?php echo $article['id']; ?>"><?php echo $article["title"]; ?> </a></h4>
        <p>
            <?php echo $article["excerpt"]; ?>      
        </p>
    </div>
</div>
        <hr>
<?php endforeach; ?>

<?php include 'footer.php'; ?>

