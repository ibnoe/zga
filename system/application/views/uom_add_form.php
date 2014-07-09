<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#uomoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/uomview/index/' },
		}; 
		
		$('#uomform').click(function(){$('#uomform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Uom</h3>

<p>
<div id="uomoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/uomadd/submit" id="uomform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'uom__name', 'value' => $uom__name, 'class' => 'basic', 'id' => 'uom__name'));?></td></tr>
<tr class='basic'>
<td>Multiplier</td>
<td><?=form_input(array('name' => 'uom__multiplier', 'value' => $uom__multiplier, 'class' => 'basic', 'id' => 'uom__multiplier'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/uomlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
