<script type="text/javascript">
	$(function(){
		$('.info-list li').last().addClass('last');
	});
</script>
<div class="panel-group category-panel">

      <?php foreach ($informations as $information) { ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a>
        </div>
    </div>
      <?php } ?>
    <div class="panel panel-default"><div class="panel-heading"><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></div> </div>
    <div class="panel panel-default"><div class="panel-heading"><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></div> </div>
</div>