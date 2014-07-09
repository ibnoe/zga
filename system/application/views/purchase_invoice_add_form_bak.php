<?php include "header.php" ?>

<script type="text/javascript">

  $(document).ready(function() {
    var options = { 
			target:        '#purchase_invoiceoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_invoiceview/index/' },
		}; 
		
		$('#purchase_invoiceform').click(function(){$('#purchase_invoiceform').ajaxForm(options);});
	//
  });
  
</script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Invoice</h3>

<p>
<div id="purchase_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_invoiceadd/submit" id="purchase_invoiceform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchaseinvoice__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchaseinvoice__date', 'value' => $purchaseinvoice__date, 'class' => 'purchaseinvoice__datebasic'));?></td></tr>
<tr class='basic'>
<td>Purchase Invoice No *</td>
<td><?=form_input(array('name' => 'purchaseinvoice__orderid', 'value' => $purchaseinvoice__orderid, 'class' => 'basic', 'id' => 'purchaseinvoice__orderid'));?></td></tr>
<tr class='basic'>
<td>Receive Items</td>
<td><?=form_dropdown('purchaseinvoice__receiveditem_id', array(), '', 'class="basic"');?>&nbsp;
<input id='purchaseinvoice__receiveditem_id_lookup' type='button' value='Lookup'></input></td>
<div id='purchaseinvoice__receiveditem_id_dialog'></div>
<script type="text/javascript">$(document).ready(function() {
$('#purchaseinvoice__receiveditem_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/receive_items_for_invoicelookup', function(data) { $('#purchaseinvoice__receiveditem_id_dialog').html(data);$('#purchaseinvoice__receiveditem_id_dialog a').attr('disabled', 'disabled');$('#purchaseinvoice__receiveditem_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });
$('select[name=purchaseinvoice__receiveditem_id]').append('<option value=' + lines[0] + '>' + lines[3] + '</option>');
if (lines[0] != null)
{
$('select[name=purchaseinvoice__receiveditem_id]').val(lines[0]);
if (typeof window.purchase_invoice_selected_receiveditem_id == 'function') { purchase_invoice_selected_receiveditem_id("<?=site_url();?>"); }
set_currency_id_by_receiveditem_id("<?=site_url();?>", $('select[name=purchaseinvoice__receiveditem_id]').val());
set_supplier_id_by_receiveditem_id("<?=site_url();?>", $('select[name=purchaseinvoice__receiveditem_id]').val());
set_total_by_receiveditem_id("<?=site_url();?>", $('select[name=purchaseinvoice__receiveditem_id]').val());
}
$('#purchaseinvoice__receiveditem_id_dialog').dialog('close');});
$('#purchaseinvoice__receiveditem_id_lookup').button().click(function() {$('#purchaseinvoice__receiveditem_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Payment Term</td><script type="text/javascript">$(document).ready(function() {$('#purchaseinvoice__top').change(function() { $('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.1_week').attr('disabled', 'disabled');$('.1_week').hide();$('.2_weeks').attr('disabled', 'disabled');$('.2_weeks').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#purchaseinvoice__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '1 Week') {$('.1_week').attr('disabled', '');$('.1_week').show();}if (s == '2 Weeks') {$('.2_weeks').attr('disabled', '');$('.2_weeks').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});$('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.1_week').attr('disabled', 'disabled');$('.1_week').hide();$('.2_weeks').attr('disabled', 'disabled');$('.2_weeks').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#purchaseinvoice__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '1 Week') {$('.1_week').attr('disabled', '');$('.1_week').show();}if (s == '2 Weeks') {$('.2_weeks').attr('disabled', '');$('.2_weeks').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});</script>
<td><?=form_dropdown('purchaseinvoice__top', array('Cash' => 'Cash', '1 Week' => '1 Week', '2 Weeks' => '2 Weeks', '30 Days' => '30 Days', '60 Days' => '60 Days', ), $purchaseinvoice__top, 'id="purchaseinvoice__top" class="basic"');?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_invoicelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
