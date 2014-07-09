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
					target:        '#giro_in_clearance_line_viewlist',
					success: 		giro_in_clearance_line_viewshowResponse,
		}; 
		
		$('#giro_in_clearance_line_viewlistform').submit(function() { 
			$('#giro_in_clearance_line_viewlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function giro_in_clearance_line_viewconfirmdelete(delid, obj)
	{
		$('#giro_in_clearance_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_in_clearance_line_viewconfirmdelete2(delid, obj));
	}
	
	function giro_in_clearance_line_viewconfirmdelete2(delid, obj)
	{
		$( "#giro_in_clearance_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_in_clearance_line_viewcalldeletefn('giro_in_clearance_line_viewdelete', delid, 'giro_in_clearance_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in_clearance_line_view-dialog-confirm').html('');
	}
	
	function giro_in_clearance_line_viewsortupdown(field, direction)
	{
		$("#giro_in_clearance_line_viewcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#giro_in_clearance_line_viewlist',
					success: 		giro_in_clearance_line_viewshowResponse,
		}; 
		$('#giro_in_clearance_line_viewlistform').ajaxSubmit(options);
		return false;
	}
	
	function giro_in_clearance_line_viewshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#giro_in_clearance_line_viewlist',
					success: 		giro_in_clearance_line_viewshowResponse,
		}; 
		
		$('#giro_in_clearance_line_viewlistform').submit(function() { 
			$('#giro_in_clearance_line_viewlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function giro_in_clearance_line_viewcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function giro_in_clearance_line_viewadd()
	{
		$('#giro_in_clearance_line_viewformholder').load('<?=site_url()."/giro_in_clearance_line_viewadd/";?>', function()
		{$('#giro_in_clearance_line_viewclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_in_clearance_line_viewformholder' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_line_viewclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_line_viewlist' + '\').load(\'<?=site_url();?>/giro_in_clearance_line_viewlist\');' + ';"></input>');
		});	
	}
	
	function giro_in_clearance_line_viewedit(id)
	{
		$('#giro_in_clearance_line_viewformholder').load('<?=site_url()."/giro_in_clearance_line_viewedit/index/";?>' + id, function()
		{$('#giro_in_clearance_line_viewclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_in_clearance_line_viewformholder' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_line_viewclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_line_viewlist' + '\').load(\'<?=site_url();?>/giro_in_clearance_line_viewlist\');' + ';"></input>');
		});	
	}
	
	function giro_in_clearance_line_viewview(id)
	{
		$('#giro_in_clearance_line_viewformholder').load('<?=site_url()."/giro_in_clearance_line_viewview/index/";?>' + id, function()
		{$('#giro_in_clearance_line_viewclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_in_clearance_line_viewformholder' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_line_viewclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_in_clearance_line_viewlist' + '\').load(\'<?=site_url();?>/giro_in_clearance_line_viewlist\');' + ';"></input>');
		});	
	}
	
	function giro_in_clearance_line_viewgotopage()
	{
		var page = document.giro_in_clearance_line_viewlistform.pageno.options[document.giro_in_clearance_line_viewlistform.pageno.selectedIndex].value;
		
		$("#giro_in_clearance_line_viewcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#giro_in_clearance_line_viewlist',
					success: 		giro_in_clearance_line_viewshowResponse,
		}; 
		$('#giro_in_clearance_line_viewlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="giro_in_clearance_line_view-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="giro_in_clearance_line_viewclosebutton"></div>
		<div id="giro_in_clearance_line_viewformholder"></div>
		<div id="giro_in_clearance_line_viewlist">
		<!--<form method="post" action="<?=site_url();?>/giro_in_clearance_line_viewlist/index/" id="giro_in_clearance_line_viewlistform" name="giro_in_clearance_line_viewlistform">-->
		<form method="post" action="<?=current_url();?>" id="giro_in_clearance_line_viewlistform" name="giro_in_clearance_line_viewlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="giro_in_clearance_line_viewcurrsort">
			</div>
			<div id="giro_in_clearance_line_viewsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="giro_in_clearance_line_viewadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_in_clearance_line_viewadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_in_clearance_line_viewadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="giro_in_clearance_line_viewsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="giro_in_clearance_line_viewsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="giro_in_clearance_line_viewsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="giro_in_clearance_line_viewsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/giro_in_clearance_line_viewview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['giroinclearanceline__giroin_id']) && $row['giroin__giroinid'] != "") echo anchor('giro_inview/index/'.$row['giroinclearanceline__giroin_id'], $row['giroin__giroinid']);?></td><td><?=$row['giroinclearanceline__lastupdate'];?></td><td><?=$row['giroinclearanceline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="giro_in_clearance_line_viewview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/giro_in_clearance_line_viewview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="giro_in_clearance_line_viewedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_in_clearance_line_viewedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_in_clearance_line_viewconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="giro_in_clearance_line_viewgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>