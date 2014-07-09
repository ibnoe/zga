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
					target:        '#manufacturing_order_done_linelist',
					success: 		manufacturing_order_done_lineshowResponse,
		}; 
		
		$('#manufacturing_order_done_linelistform').submit(function() { 
			$('#manufacturing_order_done_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function manufacturing_order_done_lineconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_done_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_done_lineconfirmdelete2(delid, obj));
	}
	
	function manufacturing_order_done_lineconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_done_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_done_linecalldeletefn('manufacturing_order_done_linedelete', delid, 'manufacturing_order_done_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_done_line-dialog-confirm').html('');
	}
	
	function manufacturing_order_done_linesortupdown(field, direction)
	{
		$("#manufacturing_order_done_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#manufacturing_order_done_linelist',
					success: 		manufacturing_order_done_lineshowResponse,
		}; 
		$('#manufacturing_order_done_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function manufacturing_order_done_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#manufacturing_order_done_linelist',
					success: 		manufacturing_order_done_lineshowResponse,
		}; 
		
		$('#manufacturing_order_done_linelistform').submit(function() { 
			$('#manufacturing_order_done_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function manufacturing_order_done_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function manufacturing_order_done_lineadd()
	{
		$('#manufacturing_order_done_lineformholder').load('<?=site_url()."/manufacturing_order_done_lineadd/";?>', function()
		{$('#manufacturing_order_done_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_done_lineformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_linelist' + '\').load(\'<?=site_url();?>/manufacturing_order_done_linelist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_done_lineedit(id)
	{
		$('#manufacturing_order_done_lineformholder').load('<?=site_url()."/manufacturing_order_done_lineedit/index/";?>' + id, function()
		{$('#manufacturing_order_done_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_done_lineformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_linelist' + '\').load(\'<?=site_url();?>/manufacturing_order_done_linelist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_done_lineview(id)
	{
		$('#manufacturing_order_done_lineformholder').load('<?=site_url()."/manufacturing_order_done_lineview/index/";?>' + id, function()
		{$('#manufacturing_order_done_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_done_lineformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_done_linelist' + '\').load(\'<?=site_url();?>/manufacturing_order_done_linelist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_done_linegotopage()
	{
		var page = document.manufacturing_order_done_linelistform.pageno.options[document.manufacturing_order_done_linelistform.pageno.selectedIndex].value;
		
		$("#manufacturing_order_done_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#manufacturing_order_done_linelist',
					success: 		manufacturing_order_done_lineshowResponse,
		}; 
		$('#manufacturing_order_done_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="manufacturing_order_done_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="manufacturing_order_done_lineclosebutton"></div>
		<div id="manufacturing_order_done_lineformholder"></div>
		<div id="manufacturing_order_done_linelist">
		<!--<form method="post" action="<?=site_url();?>/manufacturing_order_done_linelist/index/" id="manufacturing_order_done_linelistform" name="manufacturing_order_done_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="manufacturing_order_done_linelistform" name="manufacturing_order_done_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="manufacturing_order_done_linecurrsort">
			</div>
			<div id="manufacturing_order_done_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="manufacturing_order_done_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_order_done_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_order_done_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="manufacturing_order_done_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="manufacturing_order_done_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="manufacturing_order_done_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="manufacturing_order_done_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/manufacturing_order_done_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['manufacturingorderdoneline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['manufacturingorderdoneline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['manufacturingorderdoneline__quantitytoprocess'], 2);?></td><td><?php if (isset($row['manufacturingorderdoneline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['manufacturingorderdoneline__uom_id'], $row['uom__name']);?></td><td><?=$row['manufacturingorderdoneline__lastupdate'];?></td><td><?=$row['manufacturingorderdoneline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="manufacturing_order_done_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/manufacturing_order_done_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="manufacturing_order_done_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_done_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_done_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="manufacturing_order_done_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>