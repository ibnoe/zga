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
					target:        '#surat_pengajuan_repair_linelist',
					success: 		surat_pengajuan_repair_lineshowResponse,
		}; 
		
		$('#surat_pengajuan_repair_linelistform').submit(function() { 
			$('#surat_pengajuan_repair_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function surat_pengajuan_repair_lineconfirmdelete(delid, obj)
	{
		$('#surat_pengajuan_repair_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', surat_pengajuan_repair_lineconfirmdelete2(delid, obj));
	}
	
	function surat_pengajuan_repair_lineconfirmdelete2(delid, obj)
	{
		$( "#surat_pengajuan_repair_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					surat_pengajuan_repair_linecalldeletefn('surat_pengajuan_repair_linedelete', delid, 'surat_pengajuan_repair_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#surat_pengajuan_repair_line-dialog-confirm').html('');
	}
	
	function surat_pengajuan_repair_linesortupdown(field, direction)
	{
		$("#surat_pengajuan_repair_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#surat_pengajuan_repair_linelist',
					success: 		surat_pengajuan_repair_lineshowResponse,
		}; 
		$('#surat_pengajuan_repair_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function surat_pengajuan_repair_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#surat_pengajuan_repair_linelist',
					success: 		surat_pengajuan_repair_lineshowResponse,
		}; 
		
		$('#surat_pengajuan_repair_linelistform').submit(function() { 
			$('#surat_pengajuan_repair_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function surat_pengajuan_repair_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function surat_pengajuan_repair_lineadd()
	{
		$('#surat_pengajuan_repair_lineformholder').load('<?=site_url()."/surat_pengajuan_repair_lineadd/";?>', function()
		{$('#surat_pengajuan_repair_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#surat_pengajuan_repair_lineformholder' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repair_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repair_linelist' + '\').load(\'<?=site_url();?>/surat_pengajuan_repair_linelist\');' + ';"></input>');
		});	
	}
	
	function surat_pengajuan_repair_lineedit(id)
	{
		$('#surat_pengajuan_repair_lineformholder').load('<?=site_url()."/surat_pengajuan_repair_lineedit/index/";?>' + id, function()
		{$('#surat_pengajuan_repair_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#surat_pengajuan_repair_lineformholder' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repair_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repair_linelist' + '\').load(\'<?=site_url();?>/surat_pengajuan_repair_linelist\');' + ';"></input>');
		});	
	}
	
	function surat_pengajuan_repair_lineview(id)
	{
		$('#surat_pengajuan_repair_lineformholder').load('<?=site_url()."/surat_pengajuan_repair_lineview/index/";?>' + id, function()
		{$('#surat_pengajuan_repair_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#surat_pengajuan_repair_lineformholder' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repair_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repair_linelist' + '\').load(\'<?=site_url();?>/surat_pengajuan_repair_linelist\');' + ';"></input>');
		});	
	}
	
	function surat_pengajuan_repair_linegotopage()
	{
		var page = document.surat_pengajuan_repair_linelistform.pageno.options[document.surat_pengajuan_repair_linelistform.pageno.selectedIndex].value;
		
		$("#surat_pengajuan_repair_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#surat_pengajuan_repair_linelist',
					success: 		surat_pengajuan_repair_lineshowResponse,
		}; 
		$('#surat_pengajuan_repair_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="surat_pengajuan_repair_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="surat_pengajuan_repair_lineclosebutton"></div>
		<div id="surat_pengajuan_repair_lineformholder"></div>
		<div id="surat_pengajuan_repair_linelist">
		<!--<form method="post" action="<?=site_url();?>/surat_pengajuan_repair_linelist/index/" id="surat_pengajuan_repair_linelistform" name="surat_pengajuan_repair_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="surat_pengajuan_repair_linelistform" name="surat_pengajuan_repair_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="surat_pengajuan_repair_linecurrsort">
			</div>
			<div id="surat_pengajuan_repair_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="surat_pengajuan_repair_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/surat_pengajuan_repair_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/surat_pengajuan_repair_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="surat_pengajuan_repair_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="surat_pengajuan_repair_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="surat_pengajuan_repair_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="surat_pengajuan_repair_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/surat_pengajuan_repair_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('surat_pengajuan_repair_lineview/index/'.$row['id'], $row['suratpengajuanrepairline__nodiss']);?></td><td><?php if (isset($row['suratpengajuanrepairline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['suratpengajuanrepairline__item_id'], $row['item__name']);?></td><td><?php if (isset($row['suratpengajuanrepairline__customer_id']) && $row['customer__idstring'] != "") echo anchor('customerview/index/'.$row['suratpengajuanrepairline__customer_id'], $row['customer__idstring']);?></td><td><?php if (isset($row['suratpengajuanrepairline__mesin_id']) && $row['mesin__typename'] != "") echo anchor('mesinview/index/'.$row['suratpengajuanrepairline__mesin_id'], $row['mesin__typename']);?></td><td><?=$row['suratpengajuanrepairline__tipecore'];?></td><td align='right'><?=number_format($row['suratpengajuanrepairline__rolldiameter'], 2);?></td><td align='right'><?=number_format($row['suratpengajuanrepairline__bearingseatdiameter'], 2);?></td><td align='right'><?=number_format($row['suratpengajuanrepairline__totallength'], 2);?></td><td align='right'><?=number_format($row['suratpengajuanrepairline__quantity'], 2);?></td><td><?=$row['suratpengajuanrepairline__jenisrepair'];?></td><td><?=$row['suratpengajuanrepairline__notes'];?></td><td><?=$row['suratpengajuanrepairline__lastupdate'];?></td><td><?=$row['suratpengajuanrepairline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="surat_pengajuan_repair_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/surat_pengajuan_repair_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="surat_pengajuan_repair_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/surat_pengajuan_repair_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="surat_pengajuan_repair_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="surat_pengajuan_repair_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>