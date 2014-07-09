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
					target:        '#delivery_order_linelist',
					success: 		delivery_order_lineshowResponse,
		}; 
		
		$('#delivery_order_linelistform').submit(function() { 
			$('#delivery_order_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function delivery_order_lineconfirmdelete(delid, obj)
	{
		$('#delivery_order_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', delivery_order_lineconfirmdelete2(delid, obj));
	}
	
	function delivery_order_lineconfirmdelete2(delid, obj)
	{
		$( "#delivery_order_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					delivery_order_linecalldeletefn('delivery_order_linedelete', delid, 'delivery_order_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#delivery_order_line-dialog-confirm').html('');
	}
	
	function delivery_order_linesortupdown(field, direction)
	{
		$("#delivery_order_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#delivery_order_linelist',
					success: 		delivery_order_lineshowResponse,
		}; 
		$('#delivery_order_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function delivery_order_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#delivery_order_linelist',
					success: 		delivery_order_lineshowResponse,
		}; 
		
		$('#delivery_order_linelistform').submit(function() { 
			$('#delivery_order_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function delivery_order_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function delivery_order_lineadd()
	{
		$('#delivery_order_lineformholder').load('<?=site_url()."/delivery_order_lineadd/";?>', function()
		{$('#delivery_order_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_order_lineformholder' + '\').html(\'\');' + '$(\'' + '#delivery_order_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_order_linelist' + '\').load(\'<?=site_url();?>/delivery_order_linelist\');' + ';"></input>');
		});	
	}
	
	function delivery_order_lineedit(id)
	{
		$('#delivery_order_lineformholder').load('<?=site_url()."/delivery_order_lineedit/index/";?>' + id, function()
		{$('#delivery_order_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_order_lineformholder' + '\').html(\'\');' + '$(\'' + '#delivery_order_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_order_linelist' + '\').load(\'<?=site_url();?>/delivery_order_linelist\');' + ';"></input>');
		});	
	}
	
	function delivery_order_lineview(id)
	{
		$('#delivery_order_lineformholder').load('<?=site_url()."/delivery_order_lineview/index/";?>' + id, function()
		{$('#delivery_order_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_order_lineformholder' + '\').html(\'\');' + '$(\'' + '#delivery_order_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_order_linelist' + '\').load(\'<?=site_url();?>/delivery_order_linelist\');' + ';"></input>');
		});	
	}
	
	function delivery_order_linegotopage()
	{
		var page = document.delivery_order_linelistform.pageno.options[document.delivery_order_linelistform.pageno.selectedIndex].value;
		
		$("#delivery_order_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#delivery_order_linelist',
					success: 		delivery_order_lineshowResponse,
		}; 
		$('#delivery_order_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="delivery_order_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="delivery_order_lineclosebutton"></div>
		<div id="delivery_order_lineformholder"></div>
		<div id="delivery_order_linelist">
		<!--<form method="post" action="<?=site_url();?>/delivery_order_linelist/index/" id="delivery_order_linelistform" name="delivery_order_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="delivery_order_linelistform" name="delivery_order_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="delivery_order_linecurrsort">
			</div>
			<div id="delivery_order_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="delivery_order_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/delivery_order_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/delivery_order_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="delivery_order_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="delivery_order_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="delivery_order_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="delivery_order_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/delivery_order_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['deliveryorderline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['deliveryorderline__item_id'], $row['item__name']);?></td><td><?=anchor('delivery_order_lineview/index/'.$row['id'], $row['deliveryorderline__quantitytosend']);?></td><td><?php if (isset($row['deliveryorderline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['deliveryorderline__uom_id'], $row['uom__name']);?></td><td><?=$row['deliveryorderline__lastupdate'];?></td><td><?=$row['deliveryorderline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="delivery_order_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/delivery_order_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="delivery_order_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/delivery_order_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="delivery_order_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="delivery_order_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>