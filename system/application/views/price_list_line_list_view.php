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
					target:        '#price_list_linelist',
					success: 		price_list_lineshowResponse,
		}; 
		
		$('#price_list_linelistform').submit(function() { 
			$('#price_list_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function price_list_lineconfirmdelete(delid, obj)
	{
		$('#price_list_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', price_list_lineconfirmdelete2(delid, obj));
	}
	
	function price_list_lineconfirmdelete2(delid, obj)
	{
		$( "#price_list_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					price_list_linecalldeletefn('price_list_linedelete', delid, 'price_list_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#price_list_line-dialog-confirm').html('');
	}
	
	function price_list_linesortupdown(field, direction)
	{
		$("#price_list_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#price_list_linelist',
					success: 		price_list_lineshowResponse,
		}; 
		$('#price_list_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function price_list_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#price_list_linelist',
					success: 		price_list_lineshowResponse,
		}; 
		
		$('#price_list_linelistform').submit(function() { 
			$('#price_list_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function price_list_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function price_list_lineadd()
	{
		$('#price_list_lineformholder').load('<?=site_url()."/price_list_lineadd/";?>', function()
		{$('#price_list_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#price_list_lineformholder' + '\').html(\'\');' + '$(\'' + '#price_list_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#price_list_linelist' + '\').load(\'<?=site_url();?>/price_list_linelist\');' + ';"></input>');
		});	
	}
	
	function price_list_lineedit(id)
	{
		$('#price_list_lineformholder').load('<?=site_url()."/price_list_lineedit/index/";?>' + id, function()
		{$('#price_list_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#price_list_lineformholder' + '\').html(\'\');' + '$(\'' + '#price_list_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#price_list_linelist' + '\').load(\'<?=site_url();?>/price_list_linelist\');' + ';"></input>');
		});	
	}
	
	function price_list_lineview(id)
	{
		$('#price_list_lineformholder').load('<?=site_url()."/price_list_lineview/index/";?>' + id, function()
		{$('#price_list_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#price_list_lineformholder' + '\').html(\'\');' + '$(\'' + '#price_list_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#price_list_linelist' + '\').load(\'<?=site_url();?>/price_list_linelist\');' + ';"></input>');
		});	
	}
	
	function price_list_linegotopage()
	{
		var page = document.price_list_linelistform.pageno.options[document.price_list_linelistform.pageno.selectedIndex].value;
		
		$("#price_list_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#price_list_linelist',
					success: 		price_list_lineshowResponse,
		}; 
		$('#price_list_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="price_list_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="price_list_lineclosebutton"></div>
		<div id="price_list_lineformholder"></div>
		<div id="price_list_linelist">
		<!--<form method="post" action="<?=site_url();?>/price_list_linelist/index/" id="price_list_linelistform" name="price_list_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="price_list_linelistform" name="price_list_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="price_list_linecurrsort">
			</div>
			<div id="price_list_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="price_list_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/price_list_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/price_list_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="price_list_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="price_list_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="price_list_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="price_list_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/price_list_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['pricelistline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['pricelistline__item_id'], $row['item__name']);?></td><td><?=anchor('price_list_lineview/index/'.$row['id'], $row['pricelistline__pdisc']);?></td><td align='right'><?=number_format($row['pricelistline__price'], 2);?></td><td><?=$row['pricelistline__lastupdate'];?></td><td><?=$row['pricelistline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="price_list_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/price_list_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="price_list_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/price_list_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="price_list_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="price_list_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>