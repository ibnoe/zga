<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#cogs_accountsoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#cogs_accountseditform').click(function(){$('#cogs_accountseditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit COGS Accounts</h3>

<p>
<div id="cogs_accountsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/cogs_accountsedit/submit" id="cogs_accountseditform" class="editform">

<?=form_hidden("cogs_accounts_id", $cogs_accounts_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Acc No *</td><td><?=form_input(array('name' => 'coa__idstring', 'value' => $coa__idstring, 'id' => 'coa__idstring'));?></td></tr><tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'coa__name', 'value' => $coa__name, 'id' => 'coa__name'));?></td></tr><tr class='basic'>
<td>Type</td><td><?=form_dropdown('coa__coatype_id', $coatype_opt, $coa__coatype_id);?>&nbsp;<input id='coa__coatype_id_lookup' type='button' value='Lookup'></input></td><div id='coa__coatype_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#coa__coatype_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/account_typelookup', function(data) { $('#coa__coatype_id_dialog').html(data);$('#coa__coatype_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=coa__coatype_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=coa__coatype_id]').val(lines[0]);if (typeof window.cogs_accounts_selected_coatype_id == 'function') { cogs_accounts_selected_coatype_id("<?=site_url();?>"); }}$('#coa__coatype_id_dialog').dialog('close');});$('#coa__coatype_id_lookup').button().click(function() {$('#coa__coatype_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cogs_accountslist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


