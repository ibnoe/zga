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
					target:        '#penerimaan_item_for_servicelist',
					success: 		penerimaan_item_for_serviceshowResponse,
		}; 
		
		$('#penerimaan_item_for_servicelistform').submit(function() { 
			$('#penerimaan_item_for_servicelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function penerimaan_item_for_serviceconfirmdelete(delid, obj)
	{
		$('#penerimaan_item_for_service-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', penerimaan_item_for_serviceconfirmdelete2(delid, obj));
	}
	
	function penerimaan_item_for_serviceconfirmdelete2(delid, obj)
	{
		$( "#penerimaan_item_for_service-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					penerimaan_item_for_servicecalldeletefn('penerimaan_item_for_servicedelete', delid, 'penerimaan_item_for_servicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penerimaan_item_for_service-dialog-confirm').html('');
	}
	
	function penerimaan_item_for_servicesortupdown(field, direction)
	{
		$("#penerimaan_item_for_servicecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#penerimaan_item_for_servicelist',
					success: 		penerimaan_item_for_serviceshowResponse,
		}; 
		$('#penerimaan_item_for_servicelistform').ajaxSubmit(options);
		return false;
	}
	
	function penerimaan_item_for_serviceshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#penerimaan_item_for_servicelist',
					success: 		penerimaan_item_for_serviceshowResponse,
		}; 
		
		$('#penerimaan_item_for_servicelistform').submit(function() { 
			$('#penerimaan_item_for_servicelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function penerimaan_item_for_servicecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function penerimaan_item_for_serviceadd()
	{
		$('#penerimaan_item_for_serviceformholder').load('<?=site_url()."/penerimaan_item_for_serviceadd/";?>', function()
		{$('#penerimaan_item_for_serviceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penerimaan_item_for_serviceformholder' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_serviceclosebutton' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_servicelist' + '\').load(\'<?=site_url();?>/penerimaan_item_for_servicelist\');' + ';"></input>');
		});	
	}
	
	function penerimaan_item_for_serviceedit(id)
	{
		$('#penerimaan_item_for_serviceformholder').load('<?=site_url()."/penerimaan_item_for_serviceedit/index/";?>' + id, function()
		{$('#penerimaan_item_for_serviceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penerimaan_item_for_serviceformholder' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_serviceclosebutton' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_servicelist' + '\').load(\'<?=site_url();?>/penerimaan_item_for_servicelist\');' + ';"></input>');
		});	
	}
	
	function penerimaan_item_for_serviceview(id)
	{
		$('#penerimaan_item_for_serviceformholder').load('<?=site_url()."/penerimaan_item_for_serviceview/index/";?>' + id, function()
		{$('#penerimaan_item_for_serviceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penerimaan_item_for_serviceformholder' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_serviceclosebutton' + '\').html(\'\');' + '$(\'' + '#penerimaan_item_for_servicelist' + '\').load(\'<?=site_url();?>/penerimaan_item_for_servicelist\');' + ';"></input>');
		});	
	}
	
	function penerimaan_item_for_servicegotopage()
	{
		var page = document.penerimaan_item_for_servicelistform.pageno.options[document.penerimaan_item_for_servicelistform.pageno.selectedIndex].value;
		
		$("#penerimaan_item_for_servicecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#penerimaan_item_for_servicelist',
					success: 		penerimaan_item_for_serviceshowResponse,
		}; 
		$('#penerimaan_item_for_servicelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="penerimaan_item_for_service-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="penerimaan_item_for_serviceclosebutton"></div>
		<div id="penerimaan_item_for_serviceformholder"></div>
		<div id="penerimaan_item_for_servicelist">
		<!--<form method="post" action="<?=site_url();?>/penerimaan_item_for_servicelist/index/" id="penerimaan_item_for_servicelistform" name="penerimaan_item_for_servicelistform">-->
		<form method="post" action="<?=current_url();?>" id="penerimaan_item_for_servicelistform" name="penerimaan_item_for_servicelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="penerimaan_item_for_servicecurrsort">
			</div>
			<div id="penerimaan_item_for_servicesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="penerimaan_item_for_serviceadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/penerimaan_item_for_serviceadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/penerimaan_item_for_serviceadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="penerimaan_item_for_servicesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="penerimaan_item_for_servicesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="penerimaan_item_for_servicesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="penerimaan_item_for_servicesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/penerimaan_item_for_serviceview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('penerimaan_item_for_serviceview/index/'.$row['id'], $row['insertitem__idstring']);?></td><td><?=$row['insertitem__date'];?></td><td><?=$row['insertitem__notes'];?></td><td><?=$row['insertitem__lastupdate'];?></td><td><?=$row['insertitem__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="penerimaan_item_for_serviceview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/penerimaan_item_for_serviceview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="penerimaan_item_for_serviceedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/penerimaan_item_for_serviceedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="penerimaan_item_for_serviceconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="penerimaan_item_for_servicegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>