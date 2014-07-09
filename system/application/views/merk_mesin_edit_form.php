<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#merk_mesinoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#merk_mesineditform').click(function(){$('#merk_mesineditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Merk Mesin</h3>

<p>
<div id="merk_mesinoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/merk_mesinedit/submit" id="merk_mesineditform" class="editform">

<?=form_hidden("merk_mesin_id", $merk_mesin_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Kode Merk Mesin *</td><td><?=form_input(array('name' => 'merkmesin__idstring', 'value' => $merkmesin__idstring, 'id' => 'merkmesin__idstring'));?></td></tr><tr class='basic'>
<td>Merk Mesin *</td><td><?=form_input(array('name' => 'merkmesin__name', 'value' => $merkmesin__name, 'id' => 'merkmesin__name'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/merk_mesinlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


