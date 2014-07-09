<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#rif_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#rif_lineform').click(function(){$('#rif_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New RIF Line</h3>

<p>
<div id="rif_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/rif_lineadd/submit" id="rif_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('rcn_id', $rcn_id);?>
<tr class='basic'>
<td>Machine Specification</td>
<td><?=form_input(array('name' => 'rcnline__machinespec', 'value' => $rcnline__machinespec, 'class' => 'basic', 'id' => 'rcnline__machinespec'));?></td></tr>
<tr class='basic'>
<td>Rubber Diameter (RD)</td>
<td><?=form_input(array('name' => 'rcnline__rd', 'value' => $rcnline__rd, 'class' => 'basic', 'id' => 'rcnline__rd'));?></td></tr>
<tr class='basic'>
<td>Core Diameter (CD)</td>
<td><?=form_input(array('name' => 'rcnline__cd', 'value' => $rcnline__cd, 'class' => 'basic', 'id' => 'rcnline__cd'));?></td></tr>
<tr class='basic'>
<td>Rubber Length (RL)</td>
<td><?=form_input(array('name' => 'rcnline__rl', 'value' => $rcnline__rl, 'class' => 'basic', 'id' => 'rcnline__rl'));?></td></tr>
<tr class='basic'>
<td>Working Length (WL)</td>
<td><?=form_input(array('name' => 'rcnline__wl', 'value' => $rcnline__wl, 'class' => 'basic', 'id' => 'rcnline__wl'));?></td></tr>
<tr class='basic'>
<td>Total Length (TL)</td>
<td><?=form_input(array('name' => 'rcnline__tl', 'value' => $rcnline__tl, 'class' => 'basic', 'id' => 'rcnline__tl'));?></td></tr>
<tr class='basic'>
<td>Core Type</td><script type="text/javascript">$(document).ready(function() {$('#rcnline__coretype').change(function() { $('.r').attr('disabled', 'disabled');$('.r').hide();$('.z').attr('disabled', 'disabled');$('.z').hide();var s = $("#rcnline__coretype option:selected").text();if (s == 'R') {$('.r').attr('disabled', '');$('.r').show();}if (s == 'Z') {$('.z').attr('disabled', '');$('.z').show();}});$('.r').attr('disabled', 'disabled');$('.r').hide();$('.z').attr('disabled', 'disabled');$('.z').hide();var s = $("#rcnline__coretype option:selected").text();if (s == 'R') {$('.r').attr('disabled', '');$('.r').show();}if (s == 'Z') {$('.z').attr('disabled', '');$('.z').show();}});</script>
<td><?=form_dropdown('rcnline__coretype', array('R' => 'R', 'Z' => 'Z', ), $rcnline__coretype, 'id="rcnline__coretype" class="basic"');?></td></tr>
<tr class='basic'>
<td>Acc Fitted</td>
<td><input type='checkbox' name='rcnline__accfitted' value='1'></input></td></tr>
<tr class='basic'>
<td>Repair Request</td><script type="text/javascript">$(document).ready(function() {$('#rcnline__repairrequest').change(function() { $('.bearing_seat_(bs)').attr('disabled', 'disabled');$('.bearing_seat_(bs)').hide();$('.centre_drill_(cd)').attr('disabled', 'disabled');$('.centre_drill_(cd)').hide();var s = $("#rcnline__repairrequest option:selected").text();if (s == 'Bearing Seat (BS)') {$('.bearing_seat_(bs)').attr('disabled', '');$('.bearing_seat_(bs)').show();}if (s == 'Centre Drill (CD)') {$('.centre_drill_(cd)').attr('disabled', '');$('.centre_drill_(cd)').show();}});$('.bearing_seat_(bs)').attr('disabled', 'disabled');$('.bearing_seat_(bs)').hide();$('.centre_drill_(cd)').attr('disabled', 'disabled');$('.centre_drill_(cd)').hide();var s = $("#rcnline__repairrequest option:selected").text();if (s == 'Bearing Seat (BS)') {$('.bearing_seat_(bs)').attr('disabled', '');$('.bearing_seat_(bs)').show();}if (s == 'Centre Drill (CD)') {$('.centre_drill_(cd)').attr('disabled', '');$('.centre_drill_(cd)').show();}});</script>
<td><?=form_dropdown('rcnline__repairrequest', array('Bearing Seat (BS)' => 'Bearing Seat (BS)', 'Centre Drill (CD)' => 'Centre Drill (CD)', ), $rcnline__repairrequest, 'id="rcnline__repairrequest" class="basic"');?></td></tr>
<tr class='basic'>
<td>Remarks</td>
<td><?=form_input(array('name' => 'rcnline__remarks', 'value' => $rcnline__remarks, 'class' => 'basic', 'id' => 'rcnline__remarks'));?></td></tr>
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
