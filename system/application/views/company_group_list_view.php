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
					target:        '#company_grouplist',
					success: 		company_groupshowResponse,
		}; 
		
		$('#company_grouplistform').submit(function() { 
			$('#company_grouplistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function company_groupconfirmdelete(delid, obj)
	{
		$('#company_group-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', company_groupconfirmdelete2(delid, obj));
	}
	
	function company_groupconfirmdelete2(delid, obj)
	{
		$( "#company_group-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					company_groupcalldeletefn('company_groupdelete', delid, 'company_grouplist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#company_group-dialog-confirm').html('');
	}
	
	function company_groupsortupdown(field, direction)
	{
		$("#company_groupcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#company_grouplist',
					success: 		company_groupshowResponse,
		}; 
		$('#company_grouplistform').ajaxSubmit(options);
		return false;
	}
	
	function company_groupshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#company_grouplist',
					success: 		company_groupshowResponse,
		}; 
		
		$('#company_grouplistform').submit(function() { 
			$('#company_grouplistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function company_groupcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function company_groupadd()
	{
		$('#company_groupformholder').load('<?=site_url()."/company_groupadd/";?>', function()
		{$('#company_groupclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#company_groupformholder' + '\').html(\'\');' + '$(\'' + '#company_groupclosebutton' + '\').html(\'\');' + '$(\'' + '#company_grouplist' + '\').load(\'<?=site_url();?>/company_grouplist\');' + ';"></input>');
		});	
	}
	
	function company_groupedit(id)
	{
		$('#company_groupformholder').load('<?=site_url()."/company_groupedit/index/";?>' + id, function()
		{$('#company_groupclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#company_groupformholder' + '\').html(\'\');' + '$(\'' + '#company_groupclosebutton' + '\').html(\'\');' + '$(\'' + '#company_grouplist' + '\').load(\'<?=site_url();?>/company_grouplist\');' + ';"></input>');
		});	
	}
	
	function company_groupview(id)
	{
		$('#company_groupformholder').load('<?=site_url()."/company_groupview/index/";?>' + id, function()
		{$('#company_groupclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#company_groupformholder' + '\').html(\'\');' + '$(\'' + '#company_groupclosebutton' + '\').html(\'\');' + '$(\'' + '#company_grouplist' + '\').load(\'<?=site_url();?>/company_grouplist\');' + ';"></input>');
		});	
	}
	
	function company_groupgotopage()
	{
		var page = document.company_grouplistform.pageno.options[document.company_grouplistform.pageno.selectedIndex].value;
		
		$("#company_groupcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#company_grouplist',
					success: 		company_groupshowResponse,
		}; 
		$('#company_grouplistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="company_group-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="company_groupclosebutton"></div>
		<div id="company_groupformholder"></div>
		<div id="company_grouplist">
		<!--<form method="post" action="<?=site_url();?>/company_grouplist/index/" id="company_grouplistform" name="company_grouplistform">-->
		<form method="post" action="<?=current_url();?>" id="company_grouplistform" name="company_grouplistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="company_groupcurrsort">
			</div>
			<div id="company_groupsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="company_groupadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/company_groupadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/company_groupadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="company_groupsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="company_groupsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="company_groupsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="company_groupsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/company_groupview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('company_groupview/index/'.$row['id'], $row['customergroup__idstring']);?></td><td><?=$row['customergroup__name'];?></td><td><?=$row['customergroup__notes'];?></td><td><?=$row['customergroup__lastupdate'];?></td><td><?=$row['customergroup__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="company_groupview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/company_groupview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="company_groupedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/company_groupedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="company_groupconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="company_groupgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>