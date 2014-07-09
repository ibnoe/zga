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
					target:        '#purchase_return_order_line_optionslist',
					success: 		purchase_return_order_line_optionsshowResponse,
		}; 
		
		$('#purchase_return_order_line_optionslistform').submit(function() { 
			$('#purchase_return_order_line_optionslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_return_order_line_optionsconfirmdelete(delid, obj)
	{
		$('#purchase_return_order_line_options-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_order_line_optionsconfirmdelete2(delid, obj));
	}
	
	function purchase_return_order_line_optionsconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_order_line_options-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_order_line_optionscalldeletefn('purchase_return_order_line_optionsdelete', delid, 'purchase_return_order_line_optionslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_order_line_options-dialog-confirm').html('');
	}
	
	function purchase_return_order_line_optionssortupdown(field, direction)
	{
		$("#purchase_return_order_line_optionscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_return_order_line_optionslist',
					success: 		purchase_return_order_line_optionsshowResponse,
		}; 
		$('#purchase_return_order_line_optionslistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_return_order_line_optionsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_return_order_line_optionslist',
					success: 		purchase_return_order_line_optionsshowResponse,
		}; 
		
		$('#purchase_return_order_line_optionslistform').submit(function() { 
			$('#purchase_return_order_line_optionslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_return_order_line_optionscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_return_order_line_optionsadd()
	{
		$('#purchase_return_order_line_optionsformholder').load('<?=site_url()."/purchase_return_order_line_optionsadd/";?>', function()
		{$('#purchase_return_order_line_optionsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_order_line_optionsformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_line_optionsclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_line_optionslist' + '\').load(\'<?=site_url();?>/purchase_return_order_line_optionslist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_order_line_optionsedit(id)
	{
		$('#purchase_return_order_line_optionsformholder').load('<?=site_url()."/purchase_return_order_line_optionsedit/index/";?>' + id, function()
		{$('#purchase_return_order_line_optionsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_order_line_optionsformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_line_optionsclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_line_optionslist' + '\').load(\'<?=site_url();?>/purchase_return_order_line_optionslist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_order_line_optionsview(id)
	{
		$('#purchase_return_order_line_optionsformholder').load('<?=site_url()."/purchase_return_order_line_optionsview/index/";?>' + id, function()
		{$('#purchase_return_order_line_optionsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_order_line_optionsformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_line_optionsclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_line_optionslist' + '\').load(\'<?=site_url();?>/purchase_return_order_line_optionslist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_order_line_optionsgotopage()
	{
		var page = document.purchase_return_order_line_optionslistform.pageno.options[document.purchase_return_order_line_optionslistform.pageno.selectedIndex].value;
		
		$("#purchase_return_order_line_optionscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_return_order_line_optionslist',
					success: 		purchase_return_order_line_optionsshowResponse,
		}; 
		$('#purchase_return_order_line_optionslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchase_return_order_line_options-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_return_order_line_optionsclosebutton"></div>
		<div id="purchase_return_order_line_optionsformholder"></div>
		<div id="purchase_return_order_line_optionslist">
		<!--<form method="post" action="<?=site_url();?>/purchase_return_order_line_optionslist/index/" id="purchase_return_order_line_optionslistform" name="purchase_return_order_line_optionslistform">-->
		<form method="post" action="<?=current_url();?>" id="purchase_return_order_line_optionslistform" name="purchase_return_order_line_optionslistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#supplierfilter').change(function() { $('#purchase_return_order_line_optionslistform').submit();});});</script>Supplier:&nbsp;<?=form_dropdown('supplier_id', $supplier_opt, $supplier_id, 'id="supplierfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#warehousefilter').change(function() { $('#purchase_return_order_line_optionslistform').submit();});});</script>Warehouse:&nbsp;<?=form_dropdown('warehouse_id', $warehouse_opt, $warehouse_id, 'id="warehousefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_return_order_line_optionscurrsort">
			</div>
			<div id="purchase_return_order_line_optionssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="purchase_return_order_line_optionsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_return_order_line_optionsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_return_order_line_optionsadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="purchase_return_order_line_optionssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_return_order_line_optionssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchase_return_order_line_optionssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_return_order_line_optionssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('purchasereturnorderline__id[]', $row['purchasereturnorderline__id'], false);?></td><td><?=$row['purchasereturnorderline__date'];?></td><td><?=$row['purchasereturnorderline__purchasereturnorderid'];?></td><td><?php if (isset($row['purchasereturnorderline__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['purchasereturnorderline__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['purchasereturnorderline__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['purchasereturnorderline__warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['purchasereturnorderline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['purchasereturnorderline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['purchasereturnorderline__quantitytosend'], 2);?></td><td align='right'><?=number_format($row['purchasereturnorderline__quantitytosendactual'], 2);?></td><td><?php if (isset($row['purchasereturnorderline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['purchasereturnorderline__uom_id'], $row['uom__name']);?></td><td><?=$row['purchasereturnorderline__lastupdate'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_return_order_line_optionsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_return_order_line_optionsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_return_order_line_optionsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_order_line_optionsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_order_line_optionsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_return_order_line_optionsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#purchase_return_delivery').click(function(){$('#purchase_return_order_line_optionslistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#purchase_return_order_line_optionslistform').attr('action','<?=site_url();?>/purchase_return_deliveryadd/index/');});});</script><input id='purchase_return_delivery' type="submit" value="Purchase Return Delivery">
			
		</form>
		</div>