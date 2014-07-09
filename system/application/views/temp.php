<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#customeroutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/customerview/index/' },
		}; 
		
		$('#customerform').click(function(){$('#customerform').ajaxForm(options);});
		
		$('input:submit, button').button().click(function() {
				//alert('xxx');
				//return false;
			});
			
		$('input:button').button().click(function() {
				$( "#popup" ).dialog( "open" );
			});
			
		$('input:text').addClass("text ui-widget-content ui-corner-all");
		
		$.get("<?=site_url();?>/supplierlist",
		function(data) { 
			$("#popup").html(data); 
			/*$("#popup").css("font-size", 8); */
			var fs = $("#popup").css("font-size"); 
			/*alert(fs);*/
			
			$("#popup table tr").click(function() { 
					//alert($(this).toSource());
					var tr = $(this);
					var lines = $('td', tr).map(function(index, td) {
						return $(td).text();
					});
					
					//alert(lines.toSource());
					//alert(lines[0]);
					
					$("#customer__firstname").val(lines[0]);
					
					//$('#testdd').find('option').remove().end()
					$('select[name=customer__marketingofficer_id]').find('option').remove().end()
						.append('<option value="0">' + lines[0] + '</option>')
						.val('0');
					
					$("#popup").dialog( "close" );
					
					/*
					var lines = $('td', tr);
					
					for (i=0;i<lines.length;i++)
					{
						alert(lines[i]);
					}
					*/
			});
		});
		
		$( "#popup" ).dialog({
			autoOpen: true,
			height: 500,
			width: 700,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			/*close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}*/
		});
  });
  </script>

<div id="popup">
	
</div>


<div id="maincontent">
  
<h3 class="addtitle">New Customer</h3>

<p>
<div id="customeroutput"></div>
</p>

<form method="post" action="<?=site_url();?>/customeradd/submit" id="customerform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>First Name</td>
<td><?=form_input(array('name' => 'customer__firstname', 'value' => $customer__firstname, 'class' => 'basic', 'id' => 'customer__firstname'));?></td></tr>
<tr class='basic'>
<td>Last Name</td>
<td><?=form_input(array('name' => 'customer__lastname', 'value' => $customer__lastname, 'class' => 'basic', 'id' => 'customer__lastname'));?></td></tr>
<tr class='basic'>
<td>Address</td>
<td><?=form_input(array('name' => 'customer__address', 'value' => $customer__address, "class" => "basic text ui-widget-content ui-corner-all", 'id' => 'customer__address'));?></td></tr>
<tr class='basic'>
<td>DOB *</td><script type="text/javascript">$(document).ready(function() {$(".customer__dobbasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'customer__dob', 'value' => $customer__dob, 'class' => 'customer__dobbasic'));?></td></tr>
<tr class='basic'>
<td>Phone</td>
<td><?=form_input(array('name' => 'customer__phone', 'value' => $customer__phone, 'class' => 'basic', 'id' => 'customer__phone'));?></td></tr>
<tr class='basic'>
<td>Fax</td>
<td><?=form_input(array('name' => 'customer__fax', 'value' => $customer__fax, 'class' => 'basic', 'id' => 'customer__fax'));?></td></tr>
<tr class='basic'>
<td>NPWP</td>
<td><?=form_input(array('name' => 'customer__npwp', 'value' => $customer__npwp, 'class' => 'basic', 'id' => 'customer__npwp'));?></td></tr>
<tr class='basic'>
<td>Email</td>
<td><?=form_input(array('name' => 'customer__email', 'value' => $customer__email, 'class' => 'basic', 'id' => 'customer__email'));?></td></tr>
<tr class='basic'>
<td>Company Group *</td>
<td><?=form_dropdown('customer__customergroup_id', $customergroup_opt, $customer__customergroup_id, 'class="basic" id="testdd"');?></td></tr>
<tr class='basic'>
<td>Marketing Officer *</td>
<td><?=form_dropdown('customer__marketingofficer_id', $marketingofficer_opt, $customer__marketingofficer_id, 'class="basic"');?>&nbsp;<input id="customer__marketingofficer_id_lookup" type="button" value="Lookup"></input></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/customerlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
