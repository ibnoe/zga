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
					target:        '#reject_manufacturing_linelist',
					success: 		reject_manufacturing_lineshowResponse,
		}; 
		
		$('#reject_manufacturing_linelistform').submit(function() { 
			$('#reject_manufacturing_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function reject_manufacturing_lineconfirmdelete(delid, obj)
	{
		$('#reject_manufacturing_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', reject_manufacturing_lineconfirmdelete2(delid, obj));
	}
	
	function reject_manufacturing_lineconfirmdelete2(delid, obj)
	{
		$( "#reject_manufacturing_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					reject_manufacturing_linecalldeletefn('reject_manufacturing_linedelete', delid, 'reject_manufacturing_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#reject_manufacturing_line-dialog-confirm').html('');
	}
	
	function reject_manufacturing_linesortupdown(field, direction)
	{
		$("#reject_manufacturing_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#reject_manufacturing_linelist',
					success: 		reject_manufacturing_lineshowResponse,
		}; 
		$('#reject_manufacturing_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function reject_manufacturing_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#reject_manufacturing_linelist',
					success: 		reject_manufacturing_lineshowResponse,
		}; 
		
		$('#reject_manufacturing_linelistform').submit(function() { 
			$('#reject_manufacturing_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function reject_manufacturing_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function reject_manufacturing_lineadd()
	{
		$('#reject_manufacturing_lineformholder').load('<?=site_url()."/reject_manufacturing_lineadd/";?>', function()
		{$('#reject_manufacturing_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#reject_manufacturing_lineformholder' + '\').html(\'\');' + '$(\'' + '#reject_manufacturing_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#reject_manufacturing_linelist' + '\').load(\'<?=site_url();?>/reject_manufacturing_linelist\');' + ';"></input>');
		});	
	}
	
	function reject_manufacturing_lineedit(id)
	{
		$('#reject_manufacturing_lineformholder').load('<?=site_url()."/reject_manufacturing_lineedit/index/";?>' + id, function()
		{$('#reject_manufacturing_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#reject_manufacturing_lineformholder' + '\').html(\'\');' + '$(\'' + '#reject_manufacturing_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#reject_manufacturing_linelist' + '\').load(\'<?=site_url();?>/reject_manufacturing_linelist\');' + ';"></input>');
		});	
	}
	
	function reject_manufacturing_lineview(id)
	{
		$('#reject_manufacturing_lineformholder').load('<?=site_url()."/reject_manufacturing_lineview/index/";?>' + id, function()
		{$('#reject_manufacturing_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#reject_manufacturing_lineformholder' + '\').html(\'\');' + '$(\'' + '#reject_manufacturing_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#reject_manufacturing_linelist' + '\').load(\'<?=site_url();?>/reject_manufacturing_linelist\');' + ';"></input>');
		});	
	}
	
	function reject_manufacturing_linegotopage()
	{
		var page = document.reject_manufacturing_linelistform.pageno.options[document.reject_manufacturing_linelistform.pageno.selectedIndex].value;
		
		$("#reject_manufacturing_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#reject_manufacturing_linelist',
					success: 		reject_manufacturing_lineshowResponse,
		}; 
		$('#reject_manufacturing_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="reject_manufacturing_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="reject_manufacturing_lineclosebutton"></div>
		<div id="reject_manufacturing_lineformholder"></div>
		<div id="reject_manufacturing_linelist">
		<!--<form method="post" action="<?=site_url();?>/reject_manufacturing_linelist/index/" id="reject_manufacturing_linelistform" name="reject_manufacturing_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="reject_manufacturing_linelistform" name="reject_manufacturing_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="reject_manufacturing_linecurrsort">
			</div>
			<div id="reject_manufacturing_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="reject_manufacturing_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/reject_manufacturing_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/reject_manufacturing_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="reject_manufacturing_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="reject_manufacturing_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="reject_manufacturing_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="reject_manufacturing_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/reject_manufacturing_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['rejectmanufacturingline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['rejectmanufacturingline__item_id'], $row['item__name']);?></td><td><?=anchor('reject_manufacturing_lineview/index/'.$row['id'], $row['rejectmanufacturingline__quantitytoprocess']);?></td><td><?php if (isset($row['rejectmanufacturingline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['rejectmanufacturingline__uom_id'], $row['uom__name']);?></td><td><?=$row['rejectmanufacturingline__lastupdate'];?></td><td><?=$row['rejectmanufacturingline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="reject_manufacturing_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/reject_manufacturing_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="reject_manufacturing_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/reject_manufacturing_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="reject_manufacturing_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="reject_manufacturing_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>