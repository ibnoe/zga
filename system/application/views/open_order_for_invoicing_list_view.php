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
					target:        '#open_order_for_invoicinglist',
					success: 		open_order_for_invoicingshowResponse,
		}; 
		
		$('#open_order_for_invoicinglistform').submit(function() { 
			$('#open_order_for_invoicinglistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function open_order_for_invoicingconfirmdelete(delid, obj)
	{
		$('#open_order_for_invoicing-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_order_for_invoicingconfirmdelete2(delid, obj));
	}
	
	function open_order_for_invoicingconfirmdelete2(delid, obj)
	{
		$( "#open_order_for_invoicing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_order_for_invoicingcalldeletefn('open_order_for_invoicingdelete', delid, 'open_order_for_invoicinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_order_for_invoicing-dialog-confirm').html('');
	}
	
	function open_order_for_invoicingsortupdown(field, direction)
	{
		$("#open_order_for_invoicingcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#open_order_for_invoicinglist',
					success: 		open_order_for_invoicingshowResponse,
		}; 
		$('#open_order_for_invoicinglistform').ajaxSubmit(options);
		return false;
	}
	
	function open_order_for_invoicingshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#open_order_for_invoicinglist',
					success: 		open_order_for_invoicingshowResponse,
		}; 
		
		$('#open_order_for_invoicinglistform').submit(function() { 
			$('#open_order_for_invoicinglistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function open_order_for_invoicingcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function open_order_for_invoicingadd()
	{
		$('#open_order_for_invoicingformholder').load('<?=site_url()."/open_order_for_invoicingadd/";?>', function()
		{$('#open_order_for_invoicingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_order_for_invoicingformholder' + '\').html(\'\');' + '$(\'' + '#open_order_for_invoicingclosebutton' + '\').html(\'\');' + '$(\'' + '#open_order_for_invoicinglist' + '\').load(\'<?=site_url();?>/open_order_for_invoicinglist\');' + ';"></input>');
		});	
	}
	
	function open_order_for_invoicingedit(id)
	{
		$('#open_order_for_invoicingformholder').load('<?=site_url()."/open_order_for_invoicingedit/index/";?>' + id, function()
		{$('#open_order_for_invoicingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_order_for_invoicingformholder' + '\').html(\'\');' + '$(\'' + '#open_order_for_invoicingclosebutton' + '\').html(\'\');' + '$(\'' + '#open_order_for_invoicinglist' + '\').load(\'<?=site_url();?>/open_order_for_invoicinglist\');' + ';"></input>');
		});	
	}
	
	function open_order_for_invoicingview(id)
	{
		$('#open_order_for_invoicingformholder').load('<?=site_url()."/open_order_for_invoicingview/index/";?>' + id, function()
		{$('#open_order_for_invoicingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_order_for_invoicingformholder' + '\').html(\'\');' + '$(\'' + '#open_order_for_invoicingclosebutton' + '\').html(\'\');' + '$(\'' + '#open_order_for_invoicinglist' + '\').load(\'<?=site_url();?>/open_order_for_invoicinglist\');' + ';"></input>');
		});	
	}
	
	function open_order_for_invoicinggotopage()
	{
		var page = document.open_order_for_invoicinglistform.pageno.options[document.open_order_for_invoicinglistform.pageno.selectedIndex].value;
		
		$("#open_order_for_invoicingcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#open_order_for_invoicinglist',
					success: 		open_order_for_invoicingshowResponse,
		}; 
		$('#open_order_for_invoicinglistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="open_order_for_invoicing-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="open_order_for_invoicingclosebutton"></div>
		<div id="open_order_for_invoicingformholder"></div>
		<div id="open_order_for_invoicinglist">
		<!--<form method="post" action="<?=site_url();?>/open_order_for_invoicinglist/index/" id="open_order_for_invoicinglistform" name="open_order_for_invoicinglistform">-->
		<form method="post" action="<?=current_url();?>" id="open_order_for_invoicinglistform" name="open_order_for_invoicinglistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#supplierfilter').change(function() { $('form').submit();});});</script>Supplier:&nbsp;<?=form_dropdown('supplier_id', $supplier_opt, $supplier_id, 'id="supplierfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#currencyfilter').change(function() { $('form').submit();});});</script>Currency:&nbsp;<?=form_dropdown('currency_id', $currency_opt, $currency_id, 'id="currencyfilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="open_order_for_invoicingcurrsort">
			</div>
			<div id="open_order_for_invoicingsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="open_order_for_invoicingadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_order_for_invoicingadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_order_for_invoicingadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="open_order_for_invoicingsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="open_order_for_invoicingsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="open_order_for_invoicingsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="open_order_for_invoicingsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('purchaseorderline__id[]', $row['purchaseorderline__id'], false);?></td><td><?=$row['purchaseorderline__date'];?></td><td><?=$row['purchaseorderline__orderid'];?></td><td><?php if (isset($row['purchaseorderline__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['purchaseorderline__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['purchaseorderline__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['purchaseorderline__currency_id'], $row['currency__name']);?></td><td><?php if (isset($row['purchaseorderline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['purchaseorderline__item_id'], $row['item__name']);?></td><td><?=number_format($row['purchaseorderline__quantity'], 2);?></td><td><?php if (isset($row['purchaseorderline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['purchaseorderline__uom_id'], $row['uom__name']);?></td><td><?=number_format($row['purchaseorderline__price'], 2);?></td><td><?=number_format($row['purchaseorderline__subtotal'], 2);?></td><td><?=$row['purchaseorderline__lastupdate'];?></td><td><?=$row['purchaseorderline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="open_order_for_invoicingview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/open_order_for_invoicingview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="open_order_for_invoicingedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_order_for_invoicingedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="open_order_for_invoicingconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="open_order_for_invoicinggotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#create_purchase_invoice').click(function(){$('#open_order_for_invoicinglistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#open_order_for_invoicinglistform').attr('action','<?=site_url();?>/purchase_invoiceadd/index/');});});</script><input id='create_purchase_invoice' type="submit" value="Create Purchase Invoice">
			
		</form>
		</div>