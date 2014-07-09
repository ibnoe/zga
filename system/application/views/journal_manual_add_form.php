<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#journal_manualoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/journal_manualview/index/' },
		}; 
		
		$('#journal_manualform').click(function(){$('#journal_manualform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Journal Manual</h3>

<p>
<div id="journal_manualoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/journal_manualadd/submit" id="journal_manualform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Reference *</td>
<td><?=form_input(array('name' => 'journalmanual__reference', 'value' => $journalmanual__reference, 'class' => 'basic', 'id' => 'journalmanual__reference'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".journalmanual__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'journalmanual__date', 'value' => $journalmanual__date, 'class' => 'journalmanual__datebasic'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'journalmanual__notes', 'value' => $journalmanual__notes, 'class' => 'basic', 'id' => 'journalmanual__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/journal_manuallist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
