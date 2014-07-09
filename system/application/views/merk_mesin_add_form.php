<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#merk_mesinoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/merk_mesinview/index/' },
		}; 
		
		$('#merk_mesinform').click(function(){$('#merk_mesinform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Merk Mesin</h3>

<p>
<div id="merk_mesinoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/merk_mesinadd/submit" id="merk_mesinform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Kode Merk Mesin *</td>
<td><?=form_input(array('name' => 'merkmesin__idstring', 'value' => $merkmesin__idstring, 'class' => 'basic', 'id' => 'merkmesin__idstring'));?></td></tr>
<tr class='basic'>
<td>Merk Mesin *</td>
<td><?=form_input(array('name' => 'merkmesin__name', 'value' => $merkmesin__name, 'class' => 'basic', 'id' => 'merkmesin__name'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/merk_mesinlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
