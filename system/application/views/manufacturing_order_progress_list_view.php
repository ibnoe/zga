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
					target:        '#manufacturing_order_progresslist',
					success: 		manufacturing_order_progressshowResponse,
		}; 
		
		$('#manufacturing_order_progresslistform').submit(function() { 
			$('#manufacturing_order_progresslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function manufacturing_order_progressconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_progress-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_progressconfirmdelete2(delid, obj));
	}
	
	function manufacturing_order_progressconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_progress-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_progresscalldeletefn('manufacturing_order_progressdelete', delid, 'manufacturing_order_progresslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_progress-dialog-confirm').html('');
	}
	
	function manufacturing_order_progresssortupdown(field, direction)
	{
		$("#manufacturing_order_progresscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#manufacturing_order_progresslist',
					success: 		manufacturing_order_progressshowResponse,
		}; 
		$('#manufacturing_order_progresslistform').ajaxSubmit(options);
		return false;
	}
	
	function manufacturing_order_progressshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#manufacturing_order_progresslist',
					success: 		manufacturing_order_progressshowResponse,
		}; 
		
		$('#manufacturing_order_progresslistform').submit(function() { 
			$('#manufacturing_order_progresslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function manufacturing_order_progresscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function manufacturing_order_progressadd()
	{
		$('#manufacturing_order_progressformholder').load('<?=site_url()."/manufacturing_order_progressadd/";?>', function()
		{$('#manufacturing_order_progressclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_progressformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_progressclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_progresslist' + '\').load(\'<?=site_url();?>/manufacturing_order_progresslist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_progressedit(id)
	{
		$('#manufacturing_order_progressformholder').load('<?=site_url()."/manufacturing_order_progressedit/index/";?>' + id, function()
		{$('#manufacturing_order_progressclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_progressformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_progressclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_progresslist' + '\').load(\'<?=site_url();?>/manufacturing_order_progresslist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_progressview(id)
	{
		$('#manufacturing_order_progressformholder').load('<?=site_url()."/manufacturing_order_progressview/index/";?>' + id, function()
		{$('#manufacturing_order_progressclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_progressformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_progressclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_progresslist' + '\').load(\'<?=site_url();?>/manufacturing_order_progresslist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_progressgotopage()
	{
		var page = document.manufacturing_order_progresslistform.pageno.options[document.manufacturing_order_progresslistform.pageno.selectedIndex].value;
		
		$("#manufacturing_order_progresscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#manufacturing_order_progresslist',
					success: 		manufacturing_order_progressshowResponse,
		}; 
		$('#manufacturing_order_progresslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="manufacturing_order_progress-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="manufacturing_order_progressclosebutton"></div>
		<div id="manufacturing_order_progressformholder"></div>
		<div id="manufacturing_order_progresslist">
		<!--<form method="post" action="<?=site_url();?>/manufacturing_order_progresslist/index/" id="manufacturing_order_progresslistform" name="manufacturing_order_progresslistform">-->
		<form method="post" action="<?=current_url();?>" id="manufacturing_order_progresslistform" name="manufacturing_order_progresslistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#itemfilter').change(function() { $('#manufacturing_order_progresslistform').submit();});});</script>Item:&nbsp;<?=form_dropdown('item_id', $item_opt, $item_id, 'id="itemfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#categoryfilter').change(function() { $('#manufacturing_order_progresslistform').submit();});});</script>Category:&nbsp;<?=form_dropdown('itemcategory_id', $itemcategory_opt, $itemcategory_id, 'id="categoryfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#datefilter').change(function() { $('#manufacturing_order_progresslistform').submit();});});</script>Date:&nbsp;<?=form_dropdown('date', $date_opt, $date, 'id="datefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="manufacturing_order_progresscurrsort">
			</div>
			<div id="manufacturing_order_progresssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="manufacturing_order_progressadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_order_progressadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_order_progressadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="manufacturing_order_progresssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="manufacturing_order_progresssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="manufacturing_order_progresssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="manufacturing_order_progresssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('manufacturingorder__id[]', $row['manufacturingorder__id'], false);?></td><td><?=$row['manufacturingorder__date'];?></td><td><?=$row['manufacturingorder__idstring'];?></td><td><?php if (isset($row['manufacturingorder__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['manufacturingorder__item_id'], $row['item__name']);?></td><td><?php if (isset($row['manufacturingorder__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['manufacturingorder__itemcategory_id'], $row['itemcategory__name']);?></td><td align='right'><?=number_format($row['manufacturingorder__quantity'], 2);?></td><td align='right'><?=number_format($row['manufacturingorder__quantitytoprocess'], 2);?></td><td><?php if (isset($row['manufacturingorder__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['manufacturingorder__uom_id'], $row['uom__name']);?></td><td><?php if (isset($row['manufacturingorder__bom_id']) && $row['bom__name'] != "") echo anchor('bill_of_materialview/index/'.$row['manufacturingorder__bom_id'], $row['bom__name']);?></td><td><?=$row['manufacturingorder__lastupdate'];?></td><td><?=$row['manufacturingorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="manufacturing_order_progressview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/manufacturing_order_progressview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="manufacturing_order_progressedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_progressedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_progressconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="manufacturing_order_progressgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#manufacturing_order_done').click(function(){$('#manufacturing_order_progresslistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#manufacturing_order_progresslistform').attr('action','<?=site_url();?>/manufacturing_order_doneadd/index/');});});</script><input id='manufacturing_order_done' type="submit" value="Manufacturing Order Done">
			
		</form>
		</div>