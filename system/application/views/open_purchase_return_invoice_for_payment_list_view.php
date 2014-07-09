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
					target:        '#open_purchase_return_invoice_for_paymentlist',
					success: 		open_purchase_return_invoice_for_paymentshowResponse,
		}; 
		
		$('#open_purchase_return_invoice_for_paymentlistform').submit(function() { 
			$('#open_purchase_return_invoice_for_paymentlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function open_purchase_return_invoice_for_paymentconfirmdelete(delid, obj)
	{
		$('#open_purchase_return_invoice_for_payment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_purchase_return_invoice_for_paymentconfirmdelete2(delid, obj));
	}
	
	function open_purchase_return_invoice_for_paymentconfirmdelete2(delid, obj)
	{
		$( "#open_purchase_return_invoice_for_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_purchase_return_invoice_for_paymentcalldeletefn('open_purchase_return_invoice_for_paymentdelete', delid, 'open_purchase_return_invoice_for_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_purchase_return_invoice_for_payment-dialog-confirm').html('');
	}
	
	function open_purchase_return_invoice_for_paymentsortupdown(field, direction)
	{
		$("#open_purchase_return_invoice_for_paymentcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#open_purchase_return_invoice_for_paymentlist',
					success: 		open_purchase_return_invoice_for_paymentshowResponse,
		}; 
		$('#open_purchase_return_invoice_for_paymentlistform').ajaxSubmit(options);
		return false;
	}
	
	function open_purchase_return_invoice_for_paymentshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#open_purchase_return_invoice_for_paymentlist',
					success: 		open_purchase_return_invoice_for_paymentshowResponse,
		}; 
		
		$('#open_purchase_return_invoice_for_paymentlistform').submit(function() { 
			$('#open_purchase_return_invoice_for_paymentlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function open_purchase_return_invoice_for_paymentcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function open_purchase_return_invoice_for_paymentadd()
	{
		$('#open_purchase_return_invoice_for_paymentformholder').load('<?=site_url()."/open_purchase_return_invoice_for_paymentadd/";?>', function()
		{$('#open_purchase_return_invoice_for_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_purchase_return_invoice_for_paymentformholder' + '\').html(\'\');' + '$(\'' + '#open_purchase_return_invoice_for_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#open_purchase_return_invoice_for_paymentlist' + '\').load(\'<?=site_url();?>/open_purchase_return_invoice_for_paymentlist\');' + ';"></input>');
		});	
	}
	
	function open_purchase_return_invoice_for_paymentedit(id)
	{
		$('#open_purchase_return_invoice_for_paymentformholder').load('<?=site_url()."/open_purchase_return_invoice_for_paymentedit/index/";?>' + id, function()
		{$('#open_purchase_return_invoice_for_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_purchase_return_invoice_for_paymentformholder' + '\').html(\'\');' + '$(\'' + '#open_purchase_return_invoice_for_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#open_purchase_return_invoice_for_paymentlist' + '\').load(\'<?=site_url();?>/open_purchase_return_invoice_for_paymentlist\');' + ';"></input>');
		});	
	}
	
	function open_purchase_return_invoice_for_paymentview(id)
	{
		$('#open_purchase_return_invoice_for_paymentformholder').load('<?=site_url()."/open_purchase_return_invoice_for_paymentview/index/";?>' + id, function()
		{$('#open_purchase_return_invoice_for_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_purchase_return_invoice_for_paymentformholder' + '\').html(\'\');' + '$(\'' + '#open_purchase_return_invoice_for_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#open_purchase_return_invoice_for_paymentlist' + '\').load(\'<?=site_url();?>/open_purchase_return_invoice_for_paymentlist\');' + ';"></input>');
		});	
	}
	
	function open_purchase_return_invoice_for_paymentgotopage()
	{
		var page = document.open_purchase_return_invoice_for_paymentlistform.pageno.options[document.open_purchase_return_invoice_for_paymentlistform.pageno.selectedIndex].value;
		
		$("#open_purchase_return_invoice_for_paymentcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#open_purchase_return_invoice_for_paymentlist',
					success: 		open_purchase_return_invoice_for_paymentshowResponse,
		}; 
		$('#open_purchase_return_invoice_for_paymentlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="open_purchase_return_invoice_for_payment-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="open_purchase_return_invoice_for_paymentclosebutton"></div>
		<div id="open_purchase_return_invoice_for_paymentformholder"></div>
		<div id="open_purchase_return_invoice_for_paymentlist">
		<!--<form method="post" action="<?=site_url();?>/open_purchase_return_invoice_for_paymentlist/index/" id="open_purchase_return_invoice_for_paymentlistform" name="open_purchase_return_invoice_for_paymentlistform">-->
		<form method="post" action="<?=current_url();?>" id="open_purchase_return_invoice_for_paymentlistform" name="open_purchase_return_invoice_for_paymentlistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#supplierfilter').change(function() { $('#open_purchase_return_invoice_for_paymentlistform').submit();});});</script>Supplier:&nbsp;<?=form_dropdown('supplier_id', $supplier_opt, $supplier_id, 'id="supplierfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#currencyfilter').change(function() { $('#open_purchase_return_invoice_for_paymentlistform').submit();});});</script>Currency:&nbsp;<?=form_dropdown('currency_id', $currency_opt, $currency_id, 'id="currencyfilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="open_purchase_return_invoice_for_paymentcurrsort">
			</div>
			<div id="open_purchase_return_invoice_for_paymentsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="open_purchase_return_invoice_for_paymentadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_purchase_return_invoice_for_paymentadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_purchase_return_invoice_for_paymentadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="open_purchase_return_invoice_for_paymentsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="open_purchase_return_invoice_for_paymentsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="open_purchase_return_invoice_for_paymentsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="open_purchase_return_invoice_for_paymentsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('purchasereturninvoice__id[]', $row['purchasereturninvoice__id'], false);?></td><td><?=$row['purchasereturninvoice__date'];?></td><td><?=$row['purchasereturninvoice__purchasereturninvoiceid'];?></td><td><?php if (isset($row['purchasereturninvoice__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['purchasereturninvoice__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['purchasereturninvoice__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['purchasereturninvoice__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['purchasereturninvoice__total'], 2);?></td><td><?=$row['purchasereturninvoice__lastupdate'];?></td><td><?=$row['purchasereturninvoice__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="open_purchase_return_invoice_for_paymentview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/open_purchase_return_invoice_for_paymentview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="open_purchase_return_invoice_for_paymentedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_purchase_return_invoice_for_paymentedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="open_purchase_return_invoice_for_paymentconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="open_purchase_return_invoice_for_paymentgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#create_payment').click(function(){$('#open_purchase_return_invoice_for_paymentlistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#open_purchase_return_invoice_for_paymentlistform').attr('action','<?=site_url();?>/purchase_return_paymentadd/index/');});});</script><input id='create_payment' type="submit" value="Create Payment">
			
		</form>
		</div>