<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_return_order_line_optionsoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_return_order_line_optionseditform').click(function(){$('#sales_return_order_line_optionseditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Return Order Line Options</h3>

<p>
<div id="sales_return_order_line_optionsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_order_line_optionsedit/submit" id="sales_return_order_line_optionseditform" class="editform">

<?=form_hidden("sales_return_order_line_options_id", $sales_return_order_line_options_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_order_line_optionslist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


