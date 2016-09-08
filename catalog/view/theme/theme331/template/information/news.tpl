<?php
// News Module for Opencart v1.5.5, modified by villagedefrance (contact@villagedefrance.net)
?>

<?php echo $header; ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
	<div class="row news-item">
		<div class="col-sm-12">
			<p class="single-new-header"><?php echo $heading_title; ?></p>
			<div class="tab-content">
				<!--<?php if ($thumb) { ?>
				<div class="pull-left">
					<div class="thumbnail">
						<img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>"/>
					</div>
				</div>
				<?php } ?> -->
				<div class="description">
					<?php echo $description; ?>
				</div>
				<?php if($news_share) { ?>
				<div class="col-sm-4">
					<div class="addthis">
						<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style ">
							<a class="addthis_button_email"></a>
							<a class="addthis_button_print"></a>
							<a class="addthis_button_preferred_1"></a>
							<a class="addthis_button_preferred_2"></a>
							<a class="addthis_button_preferred_3"></a>
							<a class="addthis_button_preferred_4"></a>
							<a class="addthis_button_compact"></a>
							<a class="addthis_counter addthis_bubble_style"></a>
						</div>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php echo $content_bottom; ?>
</div>

<script type="text/javascript"><!--
$(document).ready(function() {
	$('.colorbox').colorbox({
		overlayClose: true,
		opacity: 0.5,
		rel: "colorbox"
	});
});
//--></script>

<?php echo $footer; ?>
