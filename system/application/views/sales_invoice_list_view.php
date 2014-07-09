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
					target:        '#sales_invoicelist',
					success: 		sales_invoiceshowResponse,
		}; 
		
		$('#sales_invoicelistform').submit(function() { 
			$('#sales_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_invoiceconfirmdelete(delid, obj)
	{
		$('#sales_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_invoiceconfirmdelete2(delid, obj));
	}
	
	function sales_invoiceconfirmdelete2(delid, obj)
	{
		$( "#sales_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_invoicecalldeletefn('sales_invoicedelete', delid, 'sales_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_invoice-dialog-confirm').html('');
	}
	
	function sales_invoicesortupdown(field, direction)
	{
		$("#sales_invoicecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_invoicelist',
					success: 		sales_invoiceshowResponse,
		}; 
		$('#sales_invoicelistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_invoiceshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_invoicelist',
					success: 		sales_invoiceshowResponse,
		}; 
		
		$('#sales_invoicelistform').submit(function() { 
			$('#sales_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_invoicecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_invoiceadd()
	{
		$('#sales_invoiceformholder').load('<?=site_url()."/sales_invoiceadd/";?>', function()
		{$('#sales_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#sales_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_invoicelist' + '\').load(\'<?=site_url();?>/sales_invoicelist\');' + ';"></input>');
		});	
	}
	
	function sales_invoiceedit(id)
	{
		$('#sales_invoiceformholder').load('<?=site_url()."/sales_invoiceedit/index/";?>' + id, function()
		{$('#sales_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#sales_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_invoicelist' + '\').load(\'<?=site_url();?>/sales_invoicelist\');' + ';"></input>');
		});	
	}
	
	function sales_invoiceview(id)
	{
		$('#sales_invoiceformholder').load('<?=site_url()."/sales_invoiceview/index/";?>' + id, function()
		{$('#sales_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#sales_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_invoicelist' + '\').load(\'<?=site_url();?>/sales_invoicelist\');' + ';"></input>');
		});	
	}
	
	function sales_invoicegotopage()
	{
		var page = document.sales_invoicelistform.pageno.options[document.sales_invoicelistform.pageno.selectedIndex].value;
		
		$("#sales_invoicecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_invoicelist',
					success: 		sales_invoiceshowResponse,
		}; 
		$('#sales_invoicelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_invoice-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_invoiceclosebutton"></div>
		<div id="sales_invoiceformholder"></div>
		<div id="sales_invoicelist">
		<!--<form method="post" action="<?=site_url();?>/sales_invoicelist/index/" id="sales_invoicelistform" name="sales_invoicelistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_invoicelistform" name="sales_invoicelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_invoicecurrsort">
			</div>
			<div id="sales_invoicesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="sales_invoiceadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_invoiceadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_invoiceadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_invoicesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_invoicesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_invoicesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_invoicesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/sales_invoiceview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('sales_invoiceview/index/'.$row['id'], $row['salesinvoice__date']);?></td><td><?=$row['salesinvoice__orderid'];?></td><td><?=$row['salesinvoice__donum'];?></td><td><?php if (isset($row['salesinvoice__deliveryorder_id']) && $row['deliveryorder__orderid'] != "") echo anchor('delivery_order_for_invoiceview/index/'.$row['salesinvoice__deliveryorder_id'], $row['deliveryorder__orderid']);?></td><td align='right'><?=number_format($row['salesinvoice__total'], 2);?></td><td><?=$row['salesinvoice__top'];?></td><td><?=$row['salesinvoice__lastupdate'];?></td><td><?=$row['salesinvoice__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_invoiceview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_invoiceview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_invoiceedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_invoiceedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_invoiceconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_invoicegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>