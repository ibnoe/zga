<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#under_packing_folexoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#under_packing_folexform').click(function(){$('#under_packing_folexform').ajaxForm(options);});
	
  });
  </script>

<h3>New under_packing_folex</h3>

<p>
<div id="under_packing_folexoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/under_packing_folexadd/submit" id="under_packing_folexform">

<table width="100%">

<tr class='basic'><td>Name *</td><td><?=form_input(array('name' => 'itemzengraunderpackingfolex__name', 'value' => $itemzengraunderpackingfolex__name, 'class' => 'basic', 'id' => 'itemzengraunderpackingfolex__name'));?></td></tr>
<tr class='basic'><td>Net SQM</td><td><?=form_input(array('name' => 'itemzengraunderpackingfolex__netsqm', 'value' => $itemzengraunderpackingfolex__netsqm, 'class' => 'basic', 'id' => 'itemzengraunderpackingfolex__netsqm'));?></td></tr>
<tr class='basic'><td>Gross SQM</td><td><?=form_input(array('name' => 'itemzengraunderpackingfolex__grosssqm', 'value' => $itemzengraunderpackingfolex__grosssqm, 'class' => 'basic', 'id' => 'itemzengraunderpackingfolex__grosssqm'));?></td></tr>
<tr class='basic'><td>Minimum Quantity</td><td><?=form_input(array('name' => 'itemzengraunderpackingfolex__minquantity', 'value' => $itemzengraunderpackingfolex__minquantity, 'class' => 'basic', 'id' => 'itemzengraunderpackingfolex__minquantity'));?></td></tr>
<tr class='basic'><td>Maximum Quantity</td><td><?=form_input(array('name' => 'itemzengraunderpackingfolex__maxquantity', 'value' => $itemzengraunderpackingfolex__maxquantity, 'class' => 'basic', 'id' => 'itemzengraunderpackingfolex__maxquantity'));?></td></tr>
<tr class='basic'><td>Buffer 3 Months</td><td><?=form_input(array('name' => 'itemzengraunderpackingfolex__buffer3months', 'value' => $itemzengraunderpackingfolex__buffer3months, 'class' => 'basic', 'id' => 'itemzengraunderpackingfolex__buffer3months'));?></td></tr>
<tr class='basic'><td>Buy Uom</td><td><?=form_dropdown('itemzengraunderpackingfolex__buyuom_id', $uom_opt, $itemzengraunderpackingfolex__buyuom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Sell Uom</td><td><?=form_dropdown('itemzengraunderpackingfolex__selluom_id', $uom_opt, $itemzengraunderpackingfolex__selluom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Is Purchasable?</td><td><?=form_input(array('name' => 'itemzengraunderpackingfolex__purchaseable', 'value' => $itemzengraunderpackingfolex__purchaseable, 'class' => 'basic', 'id' => 'itemzengraunderpackingfolex__purchaseable'));?></td></tr>
<tr class='basic'><td>Is Sellable?</td><td><?=form_input(array('name' => 'itemzengraunderpackingfolex__sellable', 'value' => $itemzengraunderpackingfolex__sellable, 'class' => 'basic', 'id' => 'itemzengraunderpackingfolex__sellable'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/under_packing_folexlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
