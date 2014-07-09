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
					target:        '#manufacturing_rejectlist',
					success: 		manufacturing_rejectshowResponse,
		}; 
		
		$('#manufacturing_rejectlistform').submit(function() { 
			$('#manufacturing_rejectlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function manufacturing_rejectconfirmdelete(delid, obj)
	{
		$('#manufacturing_reject-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_rejectconfirmdelete2(delid, obj));
	}
	
	function manufacturing_rejectconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_reject-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_rejectcalldeletefn('manufacturing_rejectdelete', delid, 'manufacturing_rejectlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_reject-dialog-confirm').html('');
	}
	
	function manufacturing_rejectsortupdown(field, direction)
	{
		$("#manufacturing_rejectcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#manufacturing_rejectlist',
					success: 		manufacturing_rejectshowResponse,
		}; 
		$('#manufacturing_rejectlistform').ajaxSubmit(options);
		return false;
	}
	
	function manufacturing_rejectshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#manufacturing_rejectlist',
					success: 		manufacturing_rejectshowResponse,
		}; 
		
		$('#manufacturing_rejectlistform').submit(function() { 
			$('#manufacturing_rejectlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function manufacturing_rejectcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function manufacturing_rejectadd()
	{
		$('#manufacturing_rejectformholder').load('<?=site_url()."/manufacturing_rejectadd/";?>', function()
		{$('#manufacturing_rejectclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_rejectformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_rejectclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_rejectlist' + '\').load(\'<?=site_url();?>/manufacturing_rejectlist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_rejectedit(id)
	{
		$('#manufacturing_rejectformholder').load('<?=site_url()."/manufacturing_rejectedit/index/";?>' + id, function()
		{$('#manufacturing_rejectclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_rejectformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_rejectclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_rejectlist' + '\').load(\'<?=site_url();?>/manufacturing_rejectlist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_rejectview(id)
	{
		$('#manufacturing_rejectformholder').load('<?=site_url()."/manufacturing_rejectview/index/";?>' + id, function()
		{$('#manufacturing_rejectclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_rejectformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_rejectclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_rejectlist' + '\').load(\'<?=site_url();?>/manufacturing_rejectlist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_rejectgotopage()
	{
		var page = document.manufacturing_rejectlistform.pageno.options[document.manufacturing_rejectlistform.pageno.selectedIndex].value;
		
		$("#manufacturing_rejectcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#manufacturing_rejectlist',
					success: 		manufacturing_rejectshowResponse,
		}; 
		$('#manufacturing_rejectlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="manufacturing_reject-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="manufacturing_rejectclosebutton"></div>
		<div id="manufacturing_rejectformholder"></div>
		<div id="manufacturing_rejectlist">
		<!--<form method="post" action="<?=site_url();?>/manufacturing_rejectlist/index/" id="manufacturing_rejectlistform" name="manufacturing_rejectlistform">-->
		<form method="post" action="<?=current_url();?>" id="manufacturing_rejectlistform" name="manufacturing_rejectlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="manufacturing_rejectcurrsort">
			</div>
			<div id="manufacturing_rejectsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="manufacturing_rejectadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_rejectadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_rejectadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="manufacturing_rejectsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="manufacturing_rejectsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="manufacturing_rejectsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="manufacturing_rejectsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/manufacturing_rejectview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('manufacturing_rejectview/index/'.$row['id'], $row['manufacturingreject__idstring']);?></td><td><?=$row['manufacturingreject__date'];?></td><td><?php if (isset($row['manufacturingreject__item_id']) && $row['item__name'] != "") echo anchor('manufactured_item_in_stockview/index/'.$row['manufacturingreject__item_id'], $row['item__name']);?></td><td><?php if (isset($row['manufacturingreject__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['manufacturingreject__warehouse_id'], $row['warehouse__name']);?></td><td align='right'><?=number_format($row['manufacturingreject__quantity'], 2);?></td><td><?php if (isset($row['manufacturingreject__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['manufacturingreject__uom_id'], $row['uom__name']);?></td><td><?=$row['manufacturingreject__lastupdate'];?></td><td><?=$row['manufacturingreject__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="manufacturing_rejectview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/manufacturing_rejectview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="manufacturing_rejectedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_rejectedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_rejectconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="manufacturing_rejectgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>