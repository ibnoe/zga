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
					target:        '#permintaan_stock_linelist',
					success: 		permintaan_stock_lineshowResponse,
		}; 
		
		$('#permintaan_stock_linelistform').submit(function() { 
			$('#permintaan_stock_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function permintaan_stock_lineconfirmdelete(delid, obj)
	{
		$('#permintaan_stock_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', permintaan_stock_lineconfirmdelete2(delid, obj));
	}
	
	function permintaan_stock_lineconfirmdelete2(delid, obj)
	{
		$( "#permintaan_stock_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					permintaan_stock_linecalldeletefn('permintaan_stock_linedelete', delid, 'permintaan_stock_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock_line-dialog-confirm').html('');
	}
	
	function permintaan_stock_linesortupdown(field, direction)
	{
		$("#permintaan_stock_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#permintaan_stock_linelist',
					success: 		permintaan_stock_lineshowResponse,
		}; 
		$('#permintaan_stock_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function permintaan_stock_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#permintaan_stock_linelist',
					success: 		permintaan_stock_lineshowResponse,
		}; 
		
		$('#permintaan_stock_linelistform').submit(function() { 
			$('#permintaan_stock_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function permintaan_stock_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function permintaan_stock_lineadd()
	{
		$('#permintaan_stock_lineformholder').load('<?=site_url()."/permintaan_stock_lineadd/";?>', function()
		{$('#permintaan_stock_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#permintaan_stock_lineformholder' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_linelist' + '\').load(\'<?=site_url();?>/permintaan_stock_linelist\');' + ';"></input>');
		});	
	}
	
	function permintaan_stock_lineedit(id)
	{
		$('#permintaan_stock_lineformholder').load('<?=site_url()."/permintaan_stock_lineedit/index/";?>' + id, function()
		{$('#permintaan_stock_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#permintaan_stock_lineformholder' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_linelist' + '\').load(\'<?=site_url();?>/permintaan_stock_linelist\');' + ';"></input>');
		});	
	}
	
	function permintaan_stock_lineview(id)
	{
		$('#permintaan_stock_lineformholder').load('<?=site_url()."/permintaan_stock_lineview/index/";?>' + id, function()
		{$('#permintaan_stock_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#permintaan_stock_lineformholder' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_linelist' + '\').load(\'<?=site_url();?>/permintaan_stock_linelist\');' + ';"></input>');
		});	
	}
	
	function permintaan_stock_linegotopage()
	{
		var page = document.permintaan_stock_linelistform.pageno.options[document.permintaan_stock_linelistform.pageno.selectedIndex].value;
		
		$("#permintaan_stock_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#permintaan_stock_linelist',
					success: 		permintaan_stock_lineshowResponse,
		}; 
		$('#permintaan_stock_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="permintaan_stock_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="permintaan_stock_lineclosebutton"></div>
		<div id="permintaan_stock_lineformholder"></div>
		<div id="permintaan_stock_linelist">
		<!--<form method="post" action="<?=site_url();?>/permintaan_stock_linelist/index/" id="permintaan_stock_linelistform" name="permintaan_stock_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="permintaan_stock_linelistform" name="permintaan_stock_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="permintaan_stock_linecurrsort">
			</div>
			<div id="permintaan_stock_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="permintaan_stock_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/permintaan_stock_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/permintaan_stock_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="permintaan_stock_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="permintaan_stock_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="permintaan_stock_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="permintaan_stock_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/permintaan_stock_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['permintaanstockline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['permintaanstockline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['permintaanstockline__quantity'], 2);?></td><td><?php if (isset($row['permintaanstockline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['permintaanstockline__uom_id'], $row['uom__name']);?></td><td><?=$row['permintaanstockline__lastupdate'];?></td><td><?=$row['permintaanstockline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="permintaan_stock_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/permintaan_stock_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="permintaan_stock_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/permintaan_stock_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="permintaan_stock_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="permintaan_stock_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>