<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#accountsoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/accountsview/index/' },
		}; 
		
		$('#accountsform').click(function(){$('#accountsform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Accounts</h3>

<p>
<div id="accountsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/accountsadd/submit" id="accountsform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Acc No *</td>
<td><?=form_input(array('name' => 'coa__idstring', 'value' => $coa__idstring, 'class' => 'basic', 'id' => 'coa__idstring'));?></td></tr>
<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'coa__name', 'value' => $coa__name, 'class' => 'basic', 'id' => 'coa__name'));?></td></tr>
<tr class='basic'>
<td>Type</td>
<td><?=form_dropdown('coa__coatype_id', array(), '', 'class="basic"');?>&nbsp;<input id='coa__coatype_id_lookup' type='button' value='Lookup'></input></td><div id='coa__coatype_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#coa__coatype_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/account_typelookup', function(data) { $('#coa__coatype_id_dialog').html(data);$('#coa__coatype_id_dialog a').attr('disabled', 'disabled');$('#coa__coatype_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=coa__coatype_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=coa__coatype_id]').val(lines[0]);if (typeof window.accounts_selected_coatype_id == 'function') { accounts_selected_coatype_id("<?=site_url();?>"); }}$('#coa__coatype_id_dialog').dialog('close');});$('#coa__coatype_id_lookup').button().click(function() {$('#coa__coatype_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/accountslist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
