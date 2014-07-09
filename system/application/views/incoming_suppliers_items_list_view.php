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
					target:        '#incoming_suppliers_itemslist',
					success: 		incoming_suppliers_itemsshowResponse,
		}; 
		
		$('#incoming_suppliers_itemslistform').submit(function() { 
			$('#incoming_suppliers_itemslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function incoming_suppliers_itemsconfirmdelete(delid, obj)
	{
		$('#incoming_suppliers_items-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', incoming_suppliers_itemsconfirmdelete2(delid, obj));
	}
	
	function incoming_suppliers_itemsconfirmdelete2(delid, obj)
	{
		$( "#incoming_suppliers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					incoming_suppliers_itemscalldeletefn('incoming_suppliers_itemsdelete', delid, 'incoming_suppliers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#incoming_suppliers_items-dialog-confirm').html('');
	}
	
	function incoming_suppliers_itemssortupdown(field, direction)
	{
		$("#incoming_suppliers_itemscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#incoming_suppliers_itemslist',
					success: 		incoming_suppliers_itemsshowResponse,
		}; 
		$('#incoming_suppliers_itemslistform').ajaxSubmit(options);
		return false;
	}
	
	function incoming_suppliers_itemsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#incoming_suppliers_itemslist',
					success: 		incoming_suppliers_itemsshowResponse,
		}; 
		
		$('#incoming_suppliers_itemslistform').submit(function() { 
			$('#incoming_suppliers_itemslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function incoming_suppliers_itemscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function incoming_suppliers_itemsadd()
	{
		$('#incoming_suppliers_itemsformholder').load('<?=site_url()."/incoming_suppliers_itemsadd/";?>', function()
		{$('#incoming_suppliers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#incoming_suppliers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#incoming_suppliers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#incoming_suppliers_itemslist' + '\').load(\'<?=site_url();?>/incoming_suppliers_itemslist\');' + ';"></input>');
		});	
	}
	
	function incoming_suppliers_itemsedit(id)
	{
		$('#incoming_suppliers_itemsformholder').load('<?=site_url()."/incoming_suppliers_itemsedit/index/";?>' + id, function()
		{$('#incoming_suppliers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#incoming_suppliers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#incoming_suppliers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#incoming_suppliers_itemslist' + '\').load(\'<?=site_url();?>/incoming_suppliers_itemslist\');' + ';"></input>');
		});	
	}
	
	function incoming_suppliers_itemsview(id)
	{
		$('#incoming_suppliers_itemsformholder').load('<?=site_url()."/incoming_suppliers_itemsview/index/";?>' + id, function()
		{$('#incoming_suppliers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#incoming_suppliers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#incoming_suppliers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#incoming_suppliers_itemslist' + '\').load(\'<?=site_url();?>/incoming_suppliers_itemslist\');' + ';"></input>');
		});	
	}
	
	function incoming_suppliers_itemsgotopage()
	{
		var page = document.incoming_suppliers_itemslistform.pageno.options[document.incoming_suppliers_itemslistform.pageno.selectedIndex].value;
		
		$("#incoming_suppliers_itemscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#incoming_suppliers_itemslist',
					success: 		incoming_suppliers_itemsshowResponse,
		}; 
		$('#incoming_suppliers_itemslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="incoming_suppliers_items-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="incoming_suppliers_itemsclosebutton"></div>
		<div id="incoming_suppliers_itemsformholder"></div>
		<div id="incoming_suppliers_itemslist">
		<!--<form method="post" action="<?=site_url();?>/incoming_suppliers_itemslist/index/" id="incoming_suppliers_itemslistform" name="incoming_suppliers_itemslistform">-->
		<form method="post" action="<?=current_url();?>" id="incoming_suppliers_itemslistform" name="incoming_suppliers_itemslistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#supplierfilter').change(function() { $('#incoming_suppliers_itemslistform').submit();});});</script>Supplier:&nbsp;<?=form_dropdown('supplier_id', $supplier_opt, $supplier_id, 'id="supplierfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#warehousefilter').change(function() { $('#incoming_suppliers_itemslistform').submit();});});</script>Warehouse:&nbsp;<?=form_dropdown('warehouse_id', $warehouse_opt, $warehouse_id, 'id="warehousefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="incoming_suppliers_itemscurrsort">
			</div>
			<div id="incoming_suppliers_itemssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="incoming_suppliers_itemsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/incoming_suppliers_itemsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/incoming_suppliers_itemsadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="incoming_suppliers_itemssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="incoming_suppliers_itemssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="incoming_suppliers_itemssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="incoming_suppliers_itemssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('purchaseorderline__id[]', $row['purchaseorderline__id'], false);?></td><td><?=$row['purchaseorderline__date'];?></td><td><?=$row['purchaseorderline__orderid'];?></td><td><?php if (isset($row['purchaseorderline__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['purchaseorderline__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['purchaseorderline__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['purchaseorderline__warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['purchaseorderline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['purchaseorderline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['purchaseorderline__quantity'], 2);?></td><td align='right'><?=number_format($row['purchaseorderline__quantityalreadyreceived'], 2);?></td><td align='right'><?=number_format($row['purchaseorderline__quantitytoreceive'], 2);?></td><td><?php if (isset($row['purchaseorderline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['purchaseorderline__uom_id'], $row['uom__name']);?></td><td><?=$row['purchaseorderline__lastupdate'];?></td><td><?=$row['purchaseorderline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="incoming_suppliers_itemsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/incoming_suppliers_itemsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="incoming_suppliers_itemsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/incoming_suppliers_itemsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="incoming_suppliers_itemsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="incoming_suppliers_itemsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#receive_items').click(function(){$('#incoming_suppliers_itemslistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#incoming_suppliers_itemslistform').attr('action','<?=site_url();?>/receive_itemsadd/index/');});});</script><input id='receive_items' type="submit" value="Receive Items">
			
		</form>
		</div>