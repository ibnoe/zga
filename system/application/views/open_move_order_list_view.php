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
		
		$('.checkall').click(function () { $(this).parents('table.main').find(':checkbox').attr('checked', this.checked); });
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#open_move_orderlist',
					success: 		open_move_ordershowResponse,
		}; 
		
		$('#open_move_orderlistform').submit(function() { 
			$('#open_move_orderlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function open_move_orderconfirmdelete(delid, obj)
	{
		$('#open_move_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_move_orderconfirmdelete2(delid, obj));
	}
	
	function open_move_orderconfirmdelete2(delid, obj)
	{
		$( "#open_move_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_move_ordercalldeletefn('open_move_orderdelete', delid, 'open_move_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_move_order-dialog-confirm').html('');
	}
	
	function open_move_ordersortupdown(field, direction)
	{
		$("#open_move_ordercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#open_move_orderlist',
					success: 		open_move_ordershowResponse,
		}; 
		$('#open_move_orderlistform').ajaxSubmit(options);
		return false;
	}
	
	function open_move_ordershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#open_move_orderlist',
					success: 		open_move_ordershowResponse,
		}; 
		
		$('#open_move_orderlistform').submit(function() { 
			$('#open_move_orderlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function open_move_ordercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function open_move_orderadd()
	{
		$('#open_move_orderformholder').load('<?=site_url()."/open_move_orderadd/";?>', function()
		{$('#open_move_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_move_orderformholder' + '\').html(\'\');' + '$(\'' + '#open_move_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#open_move_orderlist' + '\').load(\'<?=site_url();?>/open_move_orderlist\');' + ';"></input>');
		});	
	}
	
	function open_move_orderedit(id)
	{
		$('#open_move_orderformholder').load('<?=site_url()."/open_move_orderedit/index/";?>' + id, function()
		{$('#open_move_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_move_orderformholder' + '\').html(\'\');' + '$(\'' + '#open_move_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#open_move_orderlist' + '\').load(\'<?=site_url();?>/open_move_orderlist\');' + ';"></input>');
		});	
	}
	
	function open_move_orderview(id)
	{
		$('#open_move_orderformholder').load('<?=site_url()."/open_move_orderview/index/";?>' + id, function()
		{$('#open_move_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_move_orderformholder' + '\').html(\'\');' + '$(\'' + '#open_move_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#open_move_orderlist' + '\').load(\'<?=site_url();?>/open_move_orderlist\');' + ';"></input>');
		});	
	}
	
	function open_move_ordergotopage()
	{
		var page = document.open_move_orderlistform.pageno.options[document.open_move_orderlistform.pageno.selectedIndex].value;
		
		$("#open_move_ordercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#open_move_orderlist',
					success: 		open_move_ordershowResponse,
		}; 
		$('#open_move_orderlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="open_move_order-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="open_move_orderclosebutton"></div>
		<div id="open_move_orderformholder"></div>
		<div id="open_move_orderlist">
		<!--<form method="post" action="<?=site_url();?>/open_move_orderlist/index/" id="open_move_orderlistform" name="open_move_orderlistform">-->
		<form method="post" action="<?=current_url();?>" id="open_move_orderlistform" name="open_move_orderlistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#from_warehousefilter').change(function() { $('#open_move_orderlistform').submit();});});</script>From Warehouse:&nbsp;<?=form_dropdown('from_warehouse_id', $warehouse_opt, $from_warehouse_id, 'id="from_warehousefilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#to_warehousefilter').change(function() { $('#open_move_orderlistform').submit();});});</script>To Warehouse:&nbsp;<?=form_dropdown('to_warehouse_id', $warehouse_opt, $to_warehouse_id, 'id="to_warehousefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="open_move_ordercurrsort">
			</div>
			<div id="open_move_ordersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="open_move_orderadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_move_orderadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_move_orderadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				<th><input type='checkbox' class='checkall'></th>
				
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
									echo '<a href="#" class="updown" onclick="open_move_ordersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="open_move_ordersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="open_move_ordersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="open_move_ordersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('moveorderline__id[]', $row['moveorderline__id'], false);?></td><td><?=$row['moveorderline__date'];?></td><td><?=$row['moveorderline__orderid'];?></td><td><?php if (isset($row['moveorderline__from_warehouse_id']) && $row['warehouse__name'] != "") echo anchor('from_warehouseview/index/'.$row['moveorderline__from_warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['moveorderline__to_warehouse_id']) && $row['warehouse1__name'] != "") echo anchor('to_warehouseview/index/'.$row['moveorderline__to_warehouse_id'], $row['warehouse1__name']);?></td><td><?php if (isset($row['moveorderline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['moveorderline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['moveorderline__quantity'], 2);?></td><td align='right'><?=number_format($row['moveorderline__quantityalreadymoved'], 2);?></td><td align='right'><?=number_format($row['moveorderline__quantitytomove'], 2);?></td><td><?php if (isset($row['moveorderline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['moveorderline__uom_id'], $row['uom__name']);?></td><td><?=$row['moveorderline__lastupdate'];?></td><td><?=$row['moveorderline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="open_move_orderview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/open_move_orderview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="open_move_orderedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_move_orderedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="open_move_orderconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="open_move_ordergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#stock_move').click(function(){$('#open_move_orderlistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#open_move_orderlistform').attr('action','<?=site_url();?>/stock_movementadd/index/');});});</script><input id='stock_move' type="submit" value="Stock Move">
			
		</form>
		</div>