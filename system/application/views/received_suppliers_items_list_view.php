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
					target:        '#received_suppliers_itemslist',
					success: 		received_suppliers_itemsshowResponse,
		}; 
		
		$('#received_suppliers_itemslistform').submit(function() { 
			$('#received_suppliers_itemslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function received_suppliers_itemsconfirmdelete(delid, obj)
	{
		$('#received_suppliers_items-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', received_suppliers_itemsconfirmdelete2(delid, obj));
	}
	
	function received_suppliers_itemsconfirmdelete2(delid, obj)
	{
		$( "#received_suppliers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					received_suppliers_itemscalldeletefn('received_suppliers_itemsdelete', delid, 'received_suppliers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#received_suppliers_items-dialog-confirm').html('');
	}
	
	function received_suppliers_itemssortupdown(field, direction)
	{
		$("#received_suppliers_itemscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#received_suppliers_itemslist',
					success: 		received_suppliers_itemsshowResponse,
		}; 
		$('#received_suppliers_itemslistform').ajaxSubmit(options);
		return false;
	}
	
	function received_suppliers_itemsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#received_suppliers_itemslist',
					success: 		received_suppliers_itemsshowResponse,
		}; 
		
		$('#received_suppliers_itemslistform').submit(function() { 
			$('#received_suppliers_itemslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function received_suppliers_itemscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function received_suppliers_itemsadd()
	{
		$('#received_suppliers_itemsformholder').load('<?=site_url()."/received_suppliers_itemsadd/";?>', function()
		{$('#received_suppliers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#received_suppliers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#received_suppliers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#received_suppliers_itemslist' + '\').load(\'<?=site_url();?>/received_suppliers_itemslist\');' + ';"></input>');
		});	
	}
	
	function received_suppliers_itemsedit(id)
	{
		$('#received_suppliers_itemsformholder').load('<?=site_url()."/received_suppliers_itemsedit/index/";?>' + id, function()
		{$('#received_suppliers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#received_suppliers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#received_suppliers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#received_suppliers_itemslist' + '\').load(\'<?=site_url();?>/received_suppliers_itemslist\');' + ';"></input>');
		});	
	}
	
	function received_suppliers_itemsview(id)
	{
		$('#received_suppliers_itemsformholder').load('<?=site_url()."/received_suppliers_itemsview/index/";?>' + id, function()
		{$('#received_suppliers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#received_suppliers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#received_suppliers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#received_suppliers_itemslist' + '\').load(\'<?=site_url();?>/received_suppliers_itemslist\');' + ';"></input>');
		});	
	}
	
	function received_suppliers_itemsgotopage()
	{
		var page = document.received_suppliers_itemslistform.pageno.options[document.received_suppliers_itemslistform.pageno.selectedIndex].value;
		
		$("#received_suppliers_itemscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#received_suppliers_itemslist',
					success: 		received_suppliers_itemsshowResponse,
		}; 
		$('#received_suppliers_itemslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="received_suppliers_items-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="received_suppliers_itemsclosebutton"></div>
		<div id="received_suppliers_itemsformholder"></div>
		<div id="received_suppliers_itemslist">
		<!--<form method="post" action="<?=site_url();?>/received_suppliers_itemslist/index/" id="received_suppliers_itemslistform" name="received_suppliers_itemslistform">-->
		<form method="post" action="<?=current_url();?>" id="received_suppliers_itemslistform" name="received_suppliers_itemslistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#supplierfilter').change(function() { $('#received_suppliers_itemslistform').submit();});});</script>Supplier:&nbsp;<?=form_dropdown('supplier_id', $supplier_opt, $supplier_id, 'id="supplierfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#warehousefilter').change(function() { $('#received_suppliers_itemslistform').submit();});});</script>Warehouse:&nbsp;<?=form_dropdown('warehouse_id', $warehouse_opt, $warehouse_id, 'id="warehousefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="received_suppliers_itemscurrsort">
			</div>
			<div id="received_suppliers_itemssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="received_suppliers_itemsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/received_suppliers_itemsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/received_suppliers_itemsadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="received_suppliers_itemssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="received_suppliers_itemssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="received_suppliers_itemssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="received_suppliers_itemssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('receiveditemline__id[]', $row['receiveditemline__id'], false);?></td><td><?=$row['receiveditemline__date'];?></td><td><?=$row['receiveditemline__orderid'];?></td><td><?=$row['receiveditemline__suratjalannumber'];?></td><td><?=$row['receiveditemline__invoiceno'];?></td><td><?php if (isset($row['receiveditemline__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['receiveditemline__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['receiveditemline__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['receiveditemline__warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['receiveditemline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['receiveditemline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['receiveditemline__quantitytoreceive'], 2);?></td><td><?php if (isset($row['receiveditemline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['receiveditemline__uom_id'], $row['uom__name']);?></td><td><?=$row['receiveditemline__lastupdate'];?></td><td><?=$row['receiveditemline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="received_suppliers_itemsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/received_suppliers_itemsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="received_suppliers_itemsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/received_suppliers_itemsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="received_suppliers_itemsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="received_suppliers_itemsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#purchase_return_order').click(function(){$('#received_suppliers_itemslistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#received_suppliers_itemslistform').attr('action','<?=site_url();?>/purchase_return_orderadd/index/');});});</script><input id='purchase_return_order' type="submit" value="Purchase Return Order">
			
		</form>
		</div>