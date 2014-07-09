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
					target:        '#move_order_linelist',
					success: 		move_order_lineshowResponse,
		}; 
		
		$('#move_order_linelistform').submit(function() { 
			$('#move_order_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function move_order_lineconfirmdelete(delid, obj)
	{
		$('#move_order_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', move_order_lineconfirmdelete2(delid, obj));
	}
	
	function move_order_lineconfirmdelete2(delid, obj)
	{
		$( "#move_order_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					move_order_linecalldeletefn('move_order_linedelete', delid, 'move_order_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#move_order_line-dialog-confirm').html('');
	}
	
	function move_order_linesortupdown(field, direction)
	{
		$("#move_order_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#move_order_linelist',
					success: 		move_order_lineshowResponse,
		}; 
		$('#move_order_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function move_order_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#move_order_linelist',
					success: 		move_order_lineshowResponse,
		}; 
		
		$('#move_order_linelistform').submit(function() { 
			$('#move_order_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function move_order_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function move_order_lineadd()
	{
		$('#move_order_lineformholder').load('<?=site_url()."/move_order_lineadd/";?>', function()
		{$('#move_order_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#move_order_lineformholder' + '\').html(\'\');' + '$(\'' + '#move_order_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#move_order_linelist' + '\').load(\'<?=site_url();?>/move_order_linelist\');' + ';"></input>');
		});	
	}
	
	function move_order_lineedit(id)
	{
		$('#move_order_lineformholder').load('<?=site_url()."/move_order_lineedit/index/";?>' + id, function()
		{$('#move_order_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#move_order_lineformholder' + '\').html(\'\');' + '$(\'' + '#move_order_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#move_order_linelist' + '\').load(\'<?=site_url();?>/move_order_linelist\');' + ';"></input>');
		});	
	}
	
	function move_order_lineview(id)
	{
		$('#move_order_lineformholder').load('<?=site_url()."/move_order_lineview/index/";?>' + id, function()
		{$('#move_order_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#move_order_lineformholder' + '\').html(\'\');' + '$(\'' + '#move_order_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#move_order_linelist' + '\').load(\'<?=site_url();?>/move_order_linelist\');' + ';"></input>');
		});	
	}
	
	function move_order_linegotopage()
	{
		var page = document.move_order_linelistform.pageno.options[document.move_order_linelistform.pageno.selectedIndex].value;
		
		$("#move_order_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#move_order_linelist',
					success: 		move_order_lineshowResponse,
		}; 
		$('#move_order_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="move_order_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="move_order_lineclosebutton"></div>
		<div id="move_order_lineformholder"></div>
		<div id="move_order_linelist">
		<!--<form method="post" action="<?=site_url();?>/move_order_linelist/index/" id="move_order_linelistform" name="move_order_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="move_order_linelistform" name="move_order_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="move_order_linecurrsort">
			</div>
			<div id="move_order_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="move_order_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/move_order_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/move_order_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="move_order_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="move_order_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="move_order_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="move_order_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/move_order_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['moveorderline__item_id']) && $row['item__name'] != "") echo anchor('item_in_stockview/index/'.$row['moveorderline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['moveorderline__quantity'], 2);?></td><td><?php if (isset($row['moveorderline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['moveorderline__uom_id'], $row['uom__name']);?></td><td><?=$row['moveorderline__lastupdate'];?></td><td><?=$row['moveorderline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="move_order_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/move_order_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="move_order_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/move_order_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="move_order_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="move_order_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>