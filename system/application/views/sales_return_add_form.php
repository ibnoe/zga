<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_returnoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#sales_returnform').click(function(){$('#sales_returnform').ajaxForm(options);});
	
  });
  </script>

<h3>New sales_return</h3>

<p>
<div id="sales_returnoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_returnadd/submit" id="sales_returnform">

<table width="100%">

<tr class='basic'><td>Order ID *</td><td><?=form_input(array('name' => 'sreturn__orderid', 'value' => $sreturn__orderid, 'class' => 'basic', 'id' => 'sreturn__orderid'));?></td></tr><script type="text/javascript">$(document).ready(function() {$("#sreturn__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<tr class='basic'><td>Date</td><td><?=form_input(array('name' => 'sreturn__date', 'value' => $sreturn__date, 'class' => 'basic', 'id' => 'sreturn__date'));?></td></tr>
<tr class='basic'><td>Sales Order</td><td><?=form_dropdown('sreturn__sorder_id', $sorder_opt, $sreturn__sorder_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Return To Location *</td><td><?=form_dropdown('sreturn__to_id', $contact_opt, $sreturn__to_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Details</td><td><?=form_input(array('name' => 'sreturn__', 'value' => $sreturn__, 'class' => 'basic', 'id' => 'sreturn__'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_returnlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
