<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#roll_rcnoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#roll_rcneditform').click(function(){$('#roll_rcneditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Roll RCN</h3>

<p>
<div id="roll_rcnoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/roll_rcnedit/submit" id="roll_rcneditform" class="editform">

<?=form_hidden("roll_rcn_id", $roll_rcn_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'item__name', 'value' => $item__name, 'id' => 'item__name'));?></td></tr><tr class='basic'>
<td>Roll No</td><td><?=form_input(array('name' => 'item__rollno', 'value' => $item__rollno, 'id' => 'item__rollno'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#item__inktype').change(function() { $('.standard').attr('disabled', 'disabled');$('.standard').hide();$('.mix').attr('disabled', 'disabled');$('.mix').hide();$('.uv').attr('disabled', 'disabled');$('.uv').hide();var s = $("#item__inktype option:selected").text();if (s == 'Standard') {$('.standard').attr('disabled', '');$('.standard').show();}if (s == 'Mix') {$('.mix').attr('disabled', '');$('.mix').show();}if (s == 'UV') {$('.uv').attr('disabled', '');$('.uv').show();}});$('.standard').attr('disabled', 'disabled');$('.standard').hide();$('.mix').attr('disabled', 'disabled');$('.mix').hide();$('.uv').attr('disabled', 'disabled');$('.uv').hide();var s = $("#item__inktype option:selected").text();if (s == 'Standard') {$('.standard').attr('disabled', '');$('.standard').show();}if (s == 'Mix') {$('.mix').attr('disabled', '');$('.mix').show();}if (s == 'UV') {$('.uv').attr('disabled', '');$('.uv').show();}});</script>
<td>Ink Type</td><td><?=form_dropdown('item__inktype', array('Standard' => 'Standard', 'Mix' => 'Mix', 'UV' => 'UV', ), $item__inktype, 'id="item__inktype" class="basic"');?></td></tr><tr class='basic'>
<td>Press Type</td><td><?=form_input(array('name' => 'item__machinetype', 'value' => $item__machinetype, 'id' => 'item__machinetype'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#item__core').change(function() { $('.used').attr('disabled', 'disabled');$('.used').hide();$('.new').attr('disabled', 'disabled');$('.new').hide();var s = $("#item__core option:selected").text();if (s == 'Used') {$('.used').attr('disabled', '');$('.used').show();}if (s == 'New') {$('.new').attr('disabled', '');$('.new').show();}});$('.used').attr('disabled', 'disabled');$('.used').hide();$('.new').attr('disabled', 'disabled');$('.new').hide();var s = $("#item__core option:selected").text();if (s == 'Used') {$('.used').attr('disabled', '');$('.used').show();}if (s == 'New') {$('.new').attr('disabled', '');$('.new').show();}});</script>
<td>Core</td><td><?=form_dropdown('item__core', array('Used' => 'Used', 'New' => 'New', ), $item__core, 'id="item__core" class="basic"');?></td></tr><tr class='dimensions'>
<td>Rubber Diameter (RD)</td><td><?=form_input(array('name' => 'item__rd', 'value' => $item__rd, 'id' => 'item__rd'));?></td></tr><tr class='dimensions'>
<td>Core Diameter (CD)</td><td><?=form_input(array('name' => 'item__cd', 'value' => $item__cd, 'id' => 'item__cd'));?></td></tr><tr class='dimensions'>
<td>Rubber Length (RL)</td><td><?=form_input(array('name' => 'item__rl', 'value' => $item__rl, 'id' => 'item__rl'));?></td></tr><tr class='dimensions'>
<td>Working Length (WL)</td><td><?=form_input(array('name' => 'item__wl', 'value' => $item__wl, 'id' => 'item__wl'));?></td></tr><tr class='dimensions'>
<td>Total Length (TL)</td><td><?=form_input(array('name' => 'item__tl', 'value' => $item__tl, 'id' => 'item__tl'));?></td></tr><tr class='basic'>
<td>Compound</td><td><?=form_input(array('name' => 'item__compound', 'value' => $item__compound, 'id' => 'item__compound'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#item__processscheme').change(function() { $('.recovering').attr('disabled', 'disabled');$('.recovering').hide();$('.exchange').attr('disabled', 'disabled');$('.exchange').hide();$('.brandnew').attr('disabled', 'disabled');$('.brandnew').hide();var s = $("#item__processscheme option:selected").text();if (s == 'Recovering') {$('.recovering').attr('disabled', '');$('.recovering').show();}if (s == 'Exchange') {$('.exchange').attr('disabled', '');$('.exchange').show();}if (s == 'BrandNew') {$('.brandnew').attr('disabled', '');$('.brandnew').show();}});$('.recovering').attr('disabled', 'disabled');$('.recovering').hide();$('.exchange').attr('disabled', 'disabled');$('.exchange').hide();$('.brandnew').attr('disabled', 'disabled');$('.brandnew').hide();var s = $("#item__processscheme option:selected").text();if (s == 'Recovering') {$('.recovering').attr('disabled', '');$('.recovering').show();}if (s == 'Exchange') {$('.exchange').attr('disabled', '');$('.exchange').show();}if (s == 'BrandNew') {$('.brandnew').attr('disabled', '');$('.brandnew').show();}});</script>
<td>Process Scheme</td><td><?=form_dropdown('item__processscheme', array('Recovering' => 'Recovering', 'Exchange' => 'Exchange', 'BrandNew' => 'BrandNew', ), $item__processscheme, 'id="item__processscheme" class="basic"');?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#item__rollertype').change(function() { $('.ink_form').attr('disabled', 'disabled');$('.ink_form').hide();$('.dampenig_form').attr('disabled', 'disabled');$('.dampenig_form').hide();var s = $("#item__rollertype option:selected").text();if (s == 'Ink Form') {$('.ink_form').attr('disabled', '');$('.ink_form').show();}if (s == 'Dampenig Form') {$('.dampenig_form').attr('disabled', '');$('.dampenig_form').show();}});$('.ink_form').attr('disabled', 'disabled');$('.ink_form').hide();$('.dampenig_form').attr('disabled', 'disabled');$('.dampenig_form').hide();var s = $("#item__rollertype option:selected").text();if (s == 'Ink Form') {$('.ink_form').attr('disabled', '');$('.ink_form').show();}if (s == 'Dampenig Form') {$('.dampenig_form').attr('disabled', '');$('.dampenig_form').show();}});</script>
<td>Roller Type</td><td><?=form_dropdown('item__rollertype', array('Ink Form' => 'Ink Form', 'Dampenig Form' => 'Dampenig Form', ), $item__rollertype, 'id="item__rollertype" class="basic"');?></td></tr><tr class='basic'>
<td>Is Accessories</td><td><input type='checkbox' name='item__isaccessories' value='1' <?php if ($item__isaccessories > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'>
<td>Minimum Quantity</td><td><?=form_input(array('name' => 'item__minquantity', 'value' => $item__minquantity, 'id' => 'item__minquantity'));?></td></tr><tr class='basic'>
<td>Maximum Quantity</td><td><?=form_input(array('name' => 'item__maxquantity', 'value' => $item__maxquantity, 'id' => 'item__maxquantity'));?></td></tr><tr class='brandnew'>
<td>Buffer 3 Months</td><td><?=form_input(array('name' => 'item__buffer3months', 'value' => $item__buffer3months, 'id' => 'item__buffer3months'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/roll_rcnlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


