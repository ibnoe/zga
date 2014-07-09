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
					target:        '#packing_unitlist',
					success: 		packing_unitshowResponse,
		}; 
		
		$('#packing_unitlistform').submit(function() { 
			$('#packing_unitlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function packing_unitconfirmdelete(delid, obj)
	{
		$('#packing_unit-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', packing_unitconfirmdelete2(delid, obj));
	}
	
	function packing_unitconfirmdelete2(delid, obj)
	{
		$( "#packing_unit-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					packing_unitcalldeletefn('packing_unitdelete', delid, 'packing_unitlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#packing_unit-dialog-confirm').html('');
	}
	
	function packing_unitsortupdown(field, direction)
	{
		$("#packing_unitcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#packing_unitlist',
					success: 		packing_unitshowResponse,
		}; 
		$('#packing_unitlistform').ajaxSubmit(options);
		return false;
	}
	
	function packing_unitshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#packing_unitlist',
					success: 		packing_unitshowResponse,
		}; 
		
		$('#packing_unitlistform').submit(function() { 
			$('#packing_unitlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function packing_unitcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function packing_unitadd()
	{
		$('#packing_unitformholder').load('<?=site_url()."/packing_unitadd/";?>', function()
		{$('#packing_unitclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#packing_unitformholder' + '\').html(\'\');' + '$(\'' + '#packing_unitclosebutton' + '\').html(\'\');' + '$(\'' + '#packing_unitlist' + '\').load(\'<?=site_url();?>/packing_unitlist\');' + ';"></input>');
		});	
	}
	
	function packing_unitedit(id)
	{
		$('#packing_unitformholder').load('<?=site_url()."/packing_unitedit/index/";?>' + id, function()
		{$('#packing_unitclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#packing_unitformholder' + '\').html(\'\');' + '$(\'' + '#packing_unitclosebutton' + '\').html(\'\');' + '$(\'' + '#packing_unitlist' + '\').load(\'<?=site_url();?>/packing_unitlist\');' + ';"></input>');
		});	
	}
	
	function packing_unitview(id)
	{
		$('#packing_unitformholder').load('<?=site_url()."/packing_unitview/index/";?>' + id, function()
		{$('#packing_unitclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#packing_unitformholder' + '\').html(\'\');' + '$(\'' + '#packing_unitclosebutton' + '\').html(\'\');' + '$(\'' + '#packing_unitlist' + '\').load(\'<?=site_url();?>/packing_unitlist\');' + ';"></input>');
		});	
	}
	
	function packing_unitgotopage()
	{
		var page = document.packing_unitlistform.pageno.options[document.packing_unitlistform.pageno.selectedIndex].value;
		
		$("#packing_unitcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#packing_unitlist',
					success: 		packing_unitshowResponse,
		}; 
		$('#packing_unitlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="packing_unit-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="packing_unitclosebutton"></div>
		<div id="packing_unitformholder"></div>
		<div id="packing_unitlist">
		<!--<form method="post" action="<?=site_url();?>/packing_unitlist/index/" id="packing_unitlistform" name="packing_unitlistform">-->
		<form method="post" action="<?=current_url();?>" id="packing_unitlistform" name="packing_unitlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="packing_unitcurrsort">
			</div>
			<div id="packing_unitsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="packing_unitadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/packing_unitadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/packing_unitadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				
				
				<?php foreach ($fields as $k=>$v): ?>
					<th>
						<?=$v;?><br/>
						<?php if (in_array($k, $sortby))
						{
							$index = array_search($k, $sortby);
							if (false)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="packing_unitsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="packing_unitsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="packing_unitsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="packing_unitsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['packingunit__name'];?></td><td><?=number_format($row['packingunit__ratio'], 2);?></td><td><?php if (isset($row['packingunit__uom_id']) && $row['packingunit__uom_id'] > 0) echo $row['uom__name'];?></td><td><?=$row['packingunit__lastupdate'];?></td><td><?=$row['packingunit__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="packing_unitview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/packing_unitview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="packing_unitedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/packing_unitedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="packing_unitconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="packing_unitgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>