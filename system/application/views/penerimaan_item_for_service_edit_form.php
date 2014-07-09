<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#penerimaan_item_for_serviceoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#penerimaan_item_for_serviceeditform').click(function(){$('#penerimaan_item_for_serviceeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Penerimaan Item For Service</h3>

<p>
<div id="penerimaan_item_for_serviceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/penerimaan_item_for_serviceedit/submit" id="penerimaan_item_for_serviceeditform" class="editform">

<?=form_hidden("penerimaan_item_for_service_id", $penerimaan_item_for_service_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'insertitem__idstring', 'value' => $insertitem__idstring, 'id' => 'insertitem__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#insertitem__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'insertitem__date', 'value' => $insertitem__date, 'class' => 'date', 'id' => 'insertitem__date'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'insertitem__notes', 'value' => $insertitem__notes, 'id' => 'insertitem__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penerimaan_item_for_servicelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


