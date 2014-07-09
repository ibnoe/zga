<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#contact_personchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function contact_personconfirmdelete(delid, obj)
	{
		$('#contact_person-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', contact_personconfirmdelete3(delid, obj));
	}

function contact_personconfirmdelete2(delid, obj)
	{
		$( "#contact_person-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					contact_personcalldeletefn('contact_persondelete', delid, 'contact_personlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#contact_person-dialog-confirm').html('');
	}
	
	function contact_personconfirmdelete3(delid, obj)
	{
		$( "#contact_person-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					contact_personcalldeletefn3('contact_persondelete', delid, 'contact_personlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#contact_person-dialog-confirm').html('');
	}

function contact_personcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function contact_personcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="contact_person-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Contact Person</h3>

<?=form_hidden("contact_person_id", $contact_person_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$contactperson__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$contactperson__name;?></td></tr><tr class='basic'>
<td>Position</td><td><?=$contactperson__position;?></td></tr><tr class='basic'>
<td>Address</td><td><?=$contactperson__address;?></td></tr><tr class='basic'>
<td>Phone</td><td><?=$contactperson__phone;?></td></tr><tr class='basic'>
<td>Fax</td><td><?=$contactperson__fax;?></td></tr><tr class='basic'>
<td>Mobile</td><td><?=$contactperson__mobile;?></td></tr><tr class='basic'>
<td>Email</td><td><?=$contactperson__email;?></td></tr><tr class='basic'>
<td>Bank</td><td><?=$contactperson__bank;?></td></tr><tr class='basic'>
<td>Bank Acc No</td><td><?=$contactperson__bankaccno;?></td></tr><tr class='basic'>
<td>Bank Branch</td><td><?=$contactperson__bankbranch;?></td></tr><tr class='basic'>
<td>Martial Status</td><td><?=$contactperson__status;?></td></tr><tr class='basic'>
<td>Date Of Birth</td><td><?=$contactperson__dob;?></td></tr><tr class='basic'>
<td>Children</td><td><?=$contactperson__children;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$contactperson__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$contactperson__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$contactperson__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$contactperson__createdby;?></td></tr>

</table>

<br>
<div id="contact_personbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/contact_personedit/index/".$contact_person_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="contact_personconfirmdelete(<?=$contact_person_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="contact_personchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/contact_personlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
