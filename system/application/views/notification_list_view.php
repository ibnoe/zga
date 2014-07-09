<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		$('.hidden').hide();
		$('input:reset').button();
		$('input:button').button();
		$('input:submit').button();
		$('input:text').addClass("text ui-widget-content ui-corner-all");
		
		$('form table.main td a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		
		
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#notificationlist',
					success: 		notificationshowResponse,
		}; 
		
		$('#notificationlistform').submit(function() { 
			$('#notificationlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function notificationconfirmdelete(delid, obj)
	{
		$('#notification-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', notificationconfirmdelete2(delid, obj));
	}
	
	function notificationconfirmdelete2(delid, obj)
	{
		$( "#notification-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					notificationcalldeletefn('notificationdelete', delid, 'notificationlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#notification-dialog-confirm').html('');
	}
	
	function notificationsortupdown(field, direction)
	{
		$("#notificationcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#notificationlist',
					success: 		notificationshowResponse,
		}; 
		$('#notificationlistform').ajaxSubmit(options);
		return false;
	}
	
	function notificationshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#notificationlist',
					success: 		notificationshowResponse,
		}; 
		
		$('#notificationlistform').submit(function() { 
			$('#notificationlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function notificationcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function notificationadd()
	{
		$('#notificationformholder').load('<?=site_url()."/notificationadd/";?>', function()
		{$('#notificationclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#notificationformholder' + '\').html(\'\');' + '$(\'' + '#notificationclosebutton' + '\').html(\'\');' + '$(\'' + '#notificationlist' + '\').load(\'<?=site_url();?>/notificationlist\');' + ';"></input>');
		});	
	}
	
	function notificationedit(id)
	{
		$('#notificationformholder').load('<?=site_url()."/notificationedit/index/";?>' + id, function()
		{$('#notificationclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#notificationformholder' + '\').html(\'\');' + '$(\'' + '#notificationclosebutton' + '\').html(\'\');' + '$(\'' + '#notificationlist' + '\').load(\'<?=site_url();?>/notificationlist\');' + ';"></input>');
		});	
	}
	
	function notificationview(id)
	{
		$('#notificationformholder').load('<?=site_url()."/notificationview/index/";?>' + id, function()
		{$('#notificationclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#notificationformholder' + '\').html(\'\');' + '$(\'' + '#notificationclosebutton' + '\').html(\'\');' + '$(\'' + '#notificationlist' + '\').load(\'<?=site_url();?>/notificationlist\');' + ';"></input>');
		});	
	}
	
	function notificationgotopage()
	{
		var page = document.notificationlistform.pageno.options[document.notificationlistform.pageno.selectedIndex].value;
		
		$("#notificationcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#notificationlist',
					success: 		notificationshowResponse,
		}; 
		$('#notificationlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="notification-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="notificationclosebutton"></div>
		<div id="notificationformholder"></div>
		<div id="notificationlist">
		<!--<form method="post" action="<?=site_url();?>/notificationlist/index/" id="notificationlistform" name="notificationlistform">-->
		<form method="post" action="<?=current_url();?>" id="notificationlistform" name="notificationlistform" class="listform">
		
			
			
			<?php if (false): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="notificationcurrsort">
			</div>
			<div id="notificationsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="notificationadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/notificationadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/notificationadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				
				<th></th>
				<?php foreach ($fields as $k=>$v): ?>
					<th>
						<?=$v;?><br/>
						<?php if (in_array($k, $sortby))
						{
							$index = array_search($k, $sortby);
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="notificationsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="notificationsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="notificationsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="notificationsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
							<?php endif; ?>
						<?php } ?>
					</th>
				<?php endforeach; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				</tr>

				
				<?php foreach ($rows as $row): ?>
					<tr>
					
					<td><a href="<?=base_url().'index.php/notificationview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('notificationview/index/'.$row['id'], $row['vmessagenotification__summary']);?></td><td><?=$row['vmessagenotification__message'];?></td><td><?=$row['vmessagenotification__lastupdate'];?></td><td><?=$row['vmessagenotification__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="notificationview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/notificationview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="notificationedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/notificationedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="notificationconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="notificationgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>