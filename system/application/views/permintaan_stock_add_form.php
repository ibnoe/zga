<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#permintaan_stockoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/permintaan_stockview/index/' },
		}; 
		
		$('#permintaan_stockform').click(function(){$('#permintaan_stockform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Permintaan Stock</h3>

<p>
<div id="permintaan_stockoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/permintaan_stockadd/submit" id="permintaan_stockform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'permintaanstock__idstring', 'value' => $permintaanstock__idstring, 'class' => 'basic', 'id' => 'permintaanstock__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".permintaanstock__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'permintaanstock__date', 'value' => $permintaanstock__date, 'class' => 'permintaanstock__datebasic'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'permintaanstock__notes', 'value' => $permintaanstock__notes, 'class' => 'basic', 'id' => 'permintaanstock__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/permintaan_stocklist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
