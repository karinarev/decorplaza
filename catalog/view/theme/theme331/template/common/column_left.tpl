<?php if ($modules) { ?>
<aside class="col-sm-3 col-md-3" id="column-left">
  <?php foreach ($modules as $module) { ?>
  <?php echo $module; ?>
  <?php } ?>
  <br>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js" async></script>
<script src='/catalog/view/javascript/jquery/jqall.js' type='text/javascript'></script> 
  <div id="ajax_ankor" style="cursor:pointer;">
  
  </div>
  
</aside>
<?php } ?>
