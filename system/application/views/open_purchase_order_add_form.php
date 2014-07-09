<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#open_purchase_orderoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#open_purchase_orderform').click(function(){$('#open_purchase_orderform').ajaxForm(options);});
	
  });
  </script>

<h3>New open_purchase_order</h3>

<p>
<div id="open_purchase_orderoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/open_purchase_orderadd/submit" id="open_purchase_orderform">

<table width="100%">

<tr class='basic'><td>Order ID *</td><td><?=form_input(array('name' => 'porder__orderid', 'value' => $porder__orderid, 'class' => 'basic', 'id' => 'porder__orderid'));?></td></tr><script type="text/javascript">$(document).ready(function() {$("#porder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<tr class='basic'><td>Date</td><td><?=form_input(array('name' => 'porder__date', 'value' => $porder__date, 'class' => 'basic', 'id' => 'porder__date'));?></td></tr>
<tr class='basic'><td>Description</td><td><?=form_input(array('name' => 'porder__notes', 'value' => $porder__notes, 'class' => 'basic', 'id' => 'porder__notes'));?></td></tr>
<tr class='basic'><td>Supplier *</td><td><?=form_dropdown('porder__contact_id', $contact_opt, $porder__contact_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Currency</td><td><?=form_dropdown('porder__currency_id', $currency_opt, $porder__currency_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Currency Rate</td><td><?=form_input(array('name' => 'porder__currencyrate', 'value' => $porder__currencyrate, 'class' => 'basic', 'id' => 'porder__currencyrate'));?></td></tr>
<tr class='basic'><td>Ship To Location *</td><td><?=form_dropdown('porder__to_id', $contact_opt, $porder__to_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Taxable?</td><td><?=form_input(array('name' => 'porder__taxable', 'value' => $porder__taxable, 'class' => 'basic', 'id' => 'porder__taxable'));?></td></tr>
<tr class='basic'><td>Tax included?</td><td><?=form_input(array('name' => 'porder__taxincluded', 'value' => $porder__taxincluded, 'class' => 'basic', 'id' => 'porder__taxincluded'));?></td></tr>
<tr class='basic'><td>Details</td><td><?=form_input(array('name' => 'porder__', 'value' => $porder__, 'class' => 'basic', 'id' => 'porder__'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_purchase_orderlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
