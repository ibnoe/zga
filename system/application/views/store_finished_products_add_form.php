<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#store_finished_productsoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#store_finished_productsform').click(function(){$('#store_finished_productsform').ajaxForm(options);});
	
  });
  </script>

<h3>New store_finished_products</h3>

<p>
<div id="store_finished_productsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/store_finished_productsadd/submit" id="store_finished_productsform">

<table width="100%">

<tr class='basic'><td>Order ID *</td><td><?=form_input(array('name' => 'morder__orderid', 'value' => $morder__orderid, 'class' => 'basic', 'id' => 'morder__orderid'));?></td></tr><script type="text/javascript">$(document).ready(function() {$("#morder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<tr class='basic'><td>Date</td><td><?=form_input(array('name' => 'morder__date', 'value' => $morder__date, 'class' => 'basic', 'id' => 'morder__date'));?></td></tr>
<tr class='basic'><td>Description</td><td><?=form_input(array('name' => 'morder__notes', 'value' => $morder__notes, 'class' => 'basic', 'id' => 'morder__notes'));?></td></tr>
<tr class='basic'><td>From Location</td><td><?=form_dropdown('morder__from_id', $contact_opt, $morder__from_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>To Location</td><td><?=form_dropdown('morder__to_id', $contact_opt, $morder__to_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Details</td><td><?=form_input(array('name' => 'morder__', 'value' => $morder__, 'class' => 'basic', 'id' => 'morder__'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/store_finished_productslist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
