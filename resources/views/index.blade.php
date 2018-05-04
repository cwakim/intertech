<?php
  foreach($returnData as $post)
  {
?>
  <h3><?php echo $post['title'] ?></h3>
  <h2>Magnitude: <?php echo $post['magnitude'] ?></h2>
  <h2>Score: <?php echo $post['score'] ?></h2>
  <div>
    <p><img src="<?php echo $post['image'] ?>" /></p>
    <?php echo $post['body'] ?>
  </div>
<?php
  }
?>
