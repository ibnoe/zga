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
					target:        '#manufacturing_order_done_to_rejectlist',
					success: 		manufacturing_order_done_to_rejectshowResponse,
		}; 
		
		$('#manufacturing_order_done_to_rejectlistform').submit(function() { 
			$('#manufacturing_order_done_to_rejectlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function manufacturing_order_done_to_rejectconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_done_to_reject-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_done_to_rejectconfirmdelete2(delid, obj));
	}
	
	function manufacturing_order_done_to_rejectconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_done_to_reject-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_done_to_rejectcalldeletefn('manufacturing_order_done_to_rejectdelete', delid, 'manufacturing_order_done_to_rejectlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_done_to_reject-dialog-confirm').html('');
	}
	
	function manufacturing_order_done_to_rejectsortupdown(field, direction)
	{
		$("#manufacturing_order_done_to_rejectcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#manufacturing_order_done_to_rejectlist',
					success: 		manufacturing_order_done_to_rejectshowResponse,
		}; 
		$('#manufacturing_order_done_to_rejectlistform').ajaxSubmit(options);
		return false;
	}
	
	function manufacturing_order_done_to_rejectshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#manufacturing_order_done_to_rejectlist',
					success: 		manufacturing_order_done_to_rejectshowResponse,
		}; 
		
		$('#manufacturing_order_done_to_rejectlistform').submit(function() { 
			$('#manufacturing_order_done_to_rejectlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function manufacturing_order_done_to_rejectcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function manufacturing_order_done_to_rejectadd()
	{
		$('#manufacturing_order_done_to_rejectformholder').load('<?=site_url()."/manufacturing_order_done_to_rejectadd/";?>', function()
		{$('#manufacturing_order_done_to_rejectclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_done_to_rejectformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_to_rejectclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_to_rejectlist' + '\').load(\'<?=site_url();?>/manufacturing_order_done_to_rejectlist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_done_to_rejectedit(id)
	{
		$('#manufacturing_order_done_to_rejectformholder').load('<?=site_url()."/manufacturing_order_done_to_rejectedit/index/";?>' + id, function()
		{$('#manufacturing_order_done_to_rejectclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_done_to_rejectformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_to_rejectclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_to_rejectlist' + '\').load(\'<?=site_url();?>/manufacturing_order_done_to_rejectlist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_done_to_rejectview(id)
	{
		$('#manufacturing_order_done_to_rejectformholder').load('<?=site_url()."/manufacturing_order_done_to_rejectview/index/";?>' + id, function()
		{$('#manufacturing_order_done_to_rejectclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_done_to_rejectformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_to_rejectclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_to_rejectlist' + '\').load(\'<?=site_url();?>/manufacturing_order_done_to_rejectlist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_done_to_rejectgotopage()
	{
		var page = document.manufacturing_order_done_to_rejectlistform.pageno.options[document.manufacturing_order_done_to_rejectlistform.pageno.selectedIndex].value;
		
		$("#manufacturing_order_done_to_rejectcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#manufacturing_order_done_to_rejectlist',
					success: 		manufacturing_order_done_to_rejectshowResponse,
		}; 
		$('#manufacturing_order_done_to_rejectlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="manufacturing_order_done_to_reject-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="manufacturing_order_done_to_rejectclosebutton"></div>
		<div id="manufacturing_order_done_to_rejectformholder"></div>
		<div id="manufacturing_order_done_to_rejectlist">
		<!--<form method="post" action="<?=site_url();?>/manufacturing_order_done_to_rejectlist/index/" id="manufacturing_order_done_to_rejectlistform" name="manufacturing_order_done_to_rejectlistform">-->
		<form method="post" action="<?=current_url();?>" id="manufacturing_order_done_to_rejectlistform" name="manufacturing_order_done_to_rejectlistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#itemfilter').change(function() { $('#manufacturing_order_done_to_rejectlistform').submit();});});</script>Item:&nbsp;<?=form_dropdown('item_id', $item_opt, $item_id, 'id="itemfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#warehousefilter').change(function() { $('#manufacturing_order_done_to_rejectlistform').submit();});});</script>Warehouse:&nbsp;<?=form_dropdown('warehouse_id', $warehouse_opt, $warehouse_id, 'id="warehousefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="manufacturing_order_done_to_rejectcurrsort">
			</div>
			<div id="manufacturing_order_done_to_rejectsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="manufacturing_order_done_to_rejectadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_order_done_to_rejectadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_order_done_to_rejectadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="manufacturing_order_done_to_rejectsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="manufacturing_order_done_to_rejectsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="manufacturing_order_done_to_rejectsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="manufacturing_order_done_to_rejectsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('manufacturingorderdoneline__id[]', $row['manufacturingorderdoneline__id'], false);?></td><td><?=$row['manufacturingorderdoneline__date'];?></td><td><?=$row['manufacturingorderdoneline__idstring'];?></td><td><?php if (isset($row['manufacturingorderdoneline__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['manufacturingorderdoneline__warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['manufacturingorderdoneline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['manufacturingorderdoneline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['manufacturingorderdoneline__quantitytoprocess'], 2);?></td><td><?php if (isset($row['manufacturingorderdoneline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['manufacturingorderdoneline__uom_id'], $row['uom__name']);?></td><td><?=$row['manufacturingorderdoneline__lastupdate'];?></td><td><?=$row['manufacturingorderdoneline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="manufacturing_order_done_to_rejectview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/manufacturing_order_done_to_rejectview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="manufacturing_order_done_to_rejectedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_done_to_rejectedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_done_to_rejectconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="manufacturing_order_done_to_rejectgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#reject').click(function(){$('#manufacturing_order_done_to_rejectlistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#manufacturing_order_done_to_rejectlistform').attr('action','<?=site_url();?>/reject_manufacturingadd/index/');});});</script><input id='reject' type="submit" value="Reject">
			
		</form>
		</div>