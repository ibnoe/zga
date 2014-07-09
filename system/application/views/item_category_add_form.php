<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#item_categoryoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/item_categoryview/index/' },
		}; 
		
		$('#item_categoryform').click(function(){$('#item_categoryform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Item Category</h3>

<p>
<div id="item_categoryoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/item_categoryadd/submit" id="item_categoryform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'itemcategory__name', 'value' => $itemcategory__name, 'class' => 'basic', 'id' => 'itemcategory__name'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'itemcategory__notes', 'value' => $itemcategory__notes, 'class' => 'basic', 'id' => 'itemcategory__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/item_categorylist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
