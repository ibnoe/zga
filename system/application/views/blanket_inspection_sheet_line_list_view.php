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
					target:        '#blanket_inspection_sheet_linelist',
					success: 		blanket_inspection_sheet_lineshowResponse,
		}; 
		
		$('#blanket_inspection_sheet_linelistform').submit(function() { 
			$('#blanket_inspection_sheet_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function blanket_inspection_sheet_lineconfirmdelete(delid, obj)
	{
		$('#blanket_inspection_sheet_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', blanket_inspection_sheet_lineconfirmdelete2(delid, obj));
	}
	
	function blanket_inspection_sheet_lineconfirmdelete2(delid, obj)
	{
		$( "#blanket_inspection_sheet_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					blanket_inspection_sheet_linecalldeletefn('blanket_inspection_sheet_linedelete', delid, 'blanket_inspection_sheet_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket_inspection_sheet_line-dialog-confirm').html('');
	}
	
	function blanket_inspection_sheet_linesortupdown(field, direction)
	{
		$("#blanket_inspection_sheet_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#blanket_inspection_sheet_linelist',
					success: 		blanket_inspection_sheet_lineshowResponse,
		}; 
		$('#blanket_inspection_sheet_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function blanket_inspection_sheet_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#blanket_inspection_sheet_linelist',
					success: 		blanket_inspection_sheet_lineshowResponse,
		}; 
		
		$('#blanket_inspection_sheet_linelistform').submit(function() { 
			$('#blanket_inspection_sheet_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function blanket_inspection_sheet_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function blanket_inspection_sheet_lineadd()
	{
		$('#blanket_inspection_sheet_lineformholder').load('<?=site_url()."/blanket_inspection_sheet_lineadd/";?>', function()
		{$('#blanket_inspection_sheet_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanket_inspection_sheet_lineformholder' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheet_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheet_linelist' + '\').load(\'<?=site_url();?>/blanket_inspection_sheet_linelist\');' + ';"></input>');
		});	
	}
	
	function blanket_inspection_sheet_lineedit(id)
	{
		$('#blanket_inspection_sheet_lineformholder').load('<?=site_url()."/blanket_inspection_sheet_lineedit/index/";?>' + id, function()
		{$('#blanket_inspection_sheet_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanket_inspection_sheet_lineformholder' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheet_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheet_linelist' + '\').load(\'<?=site_url();?>/blanket_inspection_sheet_linelist\');' + ';"></input>');
		});	
	}
	
	function blanket_inspection_sheet_lineview(id)
	{
		$('#blanket_inspection_sheet_lineformholder').load('<?=site_url()."/blanket_inspection_sheet_lineview/index/";?>' + id, function()
		{$('#blanket_inspection_sheet_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanket_inspection_sheet_lineformholder' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheet_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheet_linelist' + '\').load(\'<?=site_url();?>/blanket_inspection_sheet_linelist\');' + ';"></input>');
		});	
	}
	
	function blanket_inspection_sheet_linegotopage()
	{
		var page = document.blanket_inspection_sheet_linelistform.pageno.options[document.blanket_inspection_sheet_linelistform.pageno.selectedIndex].value;
		
		$("#blanket_inspection_sheet_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#blanket_inspection_sheet_linelist',
					success: 		blanket_inspection_sheet_lineshowResponse,
		}; 
		$('#blanket_inspection_sheet_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="blanket_inspection_sheet_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="blanket_inspection_sheet_lineclosebutton"></div>
		<div id="blanket_inspection_sheet_lineformholder"></div>
		<div id="blanket_inspection_sheet_linelist">
		<!--<form method="post" action="<?=site_url();?>/blanket_inspection_sheet_linelist/index/" id="blanket_inspection_sheet_linelistform" name="blanket_inspection_sheet_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="blanket_inspection_sheet_linelistform" name="blanket_inspection_sheet_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="blanket_inspection_sheet_linecurrsort">
			</div>
			<div id="blanket_inspection_sheet_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="blanket_inspection_sheet_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/blanket_inspection_sheet_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/blanket_inspection_sheet_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="blanket_inspection_sheet_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="blanket_inspection_sheet_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="blanket_inspection_sheet_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="blanket_inspection_sheet_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/blanket_inspection_sheet_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('blanket_inspection_sheet_lineview/index/'.$row['id'], $row['blanketinspectionsheetline__qccode']);?></td><td><?=$row['blanketinspectionsheetline__ac1'];?></td><td><?=$row['blanketinspectionsheetline__ac2'];?></td><td><?=$row['blanketinspectionsheetline__ar1'];?></td><td><?=$row['blanketinspectionsheetline__ar2'];?></td><td><?=$row['blanketinspectionsheetline__thickness'];?></td><td><?=$row['blanketinspectionsheetline__ks'];?></td><td><?=$row['blanketinspectionsheetline__rollno'];?></td><td><?=$row['blanketinspectionsheetline__barringdate'];?></td><td><?=$row['blanketinspectionsheetline__lastupdate'];?></td><td><?=$row['blanketinspectionsheetline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="blanket_inspection_sheet_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/blanket_inspection_sheet_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="blanket_inspection_sheet_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/blanket_inspection_sheet_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="blanket_inspection_sheet_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="blanket_inspection_sheet_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>