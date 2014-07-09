<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#giro_out_clearanceoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/giro_out_clearanceview/index/' },
		}; 
		
		$('#giro_out_clearanceform').click(function(){$('#giro_out_clearanceform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Giro Out Clearance</h3>

<p>
<div id="giro_out_clearanceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_out_clearanceadd/submit" id="giro_out_clearanceform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".girooutclearance__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'girooutclearance__date', 'value' => $girooutclearance__date, 'class' => 'girooutclearance__datebasic'));?></td></tr>
<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'girooutclearance__idstring', 'value' => $girooutclearance__idstring, 'class' => 'basic', 'id' => 'girooutclearance__idstring'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'girooutclearance__notes', 'value' => $girooutclearance__notes, 'class' => 'basic', 'id' => 'girooutclearance__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>


<table>
<th>Giro Out
</th><?php foreach ($girooutclearanceline_data as $row): ?>
<tr>
<?php if ($row['girooutclearanceline__giroout_id'] > 0): ?>
<td><?=$giroout_opt[$row['girooutclearanceline__giroout_id']];?></td>
<?=form_hidden('girooutclearanceline__giroout_id[]', $row['girooutclearanceline__giroout_id']);?>
<?php else: ?>
<td><?=form_dropdown('girooutclearanceline__giroout_id[]', $giroout_opt, $row['girooutclearanceline__giroout_id'], 'class="basic"');?></td>
<?php endif; ?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_out_clearancelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
