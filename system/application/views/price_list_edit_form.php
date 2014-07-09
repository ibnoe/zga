<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#price_listoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#price_listeditform').click(function(){$('#price_listeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Price List</h3>

<p>
<div id="price_listoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/price_listedit/submit" id="price_listeditform" class="editform">

<?=form_hidden("price_list_id", $price_list_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Pricelist ID *</td><td><?=form_input(array('name' => 'pricelist__idstring', 'value' => $pricelist__idstring, 'id' => 'pricelist__idstring'));?></td></tr><tr class='basic'>
<td>Pricelist Name *</td><td><?=form_input(array('name' => 'pricelist__name', 'value' => $pricelist__name, 'id' => 'pricelist__name'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/price_listlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


