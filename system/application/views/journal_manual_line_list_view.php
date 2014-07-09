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
					target:        '#journal_manual_linelist',
					success: 		journal_manual_lineshowResponse,
		}; 
		
		$('#journal_manual_linelistform').submit(function() { 
			$('#journal_manual_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function journal_manual_lineconfirmdelete(delid, obj)
	{
		$('#journal_manual_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', journal_manual_lineconfirmdelete2(delid, obj));
	}
	
	function journal_manual_lineconfirmdelete2(delid, obj)
	{
		$( "#journal_manual_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					journal_manual_linecalldeletefn('journal_manual_linedelete', delid, 'journal_manual_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#journal_manual_line-dialog-confirm').html('');
	}
	
	function journal_manual_linesortupdown(field, direction)
	{
		$("#journal_manual_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#journal_manual_linelist',
					success: 		journal_manual_lineshowResponse,
		}; 
		$('#journal_manual_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function journal_manual_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#journal_manual_linelist',
					success: 		journal_manual_lineshowResponse,
		}; 
		
		$('#journal_manual_linelistform').submit(function() { 
			$('#journal_manual_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function journal_manual_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function journal_manual_lineadd()
	{
		$('#journal_manual_lineformholder').load('<?=site_url()."/journal_manual_lineadd/";?>', function()
		{$('#journal_manual_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#journal_manual_lineformholder' + '\').html(\'\');' + '$(\'' + '#journal_manual_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#journal_manual_linelist' + '\').load(\'<?=site_url();?>/journal_manual_linelist\');' + ';"></input>');
		});	
	}
	
	function journal_manual_lineedit(id)
	{
		$('#journal_manual_lineformholder').load('<?=site_url()."/journal_manual_lineedit/index/";?>' + id, function()
		{$('#journal_manual_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#journal_manual_lineformholder' + '\').html(\'\');' + '$(\'' + '#journal_manual_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#journal_manual_linelist' + '\').load(\'<?=site_url();?>/journal_manual_linelist\');' + ';"></input>');
		});	
	}
	
	function journal_manual_lineview(id)
	{
		$('#journal_manual_lineformholder').load('<?=site_url()."/journal_manual_lineview/index/";?>' + id, function()
		{$('#journal_manual_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#journal_manual_lineformholder' + '\').html(\'\');' + '$(\'' + '#journal_manual_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#journal_manual_linelist' + '\').load(\'<?=site_url();?>/journal_manual_linelist\');' + ';"></input>');
		});	
	}
	
	function journal_manual_linegotopage()
	{
		var page = document.journal_manual_linelistform.pageno.options[document.journal_manual_linelistform.pageno.selectedIndex].value;
		
		$("#journal_manual_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#journal_manual_linelist',
					success: 		journal_manual_lineshowResponse,
		}; 
		$('#journal_manual_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="journal_manual_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="journal_manual_lineclosebutton"></div>
		<div id="journal_manual_lineformholder"></div>
		<div id="journal_manual_linelist">
		<!--<form method="post" action="<?=site_url();?>/journal_manual_linelist/index/" id="journal_manual_linelistform" name="journal_manual_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="journal_manual_linelistform" name="journal_manual_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="journal_manual_linecurrsort">
			</div>
			<div id="journal_manual_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="journal_manual_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/journal_manual_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/journal_manual_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="journal_manual_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="journal_manual_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="journal_manual_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="journal_manual_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/journal_manual_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['journal__coa_id']) && $row['coa__name'] != "") echo anchor('accountsview/index/'.$row['journal__coa_id'], $row['coa__name']);?></td><td><?=anchor('journal_manual_lineview/index/'.$row['id'], $row['journal__debit']);?></td><td align='right'><?=number_format($row['journal__credit'], 2);?></td><td><?=$row['journal__lastupdate'];?></td><td><?=$row['journal__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="journal_manual_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/journal_manual_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="journal_manual_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/journal_manual_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="journal_manual_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="journal_manual_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>