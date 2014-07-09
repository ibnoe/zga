<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_return_payment_line_viewoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_return_payment_line_vieweditform').click(function(){$('#purchase_return_payment_line_vieweditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Return Payment Line View</h3>

<p>
<div id="purchase_return_payment_line_viewoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_payment_line_viewedit/submit" id="purchase_return_payment_line_vieweditform" class="editform">

<?=form_hidden("purchase_return_payment_line_view_id", $purchase_return_payment_line_view_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Purchase Return Invoice</td><td><?=form_dropdown('purchasereturnpaymentline__purchasereturninvoice_id', $purchasereturninvoice_opt, $purchasereturnpaymentline__purchasereturninvoice_id);?>&nbsp;<input id='purchasereturnpaymentline__purchasereturninvoice_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnpaymentline__purchasereturninvoice_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnpaymentline__purchasereturninvoice_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/purchase_return_invoicelookup', function(data) { $('#purchasereturnpaymentline__purchasereturninvoice_id_dialog').html(data);$('#purchasereturnpaymentline__purchasereturninvoice_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnpaymentline__purchasereturninvoice_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturnpaymentline__purchasereturninvoice_id]').val(lines[0]);if (typeof window.purchase_return_payment_line_view_selected_purchasereturninvoice_id == 'function') { purchase_return_payment_line_view_selected_purchasereturninvoice_id("<?=site_url();?>"); }}$('#purchasereturnpaymentline__purchasereturninvoice_id_dialog').dialog('close');});$('#purchasereturnpaymentline__purchasereturninvoice_id_lookup').button().click(function() {$('#purchasereturnpaymentline__purchasereturninvoice_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_payment_line_viewlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


