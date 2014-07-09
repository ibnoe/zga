<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#penerimaan_item_for_serviceoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/penerimaan_item_for_serviceview/index/' },
		}; 
		
		$('#penerimaan_item_for_serviceform').click(function(){$('#penerimaan_item_for_serviceform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Penerimaan Item For Service</h3>

<p>
<div id="penerimaan_item_for_serviceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/penerimaan_item_for_serviceadd/submit" id="penerimaan_item_for_serviceform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'insertitem__idstring', 'value' => $insertitem__idstring, 'class' => 'basic', 'id' => 'insertitem__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".insertitem__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'insertitem__date', 'value' => $insertitem__date, 'class' => 'insertitem__datebasic'));?></td></tr>
<tr class='basic'>
<td>Description</td>
<td><?=form_input(array('name' => 'insertitem__notes', 'value' => $insertitem__notes, 'class' => 'basic', 'id' => 'insertitem__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penerimaan_item_for_servicelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
