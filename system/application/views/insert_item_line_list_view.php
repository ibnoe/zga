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
					target:        '#insert_item_linelist',
					success: 		insert_item_lineshowResponse,
		}; 
		
		$('#insert_item_linelistform').submit(function() { 
			$('#insert_item_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function insert_item_lineconfirmdelete(delid, obj)
	{
		$('#insert_item_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', insert_item_lineconfirmdelete2(delid, obj));
	}
	
	function insert_item_lineconfirmdelete2(delid, obj)
	{
		$( "#insert_item_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					insert_item_linecalldeletefn('insert_item_linedelete', delid, 'insert_item_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#insert_item_line-dialog-confirm').html('');
	}
	
	function insert_item_linesortupdown(field, direction)
	{
		$("#insert_item_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#insert_item_linelist',
					success: 		insert_item_lineshowResponse,
		}; 
		$('#insert_item_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function insert_item_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#insert_item_linelist',
					success: 		insert_item_lineshowResponse,
		}; 
		
		$('#insert_item_linelistform').submit(function() { 
			$('#insert_item_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function insert_item_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function insert_item_lineadd()
	{
		$('#insert_item_lineformholder').load('<?=site_url()."/insert_item_lineadd/";?>', function()
		{$('#insert_item_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#insert_item_lineformholder' + '\').html(\'\');' + '$(\'' + '#insert_item_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#insert_item_linelist' + '\').load(\'<?=site_url();?>/insert_item_linelist\');' + ';"></input>');
		});	
	}
	
	function insert_item_lineedit(id)
	{
		$('#insert_item_lineformholder').load('<?=site_url()."/insert_item_lineedit/index/";?>' + id, function()
		{$('#insert_item_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#insert_item_lineformholder' + '\').html(\'\');' + '$(\'' + '#insert_item_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#insert_item_linelist' + '\').load(\'<?=site_url();?>/insert_item_linelist\');' + ';"></input>');
		});	
	}
	
	function insert_item_lineview(id)
	{
		$('#insert_item_lineformholder').load('<?=site_url()."/insert_item_lineview/index/";?>' + id, function()
		{$('#insert_item_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#insert_item_lineformholder' + '\').html(\'\');' + '$(\'' + '#insert_item_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#insert_item_linelist' + '\').load(\'<?=site_url();?>/insert_item_linelist\');' + ';"></input>');
		});	
	}
	
	function insert_item_linegotopage()
	{
		var page = document.insert_item_linelistform.pageno.options[document.insert_item_linelistform.pageno.selectedIndex].value;
		
		$("#insert_item_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#insert_item_linelist',
					success: 		insert_item_lineshowResponse,
		}; 
		$('#insert_item_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="insert_item_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="insert_item_lineclosebutton"></div>
		<div id="insert_item_lineformholder"></div>
		<div id="insert_item_linelist">
		<!--<form method="post" action="<?=site_url();?>/insert_item_linelist/index/" id="insert_item_linelistform" name="insert_item_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="insert_item_linelistform" name="insert_item_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="insert_item_linecurrsort">
			</div>
			<div id="insert_item_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="insert_item_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/insert_item_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/insert_item_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="insert_item_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="insert_item_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="insert_item_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="insert_item_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/insert_item_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['insertitemline__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['insertitemline__warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['insertitemline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['insertitemline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['insertitemline__quantity'], 2);?></td><td><?php if (isset($row['insertitemline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['insertitemline__uom_id'], $row['uom__name']);?></td><td><?=$row['insertitemline__lastupdate'];?></td><td><?=$row['insertitemline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="insert_item_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/insert_item_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="insert_item_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/insert_item_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="insert_item_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="insert_item_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>