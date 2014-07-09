<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_payment_line_viewoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_return_payment_line_viewview/index/' },
		}; 
		
		$('#purchase_return_payment_line_viewform').click(function(){$('#purchase_return_payment_line_viewform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Payment Line View</h3>

<p>
<div id="purchase_return_payment_line_viewoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_payment_line_viewadd/submit" id="purchase_return_payment_line_viewform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Purchase Return Invoice</td>
<td><?=form_dropdown('purchasereturnpaymentline__purchasereturninvoice_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasereturnpaymentline__purchasereturninvoice_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnpaymentline__purchasereturninvoice_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnpaymentline__purchasereturninvoice_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/purchase_return_invoicelookup', function(data) { $('#purchasereturnpaymentline__purchasereturninvoice_id_dialog').html(data);$('#purchasereturnpaymentline__purchasereturninvoice_id_dialog a').attr('disabled', 'disabled');$('#purchasereturnpaymentline__purchasereturninvoice_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnpaymentline__purchasereturninvoice_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturnpaymentline__purchasereturninvoice_id]').val(lines[0]);if (typeof window.purchase_return_payment_line_view_selected_purchasereturninvoice_id == 'function') { purchase_return_payment_line_view_selected_purchasereturninvoice_id("<?=site_url();?>"); }}$('#purchasereturnpaymentline__purchasereturninvoice_id_dialog').dialog('close');});$('#purchasereturnpaymentline__purchasereturninvoice_id_lookup').button().click(function() {$('#purchasereturnpaymentline__purchasereturninvoice_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_payment_line_viewlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
