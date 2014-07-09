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
					target:        '#repackinglist',
					success: 		repackingshowResponse,
		}; 
		
		$('#repackinglistform').submit(function() { 
			$('#repackinglistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function repackingconfirmdelete(delid, obj)
	{
		$('#repacking-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', repackingconfirmdelete2(delid, obj));
	}
	
	function repackingconfirmdelete2(delid, obj)
	{
		$( "#repacking-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					repackingcalldeletefn('repackingdelete', delid, 'repackinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#repacking-dialog-confirm').html('');
	}
	
	function repackingsortupdown(field, direction)
	{
		$("#repackingcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#repackinglist',
					success: 		repackingshowResponse,
		}; 
		$('#repackinglistform').ajaxSubmit(options);
		return false;
	}
	
	function repackingshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#repackinglist',
					success: 		repackingshowResponse,
		}; 
		
		$('#repackinglistform').submit(function() { 
			$('#repackinglistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function repackingcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function repackingadd()
	{
		$('#repackingformholder').load('<?=site_url()."/repackingadd/";?>', function()
		{$('#repackingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#repackingformholder' + '\').html(\'\');' + '$(\'' + '#repackingclosebutton' + '\').html(\'\');' + '$(\'' + '#repackinglist' + '\').load(\'<?=site_url();?>/repackinglist\');' + ';"></input>');
		});	
	}
	
	function repackingedit(id)
	{
		$('#repackingformholder').load('<?=site_url()."/repackingedit/index/";?>' + id, function()
		{$('#repackingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#repackingformholder' + '\').html(\'\');' + '$(\'' + '#repackingclosebutton' + '\').html(\'\');' + '$(\'' + '#repackinglist' + '\').load(\'<?=site_url();?>/repackinglist\');' + ';"></input>');
		});	
	}
	
	function repackingview(id)
	{
		$('#repackingformholder').load('<?=site_url()."/repackingview/index/";?>' + id, function()
		{$('#repackingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#repackingformholder' + '\').html(\'\');' + '$(\'' + '#repackingclosebutton' + '\').html(\'\');' + '$(\'' + '#repackinglist' + '\').load(\'<?=site_url();?>/repackinglist\');' + ';"></input>');
		});	
	}
	
	function repackinggotopage()
	{
		var page = document.repackinglistform.pageno.options[document.repackinglistform.pageno.selectedIndex].value;
		
		$("#repackingcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#repackinglist',
					success: 		repackingshowResponse,
		}; 
		$('#repackinglistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="repacking-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="repackingclosebutton"></div>
		<div id="repackingformholder"></div>
		<div id="repackinglist">
		<!--<form method="post" action="<?=site_url();?>/repackinglist/index/" id="repackinglistform" name="repackinglistform">-->
		<form method="post" action="<?=current_url();?>" id="repackinglistform" name="repackinglistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="repackingcurrsort">
			</div>
			<div id="repackingsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="repackingadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/repackingadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/repackingadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="repackingsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="repackingsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="repackingsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="repackingsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/repackingview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('repackingview/index/'.$row['id'], $row['manufacturingorder__idstring']);?></td><td><?=$row['manufacturingorder__date'];?></td><td><?php if (isset($row['manufacturingorder__item_id']) && $row['item__name'] != "") echo anchor('manufactured_itemview/index/'.$row['manufacturingorder__item_id'], $row['item__name']);?></td><td><?php if (isset($row['manufacturingorder__from_warehouse_id']) && $row['warehouse__name'] != "") echo anchor('from_warehouseview/index/'.$row['manufacturingorder__from_warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['manufacturingorder__to_warehouse_id']) && $row['warehouse1__name'] != "") echo anchor('to_warehouseview/index/'.$row['manufacturingorder__to_warehouse_id'], $row['warehouse1__name']);?></td><td><?php if (isset($row['manufacturingorder__bom_id']) && $row['bom__name'] != "") echo anchor('bill_of_materialview/index/'.$row['manufacturingorder__bom_id'], $row['bom__name']);?></td><td align='right'><?=number_format($row['manufacturingorder__quantity'], 2);?></td><td><?php if (isset($row['manufacturingorder__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['manufacturingorder__uom_id'], $row['uom__name']);?></td><td><?=$row['manufacturingorder__lastupdate'];?></td><td><?=$row['manufacturingorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="repackingview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/repackingview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="repackingedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/repackingedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="repackingconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="repackinggotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>