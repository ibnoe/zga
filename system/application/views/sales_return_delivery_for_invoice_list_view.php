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
					target:        '#sales_return_delivery_for_invoicelist',
					success: 		sales_return_delivery_for_invoiceshowResponse,
		}; 
		
		$('#sales_return_delivery_for_invoicelistform').submit(function() { 
			$('#sales_return_delivery_for_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_return_delivery_for_invoiceconfirmdelete(delid, obj)
	{
		$('#sales_return_delivery_for_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_delivery_for_invoiceconfirmdelete2(delid, obj));
	}
	
	function sales_return_delivery_for_invoiceconfirmdelete2(delid, obj)
	{
		$( "#sales_return_delivery_for_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_delivery_for_invoicecalldeletefn('sales_return_delivery_for_invoicedelete', delid, 'sales_return_delivery_for_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_delivery_for_invoice-dialog-confirm').html('');
	}
	
	function sales_return_delivery_for_invoicesortupdown(field, direction)
	{
		$("#sales_return_delivery_for_invoicecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_return_delivery_for_invoicelist',
					success: 		sales_return_delivery_for_invoiceshowResponse,
		}; 
		$('#sales_return_delivery_for_invoicelistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_return_delivery_for_invoiceshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_return_delivery_for_invoicelist',
					success: 		sales_return_delivery_for_invoiceshowResponse,
		}; 
		
		$('#sales_return_delivery_for_invoicelistform').submit(function() { 
			$('#sales_return_delivery_for_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_return_delivery_for_invoicecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_return_delivery_for_invoiceadd()
	{
		$('#sales_return_delivery_for_invoiceformholder').load('<?=site_url()."/sales_return_delivery_for_invoiceadd/";?>', function()
		{$('#sales_return_delivery_for_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_delivery_for_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_delivery_for_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_delivery_for_invoicelist' + '\').load(\'<?=site_url();?>/sales_return_delivery_for_invoicelist\');' + ';"></input>');
		});	
	}
	
	function sales_return_delivery_for_invoiceedit(id)
	{
		$('#sales_return_delivery_for_invoiceformholder').load('<?=site_url()."/sales_return_delivery_for_invoiceedit/index/";?>' + id, function()
		{$('#sales_return_delivery_for_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_delivery_for_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_delivery_for_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_delivery_for_invoicelist' + '\').load(\'<?=site_url();?>/sales_return_delivery_for_invoicelist\');' + ';"></input>');
		});	
	}
	
	function sales_return_delivery_for_invoiceview(id)
	{
		$('#sales_return_delivery_for_invoiceformholder').load('<?=site_url()."/sales_return_delivery_for_invoiceview/index/";?>' + id, function()
		{$('#sales_return_delivery_for_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_delivery_for_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_delivery_for_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_delivery_for_invoicelist' + '\').load(\'<?=site_url();?>/sales_return_delivery_for_invoicelist\');' + ';"></input>');
		});	
	}
	
	function sales_return_delivery_for_invoicegotopage()
	{
		var page = document.sales_return_delivery_for_invoicelistform.pageno.options[document.sales_return_delivery_for_invoicelistform.pageno.selectedIndex].value;
		
		$("#sales_return_delivery_for_invoicecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_return_delivery_for_invoicelist',
					success: 		sales_return_delivery_for_invoiceshowResponse,
		}; 
		$('#sales_return_delivery_for_invoicelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_return_delivery_for_invoice-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_return_delivery_for_invoiceclosebutton"></div>
		<div id="sales_return_delivery_for_invoiceformholder"></div>
		<div id="sales_return_delivery_for_invoicelist">
		<!--<form method="post" action="<?=site_url();?>/sales_return_delivery_for_invoicelist/index/" id="sales_return_delivery_for_invoicelistform" name="sales_return_delivery_for_invoicelistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_return_delivery_for_invoicelistform" name="sales_return_delivery_for_invoicelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_return_delivery_for_invoicecurrsort">
			</div>
			<div id="sales_return_delivery_for_invoicesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="sales_return_delivery_for_invoiceadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_delivery_for_invoiceadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_delivery_for_invoiceadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_return_delivery_for_invoicesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_return_delivery_for_invoicesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_return_delivery_for_invoicesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_return_delivery_for_invoicesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/sales_return_delivery_for_invoiceview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('sales_return_delivery_for_invoiceview/index/'.$row['id'], $row['salesreturndelivery__date']);?></td><td><?=$row['salesreturndelivery__salesreturndeliveryid'];?></td><td><?php if (isset($row['salesreturndelivery__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['salesreturndelivery__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['salesreturndelivery__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['salesreturndelivery__warehouse_id'], $row['warehouse__name']);?></td><td><?=$row['salesreturndelivery__notes'];?></td><td><?=$row['salesreturndelivery__lastupdate'];?></td><td><?=$row['salesreturndelivery__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_return_delivery_for_invoiceview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_return_delivery_for_invoiceview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_return_delivery_for_invoiceedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_delivery_for_invoiceedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_delivery_for_invoiceconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_return_delivery_for_invoicegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>