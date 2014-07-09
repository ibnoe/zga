<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		/*
		$('a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		*/
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#move_order_between_warehouselist',
					success: 		move_order_between_warehouseshowResponse,
		}; 
		
		$('#move_order_between_warehouselistform').submit(function() { 
			$('#move_order_between_warehouselistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function move_order_between_warehouseconfirmdelete(delid, obj)
	{
		$('#move_order_between_warehouse-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', move_order_between_warehouseconfirmdelete2(delid, obj));
	}
	
	function move_order_between_warehouseconfirmdelete2(delid, obj)
	{
		$( "#move_order_between_warehouse-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					move_order_between_warehousecalldeletefn('move_order_between_warehousedelete', delid, 'move_order_between_warehouselist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#move_order_between_warehouse-dialog-confirm').html('');
	}
	
	function move_order_between_warehousesortupdown(field, direction)
	{
		$("#move_order_between_warehousecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#move_order_between_warehouselist',
					success: 		move_order_between_warehouseshowResponse,
		}; 
		$('#move_order_between_warehouselistform').ajaxSubmit(options);
		return false;
	}
	
	function move_order_between_warehouseshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#move_order_between_warehouselist',
					success: 		move_order_between_warehouseshowResponse,
		}; 
		
		$('#move_order_between_warehouselistform').submit(function() { 
			$('#move_order_between_warehouselistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function move_order_between_warehousecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function move_order_between_warehouseadd()
	{
		$('#move_order_between_warehouseformholder').load('<?=site_url()."/move_order_between_warehouseadd/";?>', function()
		{$('#move_order_between_warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#move_order_between_warehouseformholder' + '\').html(\'\');' + '$(\'' + '#move_order_between_warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#move_order_between_warehouselist' + '\').load(\'<?=site_url();?>/move_order_between_warehouselist\');' + ';"></input>');
		});	
	}
	
	function move_order_between_warehouseedit(id)
	{
		$('#move_order_between_warehouseformholder').load('<?=site_url()."/move_order_between_warehouseedit/index/";?>' + id, function()
		{$('#move_order_between_warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#move_order_between_warehouseformholder' + '\').html(\'\');' + '$(\'' + '#move_order_between_warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#move_order_between_warehouselist' + '\').load(\'<?=site_url();?>/move_order_between_warehouselist\');' + ';"></input>');
		});	
	}
	
	function move_order_between_warehouseview(id)
	{
		$('#move_order_between_warehouseformholder').load('<?=site_url()."/move_order_between_warehouseview/index/";?>' + id, function()
		{$('#move_order_between_warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#move_order_between_warehouseformholder' + '\').html(\'\');' + '$(\'' + '#move_order_between_warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#move_order_between_warehouselist' + '\').load(\'<?=site_url();?>/move_order_between_warehouselist\');' + ';"></input>');
		});	
	}
	
	function move_order_between_warehousegotopage()
	{
		var page = document.move_order_between_warehouselistform.pageno.options[document.move_order_between_warehouselistform.pageno.selectedIndex].value;
		
		$("#move_order_between_warehousecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#move_order_between_warehouselist',
					success: 		move_order_between_warehouseshowResponse,
		}; 
		$('#move_order_between_warehouselistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="move_order_between_warehouse-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="move_order_between_warehouseclosebutton"></div>
		<div id="move_order_between_warehouseformholder"></div>
		<div id="move_order_between_warehouselist">
		<form method="post" action="<?=site_url();?>/move_order_between_warehouselist/index/" id="move_order_between_warehouselistform" name="move_order_between_warehouselistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="move_order_between_warehousecurrsort">
			</div>
			<div id="move_order_between_warehousesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="move_order_between_warehouseadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/move_order_between_warehouseadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/move_order_between_warehouseadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
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
									echo '<a href="#" class="updown" onclick="move_order_between_warehousesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="move_order_between_warehousesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="move_order_between_warehousesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="move_order_between_warehousesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['porder__orderid'];?></td><td><?=$row['porder__date'];?></td><td><?=$row['porder__notes'];?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=$row['porder__orderid'];?></td><td><?=$row['porder__date'];?></td><td><?=$row['porder__notes'];?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=$row['porder__'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="move_order_between_warehouseview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/move_order_between_warehouseview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="move_order_between_warehouseedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/move_order_between_warehouseedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="move_order_between_warehouseconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="move_order_between_warehousegotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>