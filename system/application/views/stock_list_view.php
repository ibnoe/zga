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
					target:        '#stocklist',
					success: 		stockshowResponse,
		}; 
		
		$('#stocklistform').submit(function() { 
			$('#stocklistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function stockconfirmdelete(delid, obj)
	{
		$('#stock-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', stockconfirmdelete2(delid, obj));
	}
	
	function stockconfirmdelete2(delid, obj)
	{
		$( "#stock-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					stockcalldeletefn('stockdelete', delid, 'stocklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock-dialog-confirm').html('');
	}
	
	function stocksortupdown(field, direction)
	{
		$("#stockcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#stocklist',
					success: 		stockshowResponse,
		}; 
		$('#stocklistform').ajaxSubmit(options);
		return false;
	}
	
	function stockshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#stocklist',
					success: 		stockshowResponse,
		}; 
		
		$('#stocklistform').submit(function() { 
			$('#stocklistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function stockcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function stockadd()
	{
		$('#stockformholder').load('<?=site_url()."/stockadd/";?>', function()
		{$('#stockclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stockformholder' + '\').html(\'\');' + '$(\'' + '#stockclosebutton' + '\').html(\'\');' + '$(\'' + '#stocklist' + '\').load(\'<?=site_url();?>/stocklist\');' + ';"></input>');
		});	
	}
	
	function stockedit(id)
	{
		$('#stockformholder').load('<?=site_url()."/stockedit/index/";?>' + id, function()
		{$('#stockclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stockformholder' + '\').html(\'\');' + '$(\'' + '#stockclosebutton' + '\').html(\'\');' + '$(\'' + '#stocklist' + '\').load(\'<?=site_url();?>/stocklist\');' + ';"></input>');
		});	
	}
	
	function stockview(id)
	{
		$('#stockformholder').load('<?=site_url()."/stockview/index/";?>' + id, function()
		{$('#stockclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stockformholder' + '\').html(\'\');' + '$(\'' + '#stockclosebutton' + '\').html(\'\');' + '$(\'' + '#stocklist' + '\').load(\'<?=site_url();?>/stocklist\');' + ';"></input>');
		});	
	}
	
	function stockgotopage()
	{
		var page = document.stocklistform.pageno.options[document.stocklistform.pageno.selectedIndex].value;
		
		$("#stockcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#stocklist',
					success: 		stockshowResponse,
		}; 
		$('#stocklistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="stock-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="stockclosebutton"></div>
		<div id="stockformholder"></div>
		<div id="stocklist">
		<!--<form method="post" action="<?=site_url();?>/stocklist/index/" id="stocklistform" name="stocklistform">-->
		<form method="post" action="<?=current_url();?>" id="stocklistform" name="stocklistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#itemfilter').change(function() { $('#stocklistform').submit();});});</script>Item:&nbsp;<?=form_dropdown('item_id', $item_opt, $item_id, 'id="itemfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#warehousefilter').change(function() { $('#stocklistform').submit();});});</script>Warehouse:&nbsp;<?=form_dropdown('warehouse_id', $warehouse_opt, $warehouse_id, 'id="warehousefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="stockcurrsort">
			</div>
			<div id="stocksort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="stockadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/stockadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/stockadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="stocksortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="stocksortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="stocksortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="stocksortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/stockview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['stock__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['stock__item_id'], $row['item__name']);?></td><td><?php if (isset($row['stock__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['stock__itemcategory_id'], $row['itemcategory__name']);?></td><td><?php if (isset($row['stock__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['stock__warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['stock__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['stock__uom_id'], $row['uom__name']);?></td><td align='right'><?=number_format($row['stock__incoming'], 5);?></td><td align='right'><?=number_format($row['stock__current'], 5);?></td><td align='right'><?=number_format($row['stock__wouldbe'], 5);?></td><td align='right'><?=number_format($row['stock__outgoing'], 5);?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="stockview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/stockview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="stockedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/stockedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="stockconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="stockgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>