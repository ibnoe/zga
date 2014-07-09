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
					target:        '#core_repairlist',
					success: 		core_repairshowResponse,
		}; 
		
		$('#core_repairlistform').submit(function() { 
			$('#core_repairlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function core_repairconfirmdelete(delid, obj)
	{
		$('#core_repair-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', core_repairconfirmdelete2(delid, obj));
	}
	
	function core_repairconfirmdelete2(delid, obj)
	{
		$( "#core_repair-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					core_repaircalldeletefn('core_repairdelete', delid, 'core_repairlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#core_repair-dialog-confirm').html('');
	}
	
	function core_repairsortupdown(field, direction)
	{
		$("#core_repaircurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#core_repairlist',
					success: 		core_repairshowResponse,
		}; 
		$('#core_repairlistform').ajaxSubmit(options);
		return false;
	}
	
	function core_repairshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#core_repairlist',
					success: 		core_repairshowResponse,
		}; 
		
		$('#core_repairlistform').submit(function() { 
			$('#core_repairlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function core_repaircalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function core_repairadd()
	{
		$('#core_repairformholder').load('<?=site_url()."/core_repairadd/";?>', function()
		{$('#core_repairclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#core_repairformholder' + '\').html(\'\');' + '$(\'' + '#core_repairclosebutton' + '\').html(\'\');' + '$(\'' + '#core_repairlist' + '\').load(\'<?=site_url();?>/core_repairlist\');' + ';"></input>');
		});	
	}
	
	function core_repairedit(id)
	{
		$('#core_repairformholder').load('<?=site_url()."/core_repairedit/index/";?>' + id, function()
		{$('#core_repairclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#core_repairformholder' + '\').html(\'\');' + '$(\'' + '#core_repairclosebutton' + '\').html(\'\');' + '$(\'' + '#core_repairlist' + '\').load(\'<?=site_url();?>/core_repairlist\');' + ';"></input>');
		});	
	}
	
	function core_repairview(id)
	{
		$('#core_repairformholder').load('<?=site_url()."/core_repairview/index/";?>' + id, function()
		{$('#core_repairclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#core_repairformholder' + '\').html(\'\');' + '$(\'' + '#core_repairclosebutton' + '\').html(\'\');' + '$(\'' + '#core_repairlist' + '\').load(\'<?=site_url();?>/core_repairlist\');' + ';"></input>');
		});	
	}
	
	function core_repairgotopage()
	{
		var page = document.core_repairlistform.pageno.options[document.core_repairlistform.pageno.selectedIndex].value;
		
		$("#core_repaircurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#core_repairlist',
					success: 		core_repairshowResponse,
		}; 
		$('#core_repairlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="core_repair-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="core_repairclosebutton"></div>
		<div id="core_repairformholder"></div>
		<div id="core_repairlist">
		<!--<form method="post" action="<?=site_url();?>/core_repairlist/index/" id="core_repairlistform" name="core_repairlistform">-->
		<form method="post" action="<?=current_url();?>" id="core_repairlistform" name="core_repairlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="core_repaircurrsort">
			</div>
			<div id="core_repairsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="core_repairadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/core_repairadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/core_repairadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="core_repairsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="core_repairsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="core_repairsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="core_repairsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/core_repairview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('core_repairview/index/'.$row['id'], $row['manufacturingorder__idstring']);?></td><td><?=$row['manufacturingorder__date'];?></td><td><?php if (isset($row['manufacturingorder__item_id']) && $row['item__name'] != "") echo anchor('manufactured_itemview/index/'.$row['manufacturingorder__item_id'], $row['item__name']);?></td><td><?php if (isset($row['manufacturingorder__from_warehouse_id']) && $row['warehouse__name'] != "") echo anchor('from_warehouseview/index/'.$row['manufacturingorder__from_warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['manufacturingorder__to_warehouse_id']) && $row['warehouse1__name'] != "") echo anchor('to_warehouseview/index/'.$row['manufacturingorder__to_warehouse_id'], $row['warehouse1__name']);?></td><td><?php if (isset($row['manufacturingorder__bom_id']) && $row['bom__name'] != "") echo anchor('bill_of_materialview/index/'.$row['manufacturingorder__bom_id'], $row['bom__name']);?></td><td align='right'><?=number_format($row['manufacturingorder__quantity'], 2);?></td><td><?php if (isset($row['manufacturingorder__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['manufacturingorder__uom_id'], $row['uom__name']);?></td><td><?=$row['manufacturingorder__lastupdate'];?></td><td><?=$row['manufacturingorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="core_repairview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/core_repairview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="core_repairedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/core_repairedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="core_repairconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="core_repairgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>