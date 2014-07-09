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
					target:        '#manufacturing_order_already_donelist',
					success: 		manufacturing_order_already_doneshowResponse,
		}; 
		
		$('#manufacturing_order_already_donelistform').submit(function() { 
			$('#manufacturing_order_already_donelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function manufacturing_order_already_doneconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_already_done-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_already_doneconfirmdelete2(delid, obj));
	}
	
	function manufacturing_order_already_doneconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_already_done-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_already_donecalldeletefn('manufacturing_order_already_donedelete', delid, 'manufacturing_order_already_donelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_already_done-dialog-confirm').html('');
	}
	
	function manufacturing_order_already_donesortupdown(field, direction)
	{
		$("#manufacturing_order_already_donecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#manufacturing_order_already_donelist',
					success: 		manufacturing_order_already_doneshowResponse,
		}; 
		$('#manufacturing_order_already_donelistform').ajaxSubmit(options);
		return false;
	}
	
	function manufacturing_order_already_doneshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#manufacturing_order_already_donelist',
					success: 		manufacturing_order_already_doneshowResponse,
		}; 
		
		$('#manufacturing_order_already_donelistform').submit(function() { 
			$('#manufacturing_order_already_donelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function manufacturing_order_already_donecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function manufacturing_order_already_doneadd()
	{
		$('#manufacturing_order_already_doneformholder').load('<?=site_url()."/manufacturing_order_already_doneadd/";?>', function()
		{$('#manufacturing_order_already_doneclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_already_doneformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_already_doneclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_already_donelist' + '\').load(\'<?=site_url();?>/manufacturing_order_already_donelist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_already_doneedit(id)
	{
		$('#manufacturing_order_already_doneformholder').load('<?=site_url()."/manufacturing_order_already_doneedit/index/";?>' + id, function()
		{$('#manufacturing_order_already_doneclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_already_doneformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_already_doneclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_already_donelist' + '\').load(\'<?=site_url();?>/manufacturing_order_already_donelist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_already_doneview(id)
	{
		$('#manufacturing_order_already_doneformholder').load('<?=site_url()."/manufacturing_order_already_doneview/index/";?>' + id, function()
		{$('#manufacturing_order_already_doneclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_already_doneformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_already_doneclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_already_donelist' + '\').load(\'<?=site_url();?>/manufacturing_order_already_donelist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_already_donegotopage()
	{
		var page = document.manufacturing_order_already_donelistform.pageno.options[document.manufacturing_order_already_donelistform.pageno.selectedIndex].value;
		
		$("#manufacturing_order_already_donecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#manufacturing_order_already_donelist',
					success: 		manufacturing_order_already_doneshowResponse,
		}; 
		$('#manufacturing_order_already_donelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="manufacturing_order_already_done-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="manufacturing_order_already_doneclosebutton"></div>
		<div id="manufacturing_order_already_doneformholder"></div>
		<div id="manufacturing_order_already_donelist">
		<!--<form method="post" action="<?=site_url();?>/manufacturing_order_already_donelist/index/" id="manufacturing_order_already_donelistform" name="manufacturing_order_already_donelistform">-->
		<form method="post" action="<?=current_url();?>" id="manufacturing_order_already_donelistform" name="manufacturing_order_already_donelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="manufacturing_order_already_donecurrsort">
			</div>
			<div id="manufacturing_order_already_donesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="manufacturing_order_already_doneadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_order_already_doneadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_order_already_doneadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="manufacturing_order_already_donesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="manufacturing_order_already_donesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="manufacturing_order_already_donesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="manufacturing_order_already_donesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/manufacturing_order_already_doneview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('manufacturing_order_already_doneview/index/'.$row['id'], $row['manufacturingorder__idstring']);?></td><td><?=$row['manufacturingorder__date'];?></td><td><?php if (isset($row['manufacturingorder__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['manufacturingorder__item_id'], $row['item__name']);?></td><td><?php if (isset($row['manufacturingorder__from_warehouse_id']) && $row['warehouse__name'] != "") echo anchor('from_warehouseview/index/'.$row['manufacturingorder__from_warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['manufacturingorder__to_warehouse_id']) && $row['warehouse1__name'] != "") echo anchor('to_warehouseview/index/'.$row['manufacturingorder__to_warehouse_id'], $row['warehouse1__name']);?></td><td><?php if (isset($row['manufacturingorder__bom_id']) && $row['bom__name'] != "") echo anchor('bill_of_materialview/index/'.$row['manufacturingorder__bom_id'], $row['bom__name']);?></td><td align='right'><?=number_format($row['manufacturingorder__quantity'], 2);?></td><td><?php if (isset($row['manufacturingorder__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['manufacturingorder__uom_id'], $row['uom__name']);?></td><td><?=$row['manufacturingorder__lastupdate'];?></td><td><?=$row['manufacturingorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="manufacturing_order_already_doneview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/manufacturing_order_already_doneview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="manufacturing_order_already_doneedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_already_doneedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_already_doneconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="manufacturing_order_already_donegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>