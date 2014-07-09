<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#from_warehouseoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/from_warehouseview/index/' },
		}; 
		
		$('#from_warehouseform').click(function(){$('#from_warehouseform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New From Warehouse</h3>

<p>
<div id="from_warehouseoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/from_warehouseadd/submit" id="from_warehouseform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'warehouse__name', 'value' => $warehouse__name, 'class' => 'basic', 'id' => 'warehouse__name'));?></td></tr>
<tr class='basic'>
<td>Address</td>
<td><?=form_input(array('name' => 'warehouse__address', 'value' => $warehouse__address, 'class' => 'basic', 'id' => 'warehouse__address'));?></td></tr>
<tr class='basic'>
<td>Phone</td>
<td><?=form_input(array('name' => 'warehouse__phone', 'value' => $warehouse__phone, 'class' => 'basic', 'id' => 'warehouse__phone'));?></td></tr>
<tr class='basic'>
<td>Fax</td>
<td><?=form_input(array('name' => 'warehouse__fax', 'value' => $warehouse__fax, 'class' => 'basic', 'id' => 'warehouse__fax'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/from_warehouselist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
