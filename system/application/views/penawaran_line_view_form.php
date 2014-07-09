<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#penawaran_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function penawaran_lineconfirmdelete(delid, obj)
	{
		$('#penawaran_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', penawaran_lineconfirmdelete3(delid, obj));
	}

function penawaran_lineconfirmdelete2(delid, obj)
	{
		$( "#penawaran_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					penawaran_linecalldeletefn('penawaran_linedelete', delid, 'penawaran_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penawaran_line-dialog-confirm').html('');
	}
	
	function penawaran_lineconfirmdelete3(delid, obj)
	{
		$( "#penawaran_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					penawaran_linecalldeletefn3('penawaran_linedelete', delid, 'penawaran_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penawaran_line-dialog-confirm').html('');
	}

function penawaran_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function penawaran_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="penawaran_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Penawaran Line</h3>

<?=form_hidden("penawaran_line_id", $penawaran_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.item').attr('disabled', 'disabled');$('.item').hide();var s = $("#salesorderquoteline__type option:selected").text();if (s == 'Item') {$('.item').attr('disabled', '');$('.item').show();}});</script>
<td>Type</td><td><?=$salesorderquoteline__type;?></td></tr><tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$salesorderquoteline__item_id])?$item_opt[$salesorderquoteline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($salesorderquoteline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$salesorderquoteline__uom_id])?$uom_opt[$salesorderquoteline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Price</td><td><?=number_format($salesorderquoteline__price, 2);?></td></tr><tr class='basic'>
<td>Disc %</td><td><?=number_format($salesorderquoteline__pdisc, 2);?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=number_format($salesorderquoteline__subtotal, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesorderquoteline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesorderquoteline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesorderquoteline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesorderquoteline__createdby;?></td></tr>

</table>

<br>
<div id="penawaran_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/penawaran_lineedit/index/".$penawaran_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="penawaran_lineconfirmdelete(<?=$penawaran_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="penawaran_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penawaran_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
