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
					target:        '#rcn_linelist',
					success: 		rcn_lineshowResponse,
		}; 
		
		$('#rcn_linelistform').submit(function() { 
			$('#rcn_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function rcn_lineconfirmdelete(delid, obj)
	{
		$('#rcn_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', rcn_lineconfirmdelete2(delid, obj));
	}
	
	function rcn_lineconfirmdelete2(delid, obj)
	{
		$( "#rcn_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					rcn_linecalldeletefn('rcn_linedelete', delid, 'rcn_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rcn_line-dialog-confirm').html('');
	}
	
	function rcn_linesortupdown(field, direction)
	{
		$("#rcn_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#rcn_linelist',
					success: 		rcn_lineshowResponse,
		}; 
		$('#rcn_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function rcn_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#rcn_linelist',
					success: 		rcn_lineshowResponse,
		}; 
		
		$('#rcn_linelistform').submit(function() { 
			$('#rcn_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function rcn_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function rcn_lineadd()
	{
		$('#rcn_lineformholder').load('<?=site_url()."/rcn_lineadd/";?>', function()
		{$('#rcn_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rcn_lineformholder' + '\').html(\'\');' + '$(\'' + '#rcn_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#rcn_linelist' + '\').load(\'<?=site_url();?>/rcn_linelist\');' + ';"></input>');
		});	
	}
	
	function rcn_lineedit(id)
	{
		$('#rcn_lineformholder').load('<?=site_url()."/rcn_lineedit/index/";?>' + id, function()
		{$('#rcn_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rcn_lineformholder' + '\').html(\'\');' + '$(\'' + '#rcn_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#rcn_linelist' + '\').load(\'<?=site_url();?>/rcn_linelist\');' + ';"></input>');
		});	
	}
	
	function rcn_lineview(id)
	{
		$('#rcn_lineformholder').load('<?=site_url()."/rcn_lineview/index/";?>' + id, function()
		{$('#rcn_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rcn_lineformholder' + '\').html(\'\');' + '$(\'' + '#rcn_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#rcn_linelist' + '\').load(\'<?=site_url();?>/rcn_linelist\');' + ';"></input>');
		});	
	}
	
	function rcn_linegotopage()
	{
		var page = document.rcn_linelistform.pageno.options[document.rcn_linelistform.pageno.selectedIndex].value;
		
		$("#rcn_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#rcn_linelist',
					success: 		rcn_lineshowResponse,
		}; 
		$('#rcn_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="rcn_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="rcn_lineclosebutton"></div>
		<div id="rcn_lineformholder"></div>
		<div id="rcn_linelist">
		<!--<form method="post" action="<?=site_url();?>/rcn_linelist/index/" id="rcn_linelistform" name="rcn_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="rcn_linelistform" name="rcn_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="rcn_linecurrsort">
			</div>
			<div id="rcn_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="rcn_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/rcn_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/rcn_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="rcn_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="rcn_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="rcn_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="rcn_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/rcn_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('rcn_lineview/index/'.$row['id'], $row['rcnline__noiden']);?></td><td align='right'><?=number_format($row['rcnline__quantity'], 2);?></td><td><?=$row['rcnline__pos'];?></td><td align='right'><?=number_format($row['rcnline__rd'], 2);?></td><td align='right'><?=number_format($row['rcnline__cd'], 2);?></td><td align='right'><?=number_format($row['rcnline__rl'], 2);?></td><td align='right'><?=number_format($row['rcnline__wl'], 2);?></td><td align='right'><?=number_format($row['rcnline__tl'], 2);?></td><td><?php if (isset($row['rcnline__compound_id']) && $row['item__name'] != "") echo anchor('compoundview/index/'.$row['rcnline__compound_id'], $row['item__name']);?></td><td><?php if ($row['rcnline__accfitted'] != 0) echo 'Yes'; else echo '';?></td><td><?php if (isset($row['rcnline__mesin_id']) && $row['mesin__typename'] != "") echo anchor('mesinview/index/'.$row['rcnline__mesin_id'], $row['mesin__typename']);?></td><td><?php if (isset($row['rcnline__core_id']) && $row['item1__name'] != "") echo anchor('coreview/index/'.$row['rcnline__core_id'], $row['item1__name']);?></td><td><?=$row['rcnline__itemno'];?></td><td><?=$row['rcnline__lastupdate'];?></td><td><?=$row['rcnline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="rcn_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/rcn_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="rcn_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/rcn_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="rcn_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="rcn_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>