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
					target:        '#stock_adjustment_linelist',
					success: 		stock_adjustment_lineshowResponse,
		}; 
		
		$('#stock_adjustment_linelistform').submit(function() { 
			$('#stock_adjustment_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function stock_adjustment_lineconfirmdelete(delid, obj)
	{
		$('#stock_adjustment_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', stock_adjustment_lineconfirmdelete2(delid, obj));
	}
	
	function stock_adjustment_lineconfirmdelete2(delid, obj)
	{
		$( "#stock_adjustment_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					stock_adjustment_linecalldeletefn('stock_adjustment_linedelete', delid, 'stock_adjustment_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_adjustment_line-dialog-confirm').html('');
	}
	
	function stock_adjustment_linesortupdown(field, direction)
	{
		$("#stock_adjustment_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#stock_adjustment_linelist',
					success: 		stock_adjustment_lineshowResponse,
		}; 
		$('#stock_adjustment_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function stock_adjustment_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#stock_adjustment_linelist',
					success: 		stock_adjustment_lineshowResponse,
		}; 
		
		$('#stock_adjustment_linelistform').submit(function() { 
			$('#stock_adjustment_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function stock_adjustment_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function stock_adjustment_lineadd()
	{
		$('#stock_adjustment_lineformholder').load('<?=site_url()."/stock_adjustment_lineadd/";?>', function()
		{$('#stock_adjustment_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_adjustment_lineformholder' + '\').html(\'\');' + '$(\'' + '#stock_adjustment_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_adjustment_linelist' + '\').load(\'<?=site_url();?>/stock_adjustment_linelist\');' + ';"></input>');
		});	
	}
	
	function stock_adjustment_lineedit(id)
	{
		$('#stock_adjustment_lineformholder').load('<?=site_url()."/stock_adjustment_lineedit/index/";?>' + id, function()
		{$('#stock_adjustment_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_adjustment_lineformholder' + '\').html(\'\');' + '$(\'' + '#stock_adjustment_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_adjustment_linelist' + '\').load(\'<?=site_url();?>/stock_adjustment_linelist\');' + ';"></input>');
		});	
	}
	
	function stock_adjustment_lineview(id)
	{
		$('#stock_adjustment_lineformholder').load('<?=site_url()."/stock_adjustment_lineview/index/";?>' + id, function()
		{$('#stock_adjustment_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_adjustment_lineformholder' + '\').html(\'\');' + '$(\'' + '#stock_adjustment_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_adjustment_linelist' + '\').load(\'<?=site_url();?>/stock_adjustment_linelist\');' + ';"></input>');
		});	
	}
	
	function stock_adjustment_linegotopage()
	{
		var page = document.stock_adjustment_linelistform.pageno.options[document.stock_adjustment_linelistform.pageno.selectedIndex].value;
		
		$("#stock_adjustment_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#stock_adjustment_linelist',
					success: 		stock_adjustment_lineshowResponse,
		}; 
		$('#stock_adjustment_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="stock_adjustment_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="stock_adjustment_lineclosebutton"></div>
		<div id="stock_adjustment_lineformholder"></div>
		<div id="stock_adjustment_linelist">
		<!--<form method="post" action="<?=site_url();?>/stock_adjustment_linelist/index/" id="stock_adjustment_linelistform" name="stock_adjustment_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="stock_adjustment_linelistform" name="stock_adjustment_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="stock_adjustment_linecurrsort">
			</div>
			<div id="stock_adjustment_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="stock_adjustment_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/stock_adjustment_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/stock_adjustment_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="stock_adjustment_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="stock_adjustment_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="stock_adjustment_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="stock_adjustment_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/stock_adjustment_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['stockadjustmentline__coa_id']) && $row['coa__name'] != "") echo anchor('accountsview/index/'.$row['stockadjustmentline__coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['stockadjustmentline__item_id']) && $row['item__name'] != "") echo anchor('item_in_stockview/index/'.$row['stockadjustmentline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['stockadjustmentline__quantity'], 2);?></td><td><?php if (isset($row['stockadjustmentline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['stockadjustmentline__uom_id'], $row['uom__name']);?></td><td><?=$row['stockadjustmentline__lastupdate'];?></td><td><?=$row['stockadjustmentline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="stock_adjustment_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/stock_adjustment_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="stock_adjustment_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/stock_adjustment_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="stock_adjustment_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="stock_adjustment_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>