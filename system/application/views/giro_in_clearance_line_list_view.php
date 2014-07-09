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
					target:        '#giro_in_clearance_linelist',
					success: 		giro_in_clearance_lineshowResponse,
		}; 
		
		$('#giro_in_clearance_linelistform').submit(function() { 
			$('#giro_in_clearance_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function giro_in_clearance_lineconfirmdelete(delid, obj)
	{
		$('#giro_in_clearance_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_in_clearance_lineconfirmdelete2(delid, obj));
	}
	
	function giro_in_clearance_lineconfirmdelete2(delid, obj)
	{
		$( "#giro_in_clearance_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_in_clearance_linecalldeletefn('giro_in_clearance_linedelete', delid, 'giro_in_clearance_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in_clearance_line-dialog-confirm').html('');
	}
	
	function giro_in_clearance_linesortupdown(field, direction)
	{
		$("#giro_in_clearance_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#giro_in_clearance_linelist',
					success: 		giro_in_clearance_lineshowResponse,
		}; 
		$('#giro_in_clearance_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function giro_in_clearance_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#giro_in_clearance_linelist',
					success: 		giro_in_clearance_lineshowResponse,
		}; 
		
		$('#giro_in_clearance_linelistform').submit(function() { 
			$('#giro_in_clearance_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function giro_in_clearance_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function giro_in_clearance_lineadd()
	{
		$('#giro_in_clearance_lineformholder').load('<?=site_url()."/giro_in_clearance_lineadd/";?>', function()
		{$('#giro_in_clearance_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_in_clearance_lineformholder' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_linelist' + '\').load(\'<?=site_url();?>/giro_in_clearance_linelist\');' + ';"></input>');
		});	
	}
	
	function giro_in_clearance_lineedit(id)
	{
		$('#giro_in_clearance_lineformholder').load('<?=site_url()."/giro_in_clearance_lineedit/index/";?>' + id, function()
		{$('#giro_in_clearance_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_in_clearance_lineformholder' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_linelist' + '\').load(\'<?=site_url();?>/giro_in_clearance_linelist\');' + ';"></input>');
		});	
	}
	
	function giro_in_clearance_lineview(id)
	{
		$('#giro_in_clearance_lineformholder').load('<?=site_url()."/giro_in_clearance_lineview/index/";?>' + id, function()
		{$('#giro_in_clearance_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_in_clearance_lineformholder' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_linelist' + '\').load(\'<?=site_url();?>/giro_in_clearance_linelist\');' + ';"></input>');
		});	
	}
	
	function giro_in_clearance_linegotopage()
	{
		var page = document.giro_in_clearance_linelistform.pageno.options[document.giro_in_clearance_linelistform.pageno.selectedIndex].value;
		
		$("#giro_in_clearance_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#giro_in_clearance_linelist',
					success: 		giro_in_clearance_lineshowResponse,
		}; 
		$('#giro_in_clearance_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="giro_in_clearance_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="giro_in_clearance_lineclosebutton"></div>
		<div id="giro_in_clearance_lineformholder"></div>
		<div id="giro_in_clearance_linelist">
		<!--<form method="post" action="<?=site_url();?>/giro_in_clearance_linelist/index/" id="giro_in_clearance_linelistform" name="giro_in_clearance_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="giro_in_clearance_linelistform" name="giro_in_clearance_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="giro_in_clearance_linecurrsort">
			</div>
			<div id="giro_in_clearance_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="giro_in_clearance_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_in_clearance_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_in_clearance_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="giro_in_clearance_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="giro_in_clearance_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="giro_in_clearance_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="giro_in_clearance_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/giro_in_clearance_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['giroinclearanceline__giroin_id']) && $row['giroin__giroinid'] != "") echo anchor('giro_inview/index/'.$row['giroinclearanceline__giroin_id'], $row['giroin__giroinid']);?></td><td><?=$row['giroinclearanceline__lastupdate'];?></td><td><?=$row['giroinclearanceline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="giro_in_clearance_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/giro_in_clearance_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="giro_in_clearance_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_in_clearance_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_in_clearance_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="giro_in_clearance_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>