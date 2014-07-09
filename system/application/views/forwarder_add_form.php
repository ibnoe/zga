<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#forwarderoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/forwarderview/index/' },
		}; 
		
		$('#forwarderform').click(function(){$('#forwarderform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Forwarder</h3>

<p>
<div id="forwarderoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/forwarderadd/submit" id="forwarderform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'forwarder__name', 'value' => $forwarder__name, 'class' => 'basic', 'id' => 'forwarder__name'));?></td></tr>
<tr class='basic'>
<td>Address</td>
<td><?=form_textarea(array('name' => 'forwarder__address', 'value' => $forwarder__address, 'class' => 'basic', 'id' => 'forwarder__address'));?></td></tr>
<tr class='basic'>
<td>Rating</td>
<td><?=form_input(array('name' => 'forwarder__rating', 'value' => $forwarder__rating, 'class' => 'basic', 'id' => 'forwarder__rating'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'forwarder__notes', 'value' => $forwarder__notes, 'class' => 'basic', 'id' => 'forwarder__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/forwarderlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
