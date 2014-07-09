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
					target:        '#sales_return_for_invoicinglist',
					success: 		sales_return_for_invoicingshowResponse,
		}; 
		
		$('#sales_return_for_invoicinglistform').submit(function() { 
			$('#sales_return_for_invoicinglistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_return_for_invoicingconfirmdelete(delid, obj)
	{
		$('#sales_return_for_invoicing-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_for_invoicingconfirmdelete2(delid, obj));
	}
	
	function sales_return_for_invoicingconfirmdelete2(delid, obj)
	{
		$( "#sales_return_for_invoicing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_for_invoicingcalldeletefn('sales_return_for_invoicingdelete', delid, 'sales_return_for_invoicinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_for_invoicing-dialog-confirm').html('');
	}
	
	function sales_return_for_invoicingsortupdown(field, direction)
	{
		$("#sales_return_for_invoicingcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_return_for_invoicinglist',
					success: 		sales_return_for_invoicingshowResponse,
		}; 
		$('#sales_return_for_invoicinglistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_return_for_invoicingshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_return_for_invoicinglist',
					success: 		sales_return_for_invoicingshowResponse,
		}; 
		
		$('#sales_return_for_invoicinglistform').submit(function() { 
			$('#sales_return_for_invoicinglistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_return_for_invoicingcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_return_for_invoicingadd()
	{
		$('#sales_return_for_invoicingformholder').load('<?=site_url()."/sales_return_for_invoicingadd/";?>', function()
		{$('#sales_return_for_invoicingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_for_invoicingformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_for_invoicingclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_for_invoicinglist' + '\').load(\'<?=site_url();?>/sales_return_for_invoicinglist\');' + ';"></input>');
		});	
	}
	
	function sales_return_for_invoicingedit(id)
	{
		$('#sales_return_for_invoicingformholder').load('<?=site_url()."/sales_return_for_invoicingedit/index/";?>' + id, function()
		{$('#sales_return_for_invoicingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_for_invoicingformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_for_invoicingclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_for_invoicinglist' + '\').load(\'<?=site_url();?>/sales_return_for_invoicinglist\');' + ';"></input>');
		});	
	}
	
	function sales_return_for_invoicingview(id)
	{
		$('#sales_return_for_invoicingformholder').load('<?=site_url()."/sales_return_for_invoicingview/index/";?>' + id, function()
		{$('#sales_return_for_invoicingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_for_invoicingformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_for_invoicingclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_for_invoicinglist' + '\').load(\'<?=site_url();?>/sales_return_for_invoicinglist\');' + ';"></input>');
		});	
	}
	
	function sales_return_for_invoicinggotopage()
	{
		var page = document.sales_return_for_invoicinglistform.pageno.options[document.sales_return_for_invoicinglistform.pageno.selectedIndex].value;
		
		$("#sales_return_for_invoicingcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_return_for_invoicinglist',
					success: 		sales_return_for_invoicingshowResponse,
		}; 
		$('#sales_return_for_invoicinglistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_return_for_invoicing-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_return_for_invoicingclosebutton"></div>
		<div id="sales_return_for_invoicingformholder"></div>
		<div id="sales_return_for_invoicinglist">
		<!--<form method="post" action="<?=site_url();?>/sales_return_for_invoicinglist/index/" id="sales_return_for_invoicinglistform" name="sales_return_for_invoicinglistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_return_for_invoicinglistform" name="sales_return_for_invoicinglistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#customerfilter').change(function() { $('form').submit();});});</script>Customer:&nbsp;<?=form_dropdown('customer_id', $customer_opt, $customer_id, 'id="customerfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#currencyfilter').change(function() { $('form').submit();});});</script>Currency:&nbsp;<?=form_dropdown('currency_id', $currency_opt, $currency_id, 'id="currencyfilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_return_for_invoicingcurrsort">
			</div>
			<div id="sales_return_for_invoicingsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="sales_return_for_invoicingadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_for_invoicingadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_for_invoicingadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_return_for_invoicingsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_return_for_invoicingsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_return_for_invoicingsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_return_for_invoicingsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('salesreturnorderline__id[]', $row['salesreturnorderline__id'], false);?></td><td><?=$row['salesreturnorderline__date'];?></td><td><?=$row['salesreturnorderline__salesreturnorderid'];?></td><td><?php if (isset($row['salesreturnorderline__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['salesreturnorderline__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['salesreturnorderline__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['salesreturnorderline__currency_id'], $row['currency__name']);?></td><td><?php if (isset($row['salesreturnorderline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['salesreturnorderline__item_id'], $row['item__name']);?></td><td><?=number_format($row['salesreturnorderline__quantitytoreceive'], 2);?></td><td><?php if (isset($row['salesreturnorderline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['salesreturnorderline__uom_id'], $row['uom__name']);?></td><td><?=$row['salesreturnorderline__lastupdate'];?></td><td><?=$row['salesreturnorderline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_return_for_invoicingview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_return_for_invoicingview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_return_for_invoicingedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_for_invoicingedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_for_invoicingconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_return_for_invoicinggotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#create_sales_return_invoice').click(function(){$('#sales_return_for_invoicinglistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#sales_return_for_invoicinglistform').attr('action','<?=site_url();?>/sales_return_invoiceadd/index/');});});</script><input id='create_sales_return_invoice' type="submit" value="Create Sales Return Invoice">
			
		</form>
		</div>