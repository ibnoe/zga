<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#rif_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#rif_lineeditform').click(function(){$('#rif_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit RIF Line</h3>

<p>
<div id="rif_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/rif_lineedit/submit" id="rif_lineeditform" class="editform">

<?=form_hidden("rif_line_id", $rif_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Machine Specification</td><td><?=form_input(array('name' => 'rcnline__machinespec', 'value' => $rcnline__machinespec, 'id' => 'rcnline__machinespec'));?></td></tr><tr class='basic'>
<td>Rubber Diameter (RD)</td><td><?=form_input(array('name' => 'rcnline__rd', 'value' => $rcnline__rd, 'id' => 'rcnline__rd'));?></td></tr><tr class='basic'>
<td>Core Diameter (CD)</td><td><?=form_input(array('name' => 'rcnline__cd', 'value' => $rcnline__cd, 'id' => 'rcnline__cd'));?></td></tr><tr class='basic'>
<td>Rubber Length (RL)</td><td><?=form_input(array('name' => 'rcnline__rl', 'value' => $rcnline__rl, 'id' => 'rcnline__rl'));?></td></tr><tr class='basic'>
<td>Working Length (WL)</td><td><?=form_input(array('name' => 'rcnline__wl', 'value' => $rcnline__wl, 'id' => 'rcnline__wl'));?></td></tr><tr class='basic'>
<td>Total Length (TL)</td><td><?=form_input(array('name' => 'rcnline__tl', 'value' => $rcnline__tl, 'id' => 'rcnline__tl'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#rcnline__coretype').change(function() { $('.r').attr('disabled', 'disabled');$('.r').hide();$('.z').attr('disabled', 'disabled');$('.z').hide();var s = $("#rcnline__coretype option:selected").text();if (s == 'R') {$('.r').attr('disabled', '');$('.r').show();}if (s == 'Z') {$('.z').attr('disabled', '');$('.z').show();}});$('.r').attr('disabled', 'disabled');$('.r').hide();$('.z').attr('disabled', 'disabled');$('.z').hide();var s = $("#rcnline__coretype option:selected").text();if (s == 'R') {$('.r').attr('disabled', '');$('.r').show();}if (s == 'Z') {$('.z').attr('disabled', '');$('.z').show();}});</script>
<td>Core Type</td><td><?=form_dropdown('rcnline__coretype', array('R' => 'R', 'Z' => 'Z', ), $rcnline__coretype, 'id="rcnline__coretype" class="basic"');?></td></tr><tr class='basic'>
<td>Acc Fitted</td><td><input type='checkbox' name='rcnline__accfitted' value='1' <?php if ($rcnline__accfitted > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#rcnline__repairrequest').change(function() { $('.bearing_seat_(bs)').attr('disabled', 'disabled');$('.bearing_seat_(bs)').hide();$('.centre_drill_(cd)').attr('disabled', 'disabled');$('.centre_drill_(cd)').hide();var s = $("#rcnline__repairrequest option:selected").text();if (s == 'Bearing Seat (BS)') {$('.bearing_seat_(bs)').attr('disabled', '');$('.bearing_seat_(bs)').show();}if (s == 'Centre Drill (CD)') {$('.centre_drill_(cd)').attr('disabled', '');$('.centre_drill_(cd)').show();}});$('.bearing_seat_(bs)').attr('disabled', 'disabled');$('.bearing_seat_(bs)').hide();$('.centre_drill_(cd)').attr('disabled', 'disabled');$('.centre_drill_(cd)').hide();var s = $("#rcnline__repairrequest option:selected").text();if (s == 'Bearing Seat (BS)') {$('.bearing_seat_(bs)').attr('disabled', '');$('.bearing_seat_(bs)').show();}if (s == 'Centre Drill (CD)') {$('.centre_drill_(cd)').attr('disabled', '');$('.centre_drill_(cd)').show();}});</script>
<td>Repair Request</td><td><?=form_dropdown('rcnline__repairrequest', array('Bearing Seat (BS)' => 'Bearing Seat (BS)', 'Centre Drill (CD)' => 'Centre Drill (CD)', ), $rcnline__repairrequest, 'id="rcnline__repairrequest" class="basic"');?></td></tr><tr class='basic'>
<td>Remarks</td><td><?=form_input(array('name' => 'rcnline__remarks', 'value' => $rcnline__remarks, 'id' => 'rcnline__remarks'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/rif_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


