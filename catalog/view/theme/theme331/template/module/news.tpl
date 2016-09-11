<?php
// News Module for Opencart v1.5.5, modified by villagedefrance (contact@villagedefrance.net)
?>

<?php if ($news) { ?>
		<h3>Новости</h3>
<?php if($box) { ?>
<?php foreach (array_chunk($news, 2) as $news_list) { ?>
<div class="row">
	<?php foreach ($news_list as $news_item) { ?>
	<div class="product-layout product-list col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="divider"></div>
		<div class="product-thumb row">
			<div class="image col-md-5 col-sm-5 col-xs-12"><a href="<?php echo $news_item['href']; ?>"><img src="<?php echo $news_item['thumb']; ?>" alt="<?php echo $news_item['title']; ?>" title="<?php echo $news_item['title']; ?>" class="img-responsive" /></a></div>
			<div class="col-md-7 col-sm-7 col-xs-12">
				<div class="caption">
					<span class="news-date"><?php echo $news_item['posted']; ?></span> <br>
					<p class="news-header"><?php echo $news_item['title']; ?></p>
					<p class="description"><?php echo $news_item['description']; ?></p>
					<button type="button" class="btn btn-more" onclick="location.href = ('<?php echo $news_item['href']; ?>');"><i class="fa fa-angle-right fa-2x"></i></button>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<?php } ?>
<?php } ?>
<?php } ?>