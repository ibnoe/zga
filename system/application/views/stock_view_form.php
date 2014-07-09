<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#stockchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function stockconfirmdelete(delid, obj)
	{
		$('#stock-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', stockconfirmdelete3(delid, obj));
	}

function stockconfirmdelete2(delid, obj)
	{
		$( "#stock-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					stockcalldeletefn('stockdelete', delid, 'stocklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock-dialog-confirm').html('');
	}
	
	function stockconfirmdelete3(delid, obj)
	{
		$( "#stock-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					stockcalldeletefn3('stockdelete', delid, 'stocklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock-dialog-confirm').html('');
	}

function stockcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function stockcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="stock-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Stock</h3>

<?=form_hidden("stock_id", $stock_id);?>

<table width="100%" class="viewtable">


</table>

<br>
<div id="stockbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/stockedit/index/".$stock_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="stockconfirmdelete(<?=$stock_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="stockchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/stocklist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
