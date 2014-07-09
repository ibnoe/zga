<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#item_categoryoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#item_categoryeditform').click(function(){$('#item_categoryeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Item Category</h3>

<p>
<div id="item_categoryoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/item_categoryedit/submit" id="item_categoryeditform" class="editform">

<?=form_hidden("item_category_id", $item_category_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'itemcategory__name', 'value' => $itemcategory__name, 'id' => 'itemcategory__name'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'itemcategory__notes', 'value' => $itemcategory__notes, 'id' => 'itemcategory__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/item_categorylist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


