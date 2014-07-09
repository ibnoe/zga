<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#permintaan_stockoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#permintaan_stockeditform').click(function(){$('#permintaan_stockeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Permintaan Stock</h3>

<p>
<div id="permintaan_stockoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/permintaan_stockedit/submit" id="permintaan_stockeditform" class="editform">

<?=form_hidden("permintaan_stock_id", $permintaan_stock_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'permintaanstock__idstring', 'value' => $permintaanstock__idstring, 'id' => 'permintaanstock__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#permintaanstock__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'permintaanstock__date', 'value' => $permintaanstock__date, 'class' => 'date', 'id' => 'permintaanstock__date'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'permintaanstock__notes', 'value' => $permintaanstock__notes, 'id' => 'permintaanstock__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/permintaan_stocklist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


