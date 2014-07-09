<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#giro_in_clearanceoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/giro_in_clearanceview/index/' },
		}; 
		
		$('#giro_in_clearanceform').click(function(){$('#giro_in_clearanceform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Giro In Clearance</h3>

<p>
<div id="giro_in_clearanceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_in_clearanceadd/submit" id="giro_in_clearanceform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".giroinclearance__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'giroinclearance__date', 'value' => $giroinclearance__date, 'class' => 'giroinclearance__datebasic'));?></td></tr>
<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'giroinclearance__idstring', 'value' => $giroinclearance__idstring, 'class' => 'basic', 'id' => 'giroinclearance__idstring'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'giroinclearance__notes', 'value' => $giroinclearance__notes, 'class' => 'basic', 'id' => 'giroinclearance__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>


<table>
<th>Giro In
</th><?php foreach ($giroinclearanceline_data as $row): ?>
<tr>
<?php if ($row['giroinclearanceline__giroin_id'] > 0): ?>
<td><?=$giroin_opt[$row['giroinclearanceline__giroin_id']];?></td>
<?=form_hidden('giroinclearanceline__giroin_id[]', $row['giroinclearanceline__giroin_id']);?>
<?php else: ?>
<td><?=form_dropdown('giroinclearanceline__giroin_id[]', $giroin_opt, $row['giroinclearanceline__giroin_id'], 'class="basic"');?></td>
<?php endif; ?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_in_clearancelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
