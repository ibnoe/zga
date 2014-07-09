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
					target:        '#sales_order_line_servicelist',
					success: 		sales_order_line_serviceshowResponse,
		}; 
		
		$('#sales_order_line_servicelistform').submit(function() { 
			$('#sales_order_line_servicelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_order_line_serviceconfirmdelete(delid, obj)
	{
		$('#sales_order_line_service-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_order_line_serviceconfirmdelete2(delid, obj));
	}
	
	function sales_order_line_serviceconfirmdelete2(delid, obj)
	{
		$( "#sales_order_line_service-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_order_line_servicecalldeletefn('sales_order_line_servicedelete', delid, 'sales_order_line_servicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order_line_service-dialog-confirm').html('');
	}
	
	function sales_order_line_servicesortupdown(field, direction)
	{
		$("#sales_order_line_servicecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_order_line_servicelist',
					success: 		sales_order_line_serviceshowResponse,
		}; 
		$('#sales_order_line_servicelistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_order_line_serviceshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_order_line_servicelist',
					success: 		sales_order_line_serviceshowResponse,
		}; 
		
		$('#sales_order_line_servicelistform').submit(function() { 
			$('#sales_order_line_servicelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_order_line_servicecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_order_line_serviceadd()
	{
		$('#sales_order_line_serviceformholder').load('<?=site_url()."/sales_order_line_serviceadd/";?>', function()
		{$('#sales_order_line_serviceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_order_line_serviceformholder' + '\').html(\'\');' + '$(\'' + '#sales_order_line_serviceclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_order_line_servicelist' + '\').load(\'<?=site_url();?>/sales_order_line_servicelist\');' + ';"></input>');
		});	
	}
	
	function sales_order_line_serviceedit(id)
	{
		$('#sales_order_line_serviceformholder').load('<?=site_url()."/sales_order_line_serviceedit/index/";?>' + id, function()
		{$('#sales_order_line_serviceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_order_line_serviceformholder' + '\').html(\'\');' + '$(\'' + '#sales_order_line_serviceclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_order_line_servicelist' + '\').load(\'<?=site_url();?>/sales_order_line_servicelist\');' + ';"></input>');
		});	
	}
	
	function sales_order_line_serviceview(id)
	{
		$('#sales_order_line_serviceformholder').load('<?=site_url()."/sales_order_line_serviceview/index/";?>' + id, function()
		{$('#sales_order_line_serviceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_order_line_serviceformholder' + '\').html(\'\');' + '$(\'' + '#sales_order_line_serviceclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_order_line_servicelist' + '\').load(\'<?=site_url();?>/sales_order_line_servicelist\');' + ';"></input>');
		});	
	}
	
	function sales_order_line_servicegotopage()
	{
		var page = document.sales_order_line_servicelistform.pageno.options[document.sales_order_line_servicelistform.pageno.selectedIndex].value;
		
		$("#sales_order_line_servicecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_order_line_servicelist',
					success: 		sales_order_line_serviceshowResponse,
		}; 
		$('#sales_order_line_servicelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_order_line_service-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_order_line_serviceclosebutton"></div>
		<div id="sales_order_line_serviceformholder"></div>
		<div id="sales_order_line_servicelist">
		<!--<form method="post" action="<?=site_url();?>/sales_order_line_servicelist/index/" id="sales_order_line_servicelistform" name="sales_order_line_servicelistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_order_line_servicelistform" name="sales_order_line_servicelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_order_line_servicecurrsort">
			</div>
			<div id="sales_order_line_servicesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="sales_order_line_serviceadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_order_line_serviceadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_order_line_serviceadd/index/";?>')">
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
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="sales_order_line_servicesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_order_line_servicesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_order_line_servicesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_order_line_servicesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('rcnview/index/'.$row['salesorderline__rcn_id'], $row['rcn__norcn']);?></td><td><?=number_format($row['salesorderline__quantity'], 2);?></td><td><?=number_format($row['salesorderline__price'], 2);?></td><td><?=number_format($row['salesorderline__pdisc'], 2);?></td><td><?=number_format($row['salesorderline__subtotal'], 2);?></td><td><?=$row['salesorderline__lastupdate'];?></td><td><?=$row['salesorderline__updatedby'];?></td><td><?=$row['salesorderline__created'];?></td><td><?=$row['salesorderline__createdby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_order_line_serviceview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_order_line_serviceview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_order_line_serviceedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_order_line_serviceedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_order_line_serviceconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_order_line_servicegotopage();"');?>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>