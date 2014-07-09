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
		
		$('.checkall').click(function () { $(this).parents('table.main').find(':checkbox').attr('checked', this.checked); });
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#sales_return_order_line_optionslist',
					success: 		sales_return_order_line_optionsshowResponse,
		}; 
		
		$('#sales_return_order_line_optionslistform').submit(function() { 
			$('#sales_return_order_line_optionslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_return_order_line_optionsconfirmdelete(delid, obj)
	{
		$('#sales_return_order_line_options-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_order_line_optionsconfirmdelete2(delid, obj));
	}
	
	function sales_return_order_line_optionsconfirmdelete2(delid, obj)
	{
		$( "#sales_return_order_line_options-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_order_line_optionscalldeletefn('sales_return_order_line_optionsdelete', delid, 'sales_return_order_line_optionslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_order_line_options-dialog-confirm').html('');
	}
	
	function sales_return_order_line_optionssortupdown(field, direction)
	{
		$("#sales_return_order_line_optionscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_return_order_line_optionslist',
					success: 		sales_return_order_line_optionsshowResponse,
		}; 
		$('#sales_return_order_line_optionslistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_return_order_line_optionsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_return_order_line_optionslist',
					success: 		sales_return_order_line_optionsshowResponse,
		}; 
		
		$('#sales_return_order_line_optionslistform').submit(function() { 
			$('#sales_return_order_line_optionslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_return_order_line_optionscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_return_order_line_optionsadd()
	{
		$('#sales_return_order_line_optionsformholder').load('<?=site_url()."/sales_return_order_line_optionsadd/";?>', function()
		{$('#sales_return_order_line_optionsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_order_line_optionsformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_order_line_optionsclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_order_line_optionslist' + '\').load(\'<?=site_url();?>/sales_return_order_line_optionslist\');' + ';"></input>');
		});	
	}
	
	function sales_return_order_line_optionsedit(id)
	{
		$('#sales_return_order_line_optionsformholder').load('<?=site_url()."/sales_return_order_line_optionsedit/index/";?>' + id, function()
		{$('#sales_return_order_line_optionsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_order_line_optionsformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_order_line_optionsclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_order_line_optionslist' + '\').load(\'<?=site_url();?>/sales_return_order_line_optionslist\');' + ';"></input>');
		});	
	}
	
	function sales_return_order_line_optionsview(id)
	{
		$('#sales_return_order_line_optionsformholder').load('<?=site_url()."/sales_return_order_line_optionsview/index/";?>' + id, function()
		{$('#sales_return_order_line_optionsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_order_line_optionsformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_order_line_optionsclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_order_line_optionslist' + '\').load(\'<?=site_url();?>/sales_return_order_line_optionslist\');' + ';"></input>');
		});	
	}
	
	function sales_return_order_line_optionsgotopage()
	{
		var page = document.sales_return_order_line_optionslistform.pageno.options[document.sales_return_order_line_optionslistform.pageno.selectedIndex].value;
		
		$("#sales_return_order_line_optionscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_return_order_line_optionslist',
					success: 		sales_return_order_line_optionsshowResponse,
		}; 
		$('#sales_return_order_line_optionslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_return_order_line_options-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_return_order_line_optionsclosebutton"></div>
		<div id="sales_return_order_line_optionsformholder"></div>
		<div id="sales_return_order_line_optionslist">
		<!--<form method="post" action="<?=site_url();?>/sales_return_order_line_optionslist/index/" id="sales_return_order_line_optionslistform" name="sales_return_order_line_optionslistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_return_order_line_optionslistform" name="sales_return_order_line_optionslistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#customerfilter').change(function() { $('#sales_return_order_line_optionslistform').submit();});});</script>Customer:&nbsp;<?=form_dropdown('customer_id', $customer_opt, $customer_id, 'id="customerfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#warehousefilter').change(function() { $('#sales_return_order_line_optionslistform').submit();});});</script>Warehouse:&nbsp;<?=form_dropdown('warehouse_id', $warehouse_opt, $warehouse_id, 'id="warehousefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_return_order_line_optionscurrsort">
			</div>
			<div id="sales_return_order_line_optionssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="sales_return_order_line_optionsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_order_line_optionsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_order_line_optionsadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				<th><input type='checkbox' class='checkall'></th>
				
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
									echo '<a href="#" class="updown" onclick="sales_return_order_line_optionssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_return_order_line_optionssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_return_order_line_optionssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_return_order_line_optionssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('salesreturnorderline__id[]', $row['salesreturnorderline__id'], false);?></td><td><?=$row['salesreturnorderline__date'];?></td><td><?=$row['salesreturnorderline__salesreturnorderid'];?></td><td><?php if (isset($row['salesreturnorderline__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['salesreturnorderline__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['salesreturnorderline__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['salesreturnorderline__warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['salesreturnorderline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['salesreturnorderline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['salesreturnorderline__quantitytoreceive'], 2);?></td><td align='right'><?=number_format($row['salesreturnorderline__quantitytoreceiveactual'], 2);?></td><td><?php if (isset($row['salesreturnorderline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['salesreturnorderline__uom_id'], $row['uom__name']);?></td><td><?=$row['salesreturnorderline__lastupdate'];?></td><td><?=$row['salesreturnorderline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_return_order_line_optionsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_return_order_line_optionsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_return_order_line_optionsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_order_line_optionsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_order_line_optionsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_return_order_line_optionsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#sales_return_delivery').click(function(){$('#sales_return_order_line_optionslistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#sales_return_order_line_optionslistform').attr('action','<?=site_url();?>/sales_return_deliveryadd/index/');});});</script><input id='sales_return_delivery' type="submit" value="Sales Return Delivery">
			
		</form>
		</div>