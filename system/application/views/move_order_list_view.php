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
					target:        '#move_orderlist',
					success: 		move_ordershowResponse,
		}; 
		
		$('#move_orderlistform').submit(function() { 
			$('#move_orderlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function move_orderconfirmdelete(delid, obj)
	{
		$('#move_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', move_orderconfirmdelete2(delid, obj));
	}
	
	function move_orderconfirmdelete2(delid, obj)
	{
		$( "#move_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					move_ordercalldeletefn('move_orderdelete', delid, 'move_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#move_order-dialog-confirm').html('');
	}
	
	function move_ordersortupdown(field, direction)
	{
		$("#move_ordercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#move_orderlist',
					success: 		move_ordershowResponse,
		}; 
		$('#move_orderlistform').ajaxSubmit(options);
		return false;
	}
	
	function move_ordershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#move_orderlist',
					success: 		move_ordershowResponse,
		}; 
		
		$('#move_orderlistform').submit(function() { 
			$('#move_orderlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function move_ordercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function move_orderadd()
	{
		$('#move_orderformholder').load('<?=site_url()."/move_orderadd/";?>', function()
		{$('#move_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#move_orderformholder' + '\').html(\'\');' + '$(\'' + '#move_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#move_orderlist' + '\').load(\'<?=site_url();?>/move_orderlist\');' + ';"></input>');
		});	
	}
	
	function move_orderedit(id)
	{
		$('#move_orderformholder').load('<?=site_url()."/move_orderedit/index/";?>' + id, function()
		{$('#move_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#move_orderformholder' + '\').html(\'\');' + '$(\'' + '#move_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#move_orderlist' + '\').load(\'<?=site_url();?>/move_orderlist\');' + ';"></input>');
		});	
	}
	
	function move_orderview(id)
	{
		$('#move_orderformholder').load('<?=site_url()."/move_orderview/index/";?>' + id, function()
		{$('#move_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#move_orderformholder' + '\').html(\'\');' + '$(\'' + '#move_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#move_orderlist' + '\').load(\'<?=site_url();?>/move_orderlist\');' + ';"></input>');
		});	
	}
	
	function move_ordergotopage()
	{
		var page = document.move_orderlistform.pageno.options[document.move_orderlistform.pageno.selectedIndex].value;
		
		$("#move_ordercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#move_orderlist',
					success: 		move_ordershowResponse,
		}; 
		$('#move_orderlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="move_order-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="move_orderclosebutton"></div>
		<div id="move_orderformholder"></div>
		<div id="move_orderlist">
		<!--<form method="post" action="<?=site_url();?>/move_orderlist/index/" id="move_orderlistform" name="move_orderlistform">-->
		<form method="post" action="<?=current_url();?>" id="move_orderlistform" name="move_orderlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="move_ordercurrsort">
			</div>
			<div id="move_ordersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="move_orderadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/move_orderadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/move_orderadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="move_ordersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="move_ordersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="move_ordersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="move_ordersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/move_orderview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('move_orderview/index/'.$row['id'], $row['moveorder__orderid']);?></td><td><?=$row['moveorder__date'];?></td><td><?php if (isset($row['moveorder__from_warehouse_id']) && $row['warehouse__name'] != "") echo anchor('from_warehouseview/index/'.$row['moveorder__from_warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['moveorder__to_warehouse_id']) && $row['warehouse1__name'] != "") echo anchor('to_warehouseview/index/'.$row['moveorder__to_warehouse_id'], $row['warehouse1__name']);?></td><td><?=$row['moveorder__notes'];?></td><td><?=$row['moveorder__lastupdate'];?></td><td><?=$row['moveorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="move_orderview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/move_orderview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="move_orderedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/move_orderedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="move_orderconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="move_ordergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>