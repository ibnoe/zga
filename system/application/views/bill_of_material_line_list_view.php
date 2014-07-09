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
					target:        '#bill_of_material_linelist',
					success: 		bill_of_material_lineshowResponse,
		}; 
		
		$('#bill_of_material_linelistform').submit(function() { 
			$('#bill_of_material_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function bill_of_material_lineconfirmdelete(delid, obj)
	{
		$('#bill_of_material_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', bill_of_material_lineconfirmdelete2(delid, obj));
	}
	
	function bill_of_material_lineconfirmdelete2(delid, obj)
	{
		$( "#bill_of_material_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					bill_of_material_linecalldeletefn('bill_of_material_linedelete', delid, 'bill_of_material_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bill_of_material_line-dialog-confirm').html('');
	}
	
	function bill_of_material_linesortupdown(field, direction)
	{
		$("#bill_of_material_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#bill_of_material_linelist',
					success: 		bill_of_material_lineshowResponse,
		}; 
		$('#bill_of_material_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function bill_of_material_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#bill_of_material_linelist',
					success: 		bill_of_material_lineshowResponse,
		}; 
		
		$('#bill_of_material_linelistform').submit(function() { 
			$('#bill_of_material_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function bill_of_material_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function bill_of_material_lineadd()
	{
		$('#bill_of_material_lineformholder').load('<?=site_url()."/bill_of_material_lineadd/";?>', function()
		{$('#bill_of_material_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#bill_of_material_lineformholder' + '\').html(\'\');' + '$(\'' + '#bill_of_material_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#bill_of_material_linelist' + '\').load(\'<?=site_url();?>/bill_of_material_linelist\');' + ';"></input>');
		});	
	}
	
	function bill_of_material_lineedit(id)
	{
		$('#bill_of_material_lineformholder').load('<?=site_url()."/bill_of_material_lineedit/index/";?>' + id, function()
		{$('#bill_of_material_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#bill_of_material_lineformholder' + '\').html(\'\');' + '$(\'' + '#bill_of_material_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#bill_of_material_linelist' + '\').load(\'<?=site_url();?>/bill_of_material_linelist\');' + ';"></input>');
		});	
	}
	
	function bill_of_material_lineview(id)
	{
		$('#bill_of_material_lineformholder').load('<?=site_url()."/bill_of_material_lineview/index/";?>' + id, function()
		{$('#bill_of_material_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#bill_of_material_lineformholder' + '\').html(\'\');' + '$(\'' + '#bill_of_material_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#bill_of_material_linelist' + '\').load(\'<?=site_url();?>/bill_of_material_linelist\');' + ';"></input>');
		});	
	}
	
	function bill_of_material_linegotopage()
	{
		var page = document.bill_of_material_linelistform.pageno.options[document.bill_of_material_linelistform.pageno.selectedIndex].value;
		
		$("#bill_of_material_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#bill_of_material_linelist',
					success: 		bill_of_material_lineshowResponse,
		}; 
		$('#bill_of_material_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="bill_of_material_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="bill_of_material_lineclosebutton"></div>
		<div id="bill_of_material_lineformholder"></div>
		<div id="bill_of_material_linelist">
		<!--<form method="post" action="<?=site_url();?>/bill_of_material_linelist/index/" id="bill_of_material_linelistform" name="bill_of_material_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="bill_of_material_linelistform" name="bill_of_material_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="bill_of_material_linecurrsort">
			</div>
			<div id="bill_of_material_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="bill_of_material_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/bill_of_material_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/bill_of_material_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="bill_of_material_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="bill_of_material_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="bill_of_material_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="bill_of_material_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/bill_of_material_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['bomline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['bomline__item_id'], $row['item__name']);?></td><td><?=anchor('bill_of_material_lineview/index/'.$row['id'], $row['bomline__quantity']);?></td><td><?php if (isset($row['bomline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['bomline__uom_id'], $row['uom__name']);?></td><td><?=$row['bomline__lastupdate'];?></td><td><?=$row['bomline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="bill_of_material_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/bill_of_material_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="bill_of_material_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/bill_of_material_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="bill_of_material_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="bill_of_material_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>