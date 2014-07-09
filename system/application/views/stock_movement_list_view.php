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
					target:        '#stock_movementlist',
					success: 		stock_movementshowResponse,
		}; 
		
		$('#stock_movementlistform').submit(function() { 
			$('#stock_movementlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function stock_movementconfirmdelete(delid, obj)
	{
		$('#stock_movement-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', stock_movementconfirmdelete2(delid, obj));
	}
	
	function stock_movementconfirmdelete2(delid, obj)
	{
		$( "#stock_movement-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					stock_movementcalldeletefn('stock_movementdelete', delid, 'stock_movementlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_movement-dialog-confirm').html('');
	}
	
	function stock_movementsortupdown(field, direction)
	{
		$("#stock_movementcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#stock_movementlist',
					success: 		stock_movementshowResponse,
		}; 
		$('#stock_movementlistform').ajaxSubmit(options);
		return false;
	}
	
	function stock_movementshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#stock_movementlist',
					success: 		stock_movementshowResponse,
		}; 
		
		$('#stock_movementlistform').submit(function() { 
			$('#stock_movementlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function stock_movementcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function stock_movementadd()
	{
		$('#stock_movementformholder').load('<?=site_url()."/stock_movementadd/";?>', function()
		{$('#stock_movementclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_movementformholder' + '\').html(\'\');' + '$(\'' + '#stock_movementclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_movementlist' + '\').load(\'<?=site_url();?>/stock_movementlist\');' + ';"></input>');
		});	
	}
	
	function stock_movementedit(id)
	{
		$('#stock_movementformholder').load('<?=site_url()."/stock_movementedit/index/";?>' + id, function()
		{$('#stock_movementclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_movementformholder' + '\').html(\'\');' + '$(\'' + '#stock_movementclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_movementlist' + '\').load(\'<?=site_url();?>/stock_movementlist\');' + ';"></input>');
		});	
	}
	
	function stock_movementview(id)
	{
		$('#stock_movementformholder').load('<?=site_url()."/stock_movementview/index/";?>' + id, function()
		{$('#stock_movementclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_movementformholder' + '\').html(\'\');' + '$(\'' + '#stock_movementclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_movementlist' + '\').load(\'<?=site_url();?>/stock_movementlist\');' + ';"></input>');
		});	
	}
	
	function stock_movementgotopage()
	{
		var page = document.stock_movementlistform.pageno.options[document.stock_movementlistform.pageno.selectedIndex].value;
		
		$("#stock_movementcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#stock_movementlist',
					success: 		stock_movementshowResponse,
		}; 
		$('#stock_movementlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="stock_movement-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="stock_movementclosebutton"></div>
		<div id="stock_movementformholder"></div>
		<div id="stock_movementlist">
		<!--<form method="post" action="<?=site_url();?>/stock_movementlist/index/" id="stock_movementlistform" name="stock_movementlistform">-->
		<form method="post" action="<?=current_url();?>" id="stock_movementlistform" name="stock_movementlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="stock_movementcurrsort">
			</div>
			<div id="stock_movementsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="stock_movementadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/stock_movementadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/stock_movementadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="stock_movementsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="stock_movementsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="stock_movementsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="stock_movementsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/stock_movementview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('stock_movementview/index/'.$row['id'], $row['moveaction__date']);?></td><td><?=$row['moveaction__orderid'];?></td><td><?php if (isset($row['moveaction__from_warehouse_id']) && $row['warehouse__name'] != "") echo anchor('from_warehouseview/index/'.$row['moveaction__from_warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['moveaction__to_warehouse_id']) && $row['warehouse1__name'] != "") echo anchor('to_warehouseview/index/'.$row['moveaction__to_warehouse_id'], $row['warehouse1__name']);?></td><td><?=$row['moveaction__lastupdate'];?></td><td><?=$row['moveaction__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="stock_movementview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/stock_movementview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="stock_movementedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/stock_movementedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="stock_movementconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="stock_movementgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>