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
					target:        '#stock_movement_linelist',
					success: 		stock_movement_lineshowResponse,
		}; 
		
		$('#stock_movement_linelistform').submit(function() { 
			$('#stock_movement_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function stock_movement_lineconfirmdelete(delid, obj)
	{
		$('#stock_movement_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', stock_movement_lineconfirmdelete2(delid, obj));
	}
	
	function stock_movement_lineconfirmdelete2(delid, obj)
	{
		$( "#stock_movement_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					stock_movement_linecalldeletefn('stock_movement_linedelete', delid, 'stock_movement_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_movement_line-dialog-confirm').html('');
	}
	
	function stock_movement_linesortupdown(field, direction)
	{
		$("#stock_movement_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#stock_movement_linelist',
					success: 		stock_movement_lineshowResponse,
		}; 
		$('#stock_movement_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function stock_movement_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#stock_movement_linelist',
					success: 		stock_movement_lineshowResponse,
		}; 
		
		$('#stock_movement_linelistform').submit(function() { 
			$('#stock_movement_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function stock_movement_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function stock_movement_lineadd()
	{
		$('#stock_movement_lineformholder').load('<?=site_url()."/stock_movement_lineadd/";?>', function()
		{$('#stock_movement_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_movement_lineformholder' + '\').html(\'\');' + '$(\'' + '#stock_movement_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_movement_linelist' + '\').load(\'<?=site_url();?>/stock_movement_linelist\');' + ';"></input>');
		});	
	}
	
	function stock_movement_lineedit(id)
	{
		$('#stock_movement_lineformholder').load('<?=site_url()."/stock_movement_lineedit/index/";?>' + id, function()
		{$('#stock_movement_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_movement_lineformholder' + '\').html(\'\');' + '$(\'' + '#stock_movement_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_movement_linelist' + '\').load(\'<?=site_url();?>/stock_movement_linelist\');' + ';"></input>');
		});	
	}
	
	function stock_movement_lineview(id)
	{
		$('#stock_movement_lineformholder').load('<?=site_url()."/stock_movement_lineview/index/";?>' + id, function()
		{$('#stock_movement_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_movement_lineformholder' + '\').html(\'\');' + '$(\'' + '#stock_movement_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_movement_linelist' + '\').load(\'<?=site_url();?>/stock_movement_linelist\');' + ';"></input>');
		});	
	}
	
	function stock_movement_linegotopage()
	{
		var page = document.stock_movement_linelistform.pageno.options[document.stock_movement_linelistform.pageno.selectedIndex].value;
		
		$("#stock_movement_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#stock_movement_linelist',
					success: 		stock_movement_lineshowResponse,
		}; 
		$('#stock_movement_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="stock_movement_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="stock_movement_lineclosebutton"></div>
		<div id="stock_movement_lineformholder"></div>
		<div id="stock_movement_linelist">
		<!--<form method="post" action="<?=site_url();?>/stock_movement_linelist/index/" id="stock_movement_linelistform" name="stock_movement_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="stock_movement_linelistform" name="stock_movement_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="stock_movement_linecurrsort">
			</div>
			<div id="stock_movement_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="stock_movement_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/stock_movement_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/stock_movement_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="stock_movement_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="stock_movement_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="stock_movement_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="stock_movement_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/stock_movement_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['moveactionline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['moveactionline__item_id'], $row['item__name']);?></td><td><?=anchor('stock_movement_lineview/index/'.$row['id'], $row['moveactionline__quantitytomove']);?></td><td><?php if (isset($row['moveactionline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['moveactionline__uom_id'], $row['uom__name']);?></td><td><?=$row['moveactionline__lastupdate'];?></td><td><?=$row['moveactionline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="stock_movement_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/stock_movement_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="stock_movement_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/stock_movement_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="stock_movement_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="stock_movement_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>