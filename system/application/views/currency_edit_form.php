<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#currencyoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#currencyeditform').click(function(){$('#currencyeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Currency</h3>

<p>
<div id="currencyoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/currencyedit/submit" id="currencyeditform" class="editform">

<?=form_hidden("currency_id", $currency_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'currency__idstring', 'value' => $currency__idstring, 'id' => 'currency__idstring'));?></td></tr><tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'currency__name', 'value' => $currency__name, 'id' => 'currency__name'));?></td></tr><tr class='basic'>
<td>Rate</td><td><?=form_input(array('name' => 'currency__rate', 'value' => $currency__rate, 'id' => 'currency__rate'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/currencylist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


