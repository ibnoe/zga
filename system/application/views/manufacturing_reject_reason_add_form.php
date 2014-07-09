<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#manufacturing_reject_reasonoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/manufacturing_reject_reasonview/index/' },
		}; 
		
		$('#manufacturing_reject_reasonform').click(function(){$('#manufacturing_reject_reasonform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Manufacturing Reject Reason</h3>

<p>
<div id="manufacturing_reject_reasonoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/manufacturing_reject_reasonadd/submit" id="manufacturing_reject_reasonform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'manufacturingrejectreason__name', 'value' => $manufacturingrejectreason__name, 'class' => 'basic', 'id' => 'manufacturingrejectreason__name'));?></td></tr>
<tr class='basic'>
<td>Notes *</td>
<td><?=form_textarea(array('name' => 'manufacturingrejectreason__name', 'value' => $manufacturingrejectreason__name, 'class' => 'basic', 'id' => 'manufacturingrejectreason__name'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_reject_reasonlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
