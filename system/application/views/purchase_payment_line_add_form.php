<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_payment_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_payment_lineview/index/' },
		}; 
		
		$('#purchase_payment_lineform').click(function(){$('#purchase_payment_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Payment Line</h3>

<p>
<div id="purchase_payment_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_payment_lineadd/submit" id="purchase_payment_lineform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Purchase Invoice</td>
<td><?=form_dropdown('purchasepaymentline__purchaseinvoice_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasepaymentline__purchaseinvoice_id_lookup' type='button' value='Lookup'></input></td><div id='purchasepaymentline__purchaseinvoice_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasepaymentline__purchaseinvoice_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/purchase_invoicelookup', function(data) { $('#purchasepaymentline__purchaseinvoice_id_dialog').html(data);$('#purchasepaymentline__purchaseinvoice_id_dialog a').attr('disabled', 'disabled');$('#purchasepaymentline__purchaseinvoice_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasepaymentline__purchaseinvoice_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasepaymentline__purchaseinvoice_id]').val(lines[0]);if (typeof window.purchase_payment_line_selected_purchaseinvoice_id == 'function') { purchase_payment_line_selected_purchaseinvoice_id("<?=site_url();?>"); }}$('#purchasepaymentline__purchaseinvoice_id_dialog').dialog('close');});$('#purchasepaymentline__purchaseinvoice_id_lookup').button().click(function() {$('#purchasepaymentline__purchaseinvoice_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_payment_linelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
