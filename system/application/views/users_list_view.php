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
					target:        '#userslist',
					success: 		usersshowResponse,
		}; 
		
		$('#userslistform').submit(function() { 
			$('#userslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function usersconfirmdelete(delid, obj)
	{
		$('#users-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', usersconfirmdelete2(delid, obj));
	}
	
	function usersconfirmdelete2(delid, obj)
	{
		$( "#users-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					userscalldeletefn('usersdelete', delid, 'userslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#users-dialog-confirm').html('');
	}
	
	function userssortupdown(field, direction)
	{
		$("#userscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#userslist',
					success: 		usersshowResponse,
		}; 
		$('#userslistform').ajaxSubmit(options);
		return false;
	}
	
	function usersshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#userslist',
					success: 		usersshowResponse,
		}; 
		
		$('#userslistform').submit(function() { 
			$('#userslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function userscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function usersadd()
	{
		$('#usersformholder').load('<?=site_url()."/usersadd/";?>', function()
		{$('#usersclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#usersformholder' + '\').html(\'\');' + '$(\'' + '#usersclosebutton' + '\').html(\'\');' + '$(\'' + '#userslist' + '\').load(\'<?=site_url();?>/userslist\');' + ';"></input>');
		});	
	}
	
	function usersedit(id)
	{
		$('#usersformholder').load('<?=site_url()."/usersedit/index/";?>' + id, function()
		{$('#usersclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#usersformholder' + '\').html(\'\');' + '$(\'' + '#usersclosebutton' + '\').html(\'\');' + '$(\'' + '#userslist' + '\').load(\'<?=site_url();?>/userslist\');' + ';"></input>');
		});	
	}
	
	function usersview(id)
	{
		$('#usersformholder').load('<?=site_url()."/usersview/index/";?>' + id, function()
		{$('#usersclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#usersformholder' + '\').html(\'\');' + '$(\'' + '#usersclosebutton' + '\').html(\'\');' + '$(\'' + '#userslist' + '\').load(\'<?=site_url();?>/userslist\');' + ';"></input>');
		});	
	}
	
	function usersgotopage()
	{
		var page = document.userslistform.pageno.options[document.userslistform.pageno.selectedIndex].value;
		
		$("#userscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#userslist',
					success: 		usersshowResponse,
		}; 
		$('#userslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="users-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="usersclosebutton"></div>
		<div id="usersformholder"></div>
		<div id="userslist">
		<!--<form method="post" action="<?=site_url();?>/userslist/index/" id="userslistform" name="userslistform">-->
		<form method="post" action="<?=current_url();?>" id="userslistform" name="userslistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="userscurrsort">
			</div>
			<div id="userssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="usersadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/usersadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/usersadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="userssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="userssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="userssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="userssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/usersview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('usersview/index/'.$row['id'], $row['users__firstname']);?></td><td><?=$row['users__lastname'];?></td><td><?=$row['users__username'];?></td><td><?=$row['users__password'];?></td><td><?=$row['users__lastupdate'];?></td><td><?=$row['users__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="usersview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/usersview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="usersedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/usersedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="usersconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="usersgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>