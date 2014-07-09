<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#roll_process_updateoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/roll_process_updateview/index/' },
		}; 
		
		$('#roll_process_updateform').click(function(){$('#roll_process_updateform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Roll Process Update</h3>

<p>
<div id="roll_process_updateoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/roll_process_updateadd/submit" id="roll_process_updateform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>No *</td>
<td><?=form_input(array('name' => 'rollprocessupdate__idstring', 'value' => $rollprocessupdate__idstring, 'class' => 'basic', 'id' => 'rollprocessupdate__idstring'));?></td></tr>
<tr class='basic'>
<td>No Order And Customer *</td>
<td><?=form_input(array('name' => 'rollprocessupdate__noorderandcustomer', 'value' => $rollprocessupdate__noorderandcustomer, 'class' => 'basic', 'id' => 'rollprocessupdate__noorderandcustomer'));?></td></tr>
<tr class='basic'>
<td>Incoming Date *</td><script type="text/javascript">$(document).ready(function() {$(".rollprocessupdate__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'rollprocessupdate__date', 'value' => $rollprocessupdate__date, 'class' => 'rollprocessupdate__datebasic'));?></td></tr>
<tr class='basic'>
<td>Incoming Quantity</td>
<td><?=form_input(array('name' => 'rollprocessupdate__qty1', 'value' => $rollprocessupdate__qty1, 'class' => 'basic', 'id' => 'rollprocessupdate__qty1'));?></td></tr>
<tr class='basic'>
<td>Machine Type Roll</td>
<td><?=form_input(array('name' => 'rollprocessupdate__machinetyperoll', 'value' => $rollprocessupdate__machinetyperoll, 'class' => 'basic', 'id' => 'rollprocessupdate__machinetyperoll'));?></td></tr>
<tr class='basic'>
<td>Compound</td>
<td><?=form_input(array('name' => 'rollprocessupdate__compound', 'value' => $rollprocessupdate__compound, 'class' => 'basic', 'id' => 'rollprocessupdate__compound'));?></td></tr>
<tr class='basic'>
<td>RD</td>
<td><?=form_input(array('name' => 'rollprocessupdate__rd', 'value' => $rollprocessupdate__rd, 'class' => 'basic', 'id' => 'rollprocessupdate__rd'));?></td></tr>
<tr class='basic'>
<td>WL</td>
<td><?=form_input(array('name' => 'rollprocessupdate__wl', 'value' => $rollprocessupdate__wl, 'class' => 'basic', 'id' => 'rollprocessupdate__wl'));?></td></tr>
<tr class='basic'>
<td>TL</td>
<td><?=form_input(array('name' => 'rollprocessupdate__tl', 'value' => $rollprocessupdate__tl, 'class' => 'basic', 'id' => 'rollprocessupdate__tl'));?></td></tr>
<tr class='basic'>
<td>Qty</td>
<td><?=form_input(array('name' => 'rollprocessupdate__qty2', 'value' => $rollprocessupdate__qty2, 'class' => 'basic', 'id' => 'rollprocessupdate__qty2'));?></td></tr>
<tr class='basic'>
<td>Shipping</td>
<td><?=form_input(array('name' => 'rollprocessupdate__shipping', 'value' => $rollprocessupdate__shipping, 'class' => 'basic', 'id' => 'rollprocessupdate__shipping'));?></td></tr>
<tr class='basic'>
<td>Wrapping</td>
<td><?=form_input(array('name' => 'rollprocessupdate__wrapping', 'value' => $rollprocessupdate__wrapping, 'class' => 'basic', 'id' => 'rollprocessupdate__wrapping'));?></td></tr>
<tr class='basic'>
<td>Vulcanizing</td>
<td><?=form_input(array('name' => 'rollprocessupdate__vulcanizing', 'value' => $rollprocessupdate__vulcanizing, 'class' => 'basic', 'id' => 'rollprocessupdate__vulcanizing'));?></td></tr>
<tr class='basic'>
<td>Face Off</td>
<td><?=form_input(array('name' => 'rollprocessupdate__faceoff', 'value' => $rollprocessupdate__faceoff, 'class' => 'basic', 'id' => 'rollprocessupdate__faceoff'));?></td></tr>
<tr class='basic'>
<td>Grinding</td>
<td><?=form_input(array('name' => 'rollprocessupdate__grinding', 'value' => $rollprocessupdate__grinding, 'class' => 'basic', 'id' => 'rollprocessupdate__grinding'));?></td></tr>
<tr class='basic'>
<td>Polishing</td>
<td><?=form_input(array('name' => 'rollprocessupdate__polishing', 'value' => $rollprocessupdate__polishing, 'class' => 'basic', 'id' => 'rollprocessupdate__polishing'));?></td></tr>
<tr class='basic'>
<td>Max Date *</td><script type="text/javascript">$(document).ready(function() {$(".rollprocessupdate__maxdatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'rollprocessupdate__maxdate', 'value' => $rollprocessupdate__maxdate, 'class' => 'rollprocessupdate__maxdatebasic'));?></td></tr>
<tr class='basic'>
<td>Deadline Date *</td><script type="text/javascript">$(document).ready(function() {$(".rollprocessupdate__deadlinedatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'rollprocessupdate__deadlinedate', 'value' => $rollprocessupdate__deadlinedate, 'class' => 'rollprocessupdate__deadlinedatebasic'));?></td></tr>
<tr class='basic'>
<td>Description</td>
<td><?=form_textarea(array('name' => 'rollprocessupdate__notes', 'value' => $rollprocessupdate__notes, 'class' => 'basic', 'id' => 'rollprocessupdate__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/roll_process_updatelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
