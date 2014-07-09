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
					target:        '#spp_linelist',
					success: 		spp_lineshowResponse,
		}; 
		
		$('#spp_linelistform').submit(function() { 
			$('#spp_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function spp_lineconfirmdelete(delid, obj)
	{
		$('#spp_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', spp_lineconfirmdelete2(delid, obj));
	}
	
	function spp_lineconfirmdelete2(delid, obj)
	{
		$( "#spp_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					spp_linecalldeletefn('spp_linedelete', delid, 'spp_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#spp_line-dialog-confirm').html('');
	}
	
	function spp_linesortupdown(field, direction)
	{
		$("#spp_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#spp_linelist',
					success: 		spp_lineshowResponse,
		}; 
		$('#spp_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function spp_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#spp_linelist',
					success: 		spp_lineshowResponse,
		}; 
		
		$('#spp_linelistform').submit(function() { 
			$('#spp_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function spp_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function spp_lineadd()
	{
		$('#spp_lineformholder').load('<?=site_url()."/spp_lineadd/";?>', function()
		{$('#spp_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#spp_lineformholder' + '\').html(\'\');' + '$(\'' + '#spp_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#spp_linelist' + '\').load(\'<?=site_url();?>/spp_linelist\');' + ';"></input>');
		});	
	}
	
	function spp_lineedit(id)
	{
		$('#spp_lineformholder').load('<?=site_url()."/spp_lineedit/index/";?>' + id, function()
		{$('#spp_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#spp_lineformholder' + '\').html(\'\');' + '$(\'' + '#spp_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#spp_linelist' + '\').load(\'<?=site_url();?>/spp_linelist\');' + ';"></input>');
		});	
	}
	
	function spp_lineview(id)
	{
		$('#spp_lineformholder').load('<?=site_url()."/spp_lineview/index/";?>' + id, function()
		{$('#spp_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#spp_lineformholder' + '\').html(\'\');' + '$(\'' + '#spp_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#spp_linelist' + '\').load(\'<?=site_url();?>/spp_linelist\');' + ';"></input>');
		});	
	}
	
	function spp_linegotopage()
	{
		var page = document.spp_linelistform.pageno.options[document.spp_linelistform.pageno.selectedIndex].value;
		
		$("#spp_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#spp_linelist',
					success: 		spp_lineshowResponse,
		}; 
		$('#spp_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="spp_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="spp_lineclosebutton"></div>
		<div id="spp_lineformholder"></div>
		<div id="spp_linelist">
		<!--<form method="post" action="<?=site_url();?>/spp_linelist/index/" id="spp_linelistform" name="spp_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="spp_linelistform" name="spp_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="spp_linecurrsort">
			</div>
			<div id="spp_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="spp_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/spp_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/spp_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="spp_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="spp_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="spp_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="spp_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/spp_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['suratpermintaanpembelianline__item_id']) && $row['item__name'] != "") echo anchor('purchaseable_itemview/index/'.$row['suratpermintaanpembelianline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['suratpermintaanpembelianline__quantity'], 2);?></td><td><?php if (isset($row['suratpermintaanpembelianline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['suratpermintaanpembelianline__uom_id'], $row['uom__name']);?></td><td><?=$row['suratpermintaanpembelianline__lastupdate'];?></td><td><?=$row['suratpermintaanpembelianline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="spp_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/spp_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="spp_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/spp_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="spp_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="spp_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>