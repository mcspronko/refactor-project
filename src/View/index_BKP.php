<?php
	foreach($data as $article):
?>
<div>
	<img src="<?php echo $article["image"]; ?>" />
	<h3><?php echo $article["title"]; ?></h3>
	<p><?php echo $article["excerpt"]; ?></p>
</div>
<?php endforeach; ?>