<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#price_listoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#price_listform').click(function(){$('#price_listform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Price List</h3>

<p>
<div id="price_listoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/price_listadd/submit" id="price_listform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('customer_id', $customer_id);?>
<tr class='basic'>
<td>Pricelist ID *</td>
<td><?=form_input(array('name' => 'pricelist__idstring', 'value' => $pricelist__idstring, 'class' => 'basic', 'id' => 'pricelist__idstring'));?></td></tr>
<tr class='basic'>
<td>Pricelist Name *</td>
<td><?=form_input(array('name' => 'pricelist__name', 'value' => $pricelist__name, 'class' => 'basic', 'id' => 'pricelist__name'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=$_SERVER['HTTP_REFERER'];?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
