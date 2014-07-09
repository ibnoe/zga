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
					target:        '#penerimaan_item_for_service_linelist',
					success: 		penerimaan_item_for_service_lineshowResponse,
		}; 
		
		$('#penerimaan_item_for_service_linelistform').submit(function() { 
			$('#penerimaan_item_for_service_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function penerimaan_item_for_service_lineconfirmdelete(delid, obj)
	{
		$('#penerimaan_item_for_service_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', penerimaan_item_for_service_lineconfirmdelete2(delid, obj));
	}
	
	function penerimaan_item_for_service_lineconfirmdelete2(delid, obj)
	{
		$( "#penerimaan_item_for_service_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					penerimaan_item_for_service_linecalldeletefn('penerimaan_item_for_service_linedelete', delid, 'penerimaan_item_for_service_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penerimaan_item_for_service_line-dialog-confirm').html('');
	}
	
	function penerimaan_item_for_service_linesortupdown(field, direction)
	{
		$("#penerimaan_item_for_service_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#penerimaan_item_for_service_linelist',
					success: 		penerimaan_item_for_service_lineshowResponse,
		}; 
		$('#penerimaan_item_for_service_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function penerimaan_item_for_service_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#penerimaan_item_for_service_linelist',
					success: 		penerimaan_item_for_service_lineshowResponse,
		}; 
		
		$('#penerimaan_item_for_service_linelistform').submit(function() { 
			$('#penerimaan_item_for_service_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function penerimaan_item_for_service_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function penerimaan_item_for_service_lineadd()
	{
		$('#penerimaan_item_for_service_lineformholder').load('<?=site_url()."/penerimaan_item_for_service_lineadd/";?>', function()
		{$('#penerimaan_item_for_service_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penerimaan_item_for_service_lineformholder' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_service_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_service_linelist' + '\').load(\'<?=site_url();?>/penerimaan_item_for_service_linelist\');' + ';"></input>');
		});	
	}
	
	function penerimaan_item_for_service_lineedit(id)
	{
		$('#penerimaan_item_for_service_lineformholder').load('<?=site_url()."/penerimaan_item_for_service_lineedit/index/";?>' + id, function()
		{$('#penerimaan_item_for_service_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penerimaan_item_for_service_lineformholder' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_service_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_service_linelist' + '\').load(\'<?=site_url();?>/penerimaan_item_for_service_linelist\');' + ';"></input>');
		});	
	}
	
	function penerimaan_item_for_service_lineview(id)
	{
		$('#penerimaan_item_for_service_lineformholder').load('<?=site_url()."/penerimaan_item_for_service_lineview/index/";?>' + id, function()
		{$('#penerimaan_item_for_service_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penerimaan_item_for_service_lineformholder' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_service_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_service_linelist' + '\').load(\'<?=site_url();?>/penerimaan_item_for_service_linelist\');' + ';"></input>');
		});	
	}
	
	function penerimaan_item_for_service_linegotopage()
	{
		var page = document.penerimaan_item_for_service_linelistform.pageno.options[document.penerimaan_item_for_service_linelistform.pageno.selectedIndex].value;
		
		$("#penerimaan_item_for_service_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#penerimaan_item_for_service_linelist',
					success: 		penerimaan_item_for_service_lineshowResponse,
		}; 
		$('#penerimaan_item_for_service_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="penerimaan_item_for_service_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="penerimaan_item_for_service_lineclosebutton"></div>
		<div id="penerimaan_item_for_service_lineformholder"></div>
		<div id="penerimaan_item_for_service_linelist">
		<!--<form method="post" action="<?=site_url();?>/penerimaan_item_for_service_linelist/index/" id="penerimaan_item_for_service_linelistform" name="penerimaan_item_for_service_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="penerimaan_item_for_service_linelistform" name="penerimaan_item_for_service_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="penerimaan_item_for_service_linecurrsort">
			</div>
			<div id="penerimaan_item_for_service_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="penerimaan_item_for_service_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/penerimaan_item_for_service_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/penerimaan_item_for_service_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="penerimaan_item_for_service_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="penerimaan_item_for_service_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="penerimaan_item_for_service_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="penerimaan_item_for_service_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/penerimaan_item_for_service_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['insertitemline__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['insertitemline__warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['insertitemline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['insertitemline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['insertitemline__quantity'], 2);?></td><td><?php if (isset($row['insertitemline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['insertitemline__uom_id'], $row['uom__name']);?></td><td align='right'><?=number_format($row['insertitemline__price'], 2);?></td><td><?=$row['insertitemline__lastupdate'];?></td><td><?=$row['insertitemline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="penerimaan_item_for_service_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/penerimaan_item_for_service_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="penerimaan_item_for_service_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/penerimaan_item_for_service_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="penerimaan_item_for_service_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="penerimaan_item_for_service_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>