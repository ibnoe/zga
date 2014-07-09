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
					target:        '#penawaran_linelist',
					success: 		penawaran_lineshowResponse,
		}; 
		
		$('#penawaran_linelistform').submit(function() { 
			$('#penawaran_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function penawaran_lineconfirmdelete(delid, obj)
	{
		$('#penawaran_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', penawaran_lineconfirmdelete2(delid, obj));
	}
	
	function penawaran_lineconfirmdelete2(delid, obj)
	{
		$( "#penawaran_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					penawaran_linecalldeletefn('penawaran_linedelete', delid, 'penawaran_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penawaran_line-dialog-confirm').html('');
	}
	
	function penawaran_linesortupdown(field, direction)
	{
		$("#penawaran_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#penawaran_linelist',
					success: 		penawaran_lineshowResponse,
		}; 
		$('#penawaran_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function penawaran_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#penawaran_linelist',
					success: 		penawaran_lineshowResponse,
		}; 
		
		$('#penawaran_linelistform').submit(function() { 
			$('#penawaran_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function penawaran_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function penawaran_lineadd()
	{
		$('#penawaran_lineformholder').load('<?=site_url()."/penawaran_lineadd/";?>', function()
		{$('#penawaran_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penawaran_lineformholder' + '\').html(\'\');' + '$(\'' + '#penawaran_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#penawaran_linelist' + '\').load(\'<?=site_url();?>/penawaran_linelist\');' + ';"></input>');
		});	
	}
	
	function penawaran_lineedit(id)
	{
		$('#penawaran_lineformholder').load('<?=site_url()."/penawaran_lineedit/index/";?>' + id, function()
		{$('#penawaran_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penawaran_lineformholder' + '\').html(\'\');' + '$(\'' + '#penawaran_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#penawaran_linelist' + '\').load(\'<?=site_url();?>/penawaran_linelist\');' + ';"></input>');
		});	
	}
	
	function penawaran_lineview(id)
	{
		$('#penawaran_lineformholder').load('<?=site_url()."/penawaran_lineview/index/";?>' + id, function()
		{$('#penawaran_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penawaran_lineformholder' + '\').html(\'\');' + '$(\'' + '#penawaran_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#penawaran_linelist' + '\').load(\'<?=site_url();?>/penawaran_linelist\');' + ';"></input>');
		});	
	}
	
	function penawaran_linegotopage()
	{
		var page = document.penawaran_linelistform.pageno.options[document.penawaran_linelistform.pageno.selectedIndex].value;
		
		$("#penawaran_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#penawaran_linelist',
					success: 		penawaran_lineshowResponse,
		}; 
		$('#penawaran_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="penawaran_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="penawaran_lineclosebutton"></div>
		<div id="penawaran_lineformholder"></div>
		<div id="penawaran_linelist">
		<!--<form method="post" action="<?=site_url();?>/penawaran_linelist/index/" id="penawaran_linelistform" name="penawaran_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="penawaran_linelistform" name="penawaran_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="penawaran_linecurrsort">
			</div>
			<div id="penawaran_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="penawaran_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/penawaran_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/penawaran_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="penawaran_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="penawaran_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="penawaran_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="penawaran_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/penawaran_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['salesorderquoteline__type'];?></td><td><?php if (isset($row['salesorderquoteline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['salesorderquoteline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['salesorderquoteline__quantity'], 2);?></td><td><?php if (isset($row['salesorderquoteline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['salesorderquoteline__uom_id'], $row['uom__name']);?></td><td align='right'><?=number_format($row['salesorderquoteline__price'], 2);?></td><td align='right'><?=number_format($row['salesorderquoteline__pdisc'], 2);?></td><td align='right'><?=number_format($row['salesorderquoteline__subtotal'], 2);?></td><td><?=$row['salesorderquoteline__lastupdate'];?></td><td><?=$row['salesorderquoteline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="penawaran_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/penawaran_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="penawaran_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/penawaran_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="penawaran_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="penawaran_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>