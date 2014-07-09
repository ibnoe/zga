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
					target:        '#receive_items_linelist',
					success: 		receive_items_lineshowResponse,
		}; 
		
		$('#receive_items_linelistform').submit(function() { 
			$('#receive_items_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function receive_items_lineconfirmdelete(delid, obj)
	{
		$('#receive_items_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', receive_items_lineconfirmdelete2(delid, obj));
	}
	
	function receive_items_lineconfirmdelete2(delid, obj)
	{
		$( "#receive_items_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					receive_items_linecalldeletefn('receive_items_linedelete', delid, 'receive_items_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#receive_items_line-dialog-confirm').html('');
	}
	
	function receive_items_linesortupdown(field, direction)
	{
		$("#receive_items_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#receive_items_linelist',
					success: 		receive_items_lineshowResponse,
		}; 
		$('#receive_items_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function receive_items_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#receive_items_linelist',
					success: 		receive_items_lineshowResponse,
		}; 
		
		$('#receive_items_linelistform').submit(function() { 
			$('#receive_items_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function receive_items_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function receive_items_lineadd()
	{
		$('#receive_items_lineformholder').load('<?=site_url()."/receive_items_lineadd/";?>', function()
		{$('#receive_items_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#receive_items_lineformholder' + '\').html(\'\');' + '$(\'' + '#receive_items_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#receive_items_linelist' + '\').load(\'<?=site_url();?>/receive_items_linelist\');' + ';"></input>');
		});	
	}
	
	function receive_items_lineedit(id)
	{
		$('#receive_items_lineformholder').load('<?=site_url()."/receive_items_lineedit/index/";?>' + id, function()
		{$('#receive_items_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#receive_items_lineformholder' + '\').html(\'\');' + '$(\'' + '#receive_items_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#receive_items_linelist' + '\').load(\'<?=site_url();?>/receive_items_linelist\');' + ';"></input>');
		});	
	}
	
	function receive_items_lineview(id)
	{
		$('#receive_items_lineformholder').load('<?=site_url()."/receive_items_lineview/index/";?>' + id, function()
		{$('#receive_items_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#receive_items_lineformholder' + '\').html(\'\');' + '$(\'' + '#receive_items_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#receive_items_linelist' + '\').load(\'<?=site_url();?>/receive_items_linelist\');' + ';"></input>');
		});	
	}
	
	function receive_items_linegotopage()
	{
		var page = document.receive_items_linelistform.pageno.options[document.receive_items_linelistform.pageno.selectedIndex].value;
		
		$("#receive_items_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#receive_items_linelist',
					success: 		receive_items_lineshowResponse,
		}; 
		$('#receive_items_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="receive_items_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="receive_items_lineclosebutton"></div>
		<div id="receive_items_lineformholder"></div>
		<div id="receive_items_linelist">
		<!--<form method="post" action="<?=site_url();?>/receive_items_linelist/index/" id="receive_items_linelistform" name="receive_items_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="receive_items_linelistform" name="receive_items_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="receive_items_linecurrsort">
			</div>
			<div id="receive_items_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="receive_items_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/receive_items_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/receive_items_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="receive_items_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="receive_items_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="receive_items_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="receive_items_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/receive_items_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['receiveditemline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['receiveditemline__item_id'], $row['item__name']);?></td><td><?=anchor('receive_items_lineview/index/'.$row['id'], $row['receiveditemline__quantitytoreceive']);?></td><td><?php if (isset($row['receiveditemline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['receiveditemline__uom_id'], $row['uom__name']);?></td><td><?=$row['receiveditemline__serialno'];?></td><td><?=$row['receiveditemline__expireddate'];?></td><td><?=$row['receiveditemline__hscode'];?></td><td><?=$row['receiveditemline__packinglist'];?></td><td><?=$row['receiveditemline__lastupdate'];?></td><td><?=$row['receiveditemline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="receive_items_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/receive_items_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="receive_items_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/receive_items_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="receive_items_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="receive_items_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>