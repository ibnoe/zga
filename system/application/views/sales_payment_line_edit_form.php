<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_payment_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_payment_lineeditform').click(function(){$('#sales_payment_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Payment Line</h3>

<p>
<div id="sales_payment_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_payment_lineedit/submit" id="sales_payment_lineeditform" class="editform">

<?=form_hidden("sales_payment_line_id", $sales_payment_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Sales Invoice</td><td><?=form_dropdown('salespaymentline__salesinvoice_id', $salesinvoice_opt, $salespaymentline__salesinvoice_id);?>&nbsp;<input id='salespaymentline__salesinvoice_id_lookup' type='button' value='Lookup'></input></td><div id='salespaymentline__salesinvoice_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salespaymentline__salesinvoice_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/sales_invoicelookup', function(data) { $('#salespaymentline__salesinvoice_id_dialog').html(data);$('#salespaymentline__salesinvoice_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salespaymentline__salesinvoice_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salespaymentline__salesinvoice_id]').val(lines[0]);if (typeof window.sales_payment_line_selected_salesinvoice_id == 'function') { sales_payment_line_selected_salesinvoice_id("<?=site_url();?>"); }}$('#salespaymentline__salesinvoice_id_dialog').dialog('close');});$('#salespaymentline__salesinvoice_id_lookup').button().click(function() {$('#salespaymentline__salesinvoice_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_payment_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


