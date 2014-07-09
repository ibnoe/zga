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
					target:        '#hr_userslist',
					success: 		hr_usersshowResponse,
		}; 
		
		$('#hr_userslistform').submit(function() { 
			$('#hr_userslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function hr_usersconfirmdelete(delid, obj)
	{
		$('#hr_users-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', hr_usersconfirmdelete2(delid, obj));
	}
	
	function hr_usersconfirmdelete2(delid, obj)
	{
		$( "#hr_users-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					hr_userscalldeletefn('hr_usersdelete', delid, 'hr_userslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#hr_users-dialog-confirm').html('');
	}
	
	function hr_userssortupdown(field, direction)
	{
		$("#hr_userscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#hr_userslist',
					success: 		hr_usersshowResponse,
		}; 
		$('#hr_userslistform').ajaxSubmit(options);
		return false;
	}
	
	function hr_usersshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#hr_userslist',
					success: 		hr_usersshowResponse,
		}; 
		
		$('#hr_userslistform').submit(function() { 
			$('#hr_userslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function hr_userscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function hr_usersadd()
	{
		$('#hr_usersformholder').load('<?=site_url()."/hr_usersadd/";?>', function()
		{$('#hr_usersclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#hr_usersformholder' + '\').html(\'\');' + '$(\'' + '#hr_usersclosebutton' + '\').html(\'\');' + '$(\'' + '#hr_userslist' + '\').load(\'<?=site_url();?>/hr_userslist\');' + ';"></input>');
		});	
	}
	
	function hr_usersedit(id)
	{
		$('#hr_usersformholder').load('<?=site_url()."/hr_usersedit/index/";?>' + id, function()
		{$('#hr_usersclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#hr_usersformholder' + '\').html(\'\');' + '$(\'' + '#hr_usersclosebutton' + '\').html(\'\');' + '$(\'' + '#hr_userslist' + '\').load(\'<?=site_url();?>/hr_userslist\');' + ';"></input>');
		});	
	}
	
	function hr_usersview(id)
	{
		$('#hr_usersformholder').load('<?=site_url()."/hr_usersview/index/";?>' + id, function()
		{$('#hr_usersclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#hr_usersformholder' + '\').html(\'\');' + '$(\'' + '#hr_usersclosebutton' + '\').html(\'\');' + '$(\'' + '#hr_userslist' + '\').load(\'<?=site_url();?>/hr_userslist\');' + ';"></input>');
		});	
	}
	
	function hr_usersgotopage()
	{
		var page = document.hr_userslistform.pageno.options[document.hr_userslistform.pageno.selectedIndex].value;
		
		$("#hr_userscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#hr_userslist',
					success: 		hr_usersshowResponse,
		}; 
		$('#hr_userslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="hr_users-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="hr_usersclosebutton"></div>
		<div id="hr_usersformholder"></div>
		<div id="hr_userslist">
		<!--<form method="post" action="<?=site_url();?>/hr_userslist/index/" id="hr_userslistform" name="hr_userslistform">-->
		<form method="post" action="<?=current_url();?>" id="hr_userslistform" name="hr_userslistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="hr_userscurrsort">
			</div>
			<div id="hr_userssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="hr_usersadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/hr_usersadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/hr_usersadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="hr_userssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="hr_userssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="hr_userssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="hr_userssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/hr_usersview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('hr_usersview/index/'.$row['id'], $row['users__firstname']);?></td><td><?=$row['users__lastname'];?></td><td><?=$row['users__username'];?></td><td><?=$row['users__lastupdate'];?></td><td><?=$row['users__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="hr_usersview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/hr_usersview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="hr_usersedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/hr_usersedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="hr_usersconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="hr_usersgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>