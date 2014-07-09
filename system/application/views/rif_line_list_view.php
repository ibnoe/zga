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
					target:        '#rif_linelist',
					success: 		rif_lineshowResponse,
		}; 
		
		$('#rif_linelistform').submit(function() { 
			$('#rif_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function rif_lineconfirmdelete(delid, obj)
	{
		$('#rif_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', rif_lineconfirmdelete2(delid, obj));
	}
	
	function rif_lineconfirmdelete2(delid, obj)
	{
		$( "#rif_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					rif_linecalldeletefn('rif_linedelete', delid, 'rif_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rif_line-dialog-confirm').html('');
	}
	
	function rif_linesortupdown(field, direction)
	{
		$("#rif_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#rif_linelist',
					success: 		rif_lineshowResponse,
		}; 
		$('#rif_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function rif_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#rif_linelist',
					success: 		rif_lineshowResponse,
		}; 
		
		$('#rif_linelistform').submit(function() { 
			$('#rif_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function rif_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function rif_lineadd()
	{
		$('#rif_lineformholder').load('<?=site_url()."/rif_lineadd/";?>', function()
		{$('#rif_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rif_lineformholder' + '\').html(\'\');' + '$(\'' + '#rif_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#rif_linelist' + '\').load(\'<?=site_url();?>/rif_linelist\');' + ';"></input>');
		});	
	}
	
	function rif_lineedit(id)
	{
		$('#rif_lineformholder').load('<?=site_url()."/rif_lineedit/index/";?>' + id, function()
		{$('#rif_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rif_lineformholder' + '\').html(\'\');' + '$(\'' + '#rif_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#rif_linelist' + '\').load(\'<?=site_url();?>/rif_linelist\');' + ';"></input>');
		});	
	}
	
	function rif_lineview(id)
	{
		$('#rif_lineformholder').load('<?=site_url()."/rif_lineview/index/";?>' + id, function()
		{$('#rif_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rif_lineformholder' + '\').html(\'\');' + '$(\'' + '#rif_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#rif_linelist' + '\').load(\'<?=site_url();?>/rif_linelist\');' + ';"></input>');
		});	
	}
	
	function rif_linegotopage()
	{
		var page = document.rif_linelistform.pageno.options[document.rif_linelistform.pageno.selectedIndex].value;
		
		$("#rif_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#rif_linelist',
					success: 		rif_lineshowResponse,
		}; 
		$('#rif_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="rif_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="rif_lineclosebutton"></div>
		<div id="rif_lineformholder"></div>
		<div id="rif_linelist">
		<!--<form method="post" action="<?=site_url();?>/rif_linelist/index/" id="rif_linelistform" name="rif_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="rif_linelistform" name="rif_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="rif_linecurrsort">
			</div>
			<div id="rif_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="rif_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/rif_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/rif_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="rif_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="rif_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="rif_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="rif_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/rif_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('rif_lineview/index/'.$row['id'], $row['rcnline__machinespec']);?></td><td align='right'><?=number_format($row['rcnline__rd'], 2);?></td><td align='right'><?=number_format($row['rcnline__cd'], 2);?></td><td align='right'><?=number_format($row['rcnline__rl'], 2);?></td><td align='right'><?=number_format($row['rcnline__wl'], 2);?></td><td align='right'><?=number_format($row['rcnline__tl'], 2);?></td><td><?=$row['rcnline__coretype'];?></td><td><?php if ($row['rcnline__accfitted'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['rcnline__repairrequest'];?></td><td><?=$row['rcnline__remarks'];?></td><td><?=$row['rcnline__lastupdate'];?></td><td><?=$row['rcnline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="rif_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/rif_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="rif_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/rif_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="rif_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="rif_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>