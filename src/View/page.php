<?php include 'header.php'; ?>

<h1><?php echo $data['title']; ?></h1>

<?php echo $data['comtent']; ?>

<p><strong>Tags:</strong> <?php foreach ($data['tags'] as $tag) : ?><a href="/tag/<?php echo $tag; ?>"><?php echo $tag; ?></a>, <?php endforeach ?></p>

<?php include 'footer.php'; ?>
