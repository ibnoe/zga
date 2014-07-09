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
					target:        '#roll_process_updatelist',
					success: 		roll_process_updateshowResponse,
		}; 
		
		$('#roll_process_updatelistform').submit(function() { 
			$('#roll_process_updatelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function roll_process_updateconfirmdelete(delid, obj)
	{
		$('#roll_process_update-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', roll_process_updateconfirmdelete2(delid, obj));
	}
	
	function roll_process_updateconfirmdelete2(delid, obj)
	{
		$( "#roll_process_update-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					roll_process_updatecalldeletefn('roll_process_updatedelete', delid, 'roll_process_updatelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roll_process_update-dialog-confirm').html('');
	}
	
	function roll_process_updatesortupdown(field, direction)
	{
		$("#roll_process_updatecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#roll_process_updatelist',
					success: 		roll_process_updateshowResponse,
		}; 
		$('#roll_process_updatelistform').ajaxSubmit(options);
		return false;
	}
	
	function roll_process_updateshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#roll_process_updatelist',
					success: 		roll_process_updateshowResponse,
		}; 
		
		$('#roll_process_updatelistform').submit(function() { 
			$('#roll_process_updatelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function roll_process_updatecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function roll_process_updateadd()
	{
		$('#roll_process_updateformholder').load('<?=site_url()."/roll_process_updateadd/";?>', function()
		{$('#roll_process_updateclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#roll_process_updateformholder' + '\').html(\'\');' + '$(\'' + '#roll_process_updateclosebutton' + '\').html(\'\');' + '$(\'' + '#roll_process_updatelist' + '\').load(\'<?=site_url();?>/roll_process_updatelist\');' + ';"></input>');
		});	
	}
	
	function roll_process_updateedit(id)
	{
		$('#roll_process_updateformholder').load('<?=site_url()."/roll_process_updateedit/index/";?>' + id, function()
		{$('#roll_process_updateclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#roll_process_updateformholder' + '\').html(\'\');' + '$(\'' + '#roll_process_updateclosebutton' + '\').html(\'\');' + '$(\'' + '#roll_process_updatelist' + '\').load(\'<?=site_url();?>/roll_process_updatelist\');' + ';"></input>');
		});	
	}
	
	function roll_process_updateview(id)
	{
		$('#roll_process_updateformholder').load('<?=site_url()."/roll_process_updateview/index/";?>' + id, function()
		{$('#roll_process_updateclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#roll_process_updateformholder' + '\').html(\'\');' + '$(\'' + '#roll_process_updateclosebutton' + '\').html(\'\');' + '$(\'' + '#roll_process_updatelist' + '\').load(\'<?=site_url();?>/roll_process_updatelist\');' + ';"></input>');
		});	
	}
	
	function roll_process_updategotopage()
	{
		var page = document.roll_process_updatelistform.pageno.options[document.roll_process_updatelistform.pageno.selectedIndex].value;
		
		$("#roll_process_updatecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#roll_process_updatelist',
					success: 		roll_process_updateshowResponse,
		}; 
		$('#roll_process_updatelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="roll_process_update-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="roll_process_updateclosebutton"></div>
		<div id="roll_process_updateformholder"></div>
		<div id="roll_process_updatelist">
		<!--<form method="post" action="<?=site_url();?>/roll_process_updatelist/index/" id="roll_process_updatelistform" name="roll_process_updatelistform">-->
		<form method="post" action="<?=current_url();?>" id="roll_process_updatelistform" name="roll_process_updatelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="roll_process_updatecurrsort">
			</div>
			<div id="roll_process_updatesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="roll_process_updateadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/roll_process_updateadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/roll_process_updateadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="roll_process_updatesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="roll_process_updatesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="roll_process_updatesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="roll_process_updatesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/roll_process_updateview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('roll_process_updateview/index/'.$row['id'], $row['rollprocessupdate__idstring']);?></td><td><?=$row['rollprocessupdate__noorderandcustomer'];?></td><td><?=$row['rollprocessupdate__date'];?></td><td><?=$row['rollprocessupdate__qty1'];?></td><td><?=$row['rollprocessupdate__machinetyperoll'];?></td><td><?=$row['rollprocessupdate__compound'];?></td><td><?=$row['rollprocessupdate__rd'];?></td><td><?=$row['rollprocessupdate__wl'];?></td><td><?=$row['rollprocessupdate__tl'];?></td><td><?=$row['rollprocessupdate__qty2'];?></td><td><?=$row['rollprocessupdate__shipping'];?></td><td><?=$row['rollprocessupdate__wrapping'];?></td><td><?=$row['rollprocessupdate__vulcanizing'];?></td><td><?=$row['rollprocessupdate__faceoff'];?></td><td><?=$row['rollprocessupdate__grinding'];?></td><td><?=$row['rollprocessupdate__polishing'];?></td><td><?=$row['rollprocessupdate__maxdate'];?></td><td><?=$row['rollprocessupdate__deadlinedate'];?></td><td><?=$row['rollprocessupdate__notes'];?></td><td><?=$row['rollprocessupdate__lastupdate'];?></td><td><?=$row['rollprocessupdate__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="roll_process_updateview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/roll_process_updateview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="roll_process_updateedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/roll_process_updateedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="roll_process_updateconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="roll_process_updategotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>