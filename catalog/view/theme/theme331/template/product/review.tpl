<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
<div class="content">
<?php for ($i = 1; $i <= 5; $i++) { ?>
<?php if ($review['rating'] < $i) { ?>
<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x lightStar"></i></span>
<?php } else { ?>
<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
<?php } ?>
  <?php } ?><br/>
  <span class="reviewDate"><?php echo $review['date_added']; ?></span><b><?php echo $review['author']; ?></b><br />
  <br />
  <?php echo $review['text']; ?></div>
<?php } ?>
<?php } else { ?>
<div class="content"><?php echo $text_no_reviews; ?></div>
<?php } ?>
