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
					target:        '#purchase_return_invoicelist',
					success: 		purchase_return_invoiceshowResponse,
		}; 
		
		$('#purchase_return_invoicelistform').submit(function() { 
			$('#purchase_return_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_return_invoiceconfirmdelete(delid, obj)
	{
		$('#purchase_return_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_invoiceconfirmdelete2(delid, obj));
	}
	
	function purchase_return_invoiceconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_invoicecalldeletefn('purchase_return_invoicedelete', delid, 'purchase_return_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_invoice-dialog-confirm').html('');
	}
	
	function purchase_return_invoicesortupdown(field, direction)
	{
		$("#purchase_return_invoicecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_return_invoicelist',
					success: 		purchase_return_invoiceshowResponse,
		}; 
		$('#purchase_return_invoicelistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_return_invoiceshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_return_invoicelist',
					success: 		purchase_return_invoiceshowResponse,
		}; 
		
		$('#purchase_return_invoicelistform').submit(function() { 
			$('#purchase_return_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_return_invoicecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_return_invoiceadd()
	{
		$('#purchase_return_invoiceformholder').load('<?=site_url()."/purchase_return_invoiceadd/";?>', function()
		{$('#purchase_return_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoicelist' + '\').load(\'<?=site_url();?>/purchase_return_invoicelist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_invoiceedit(id)
	{
		$('#purchase_return_invoiceformholder').load('<?=site_url()."/purchase_return_invoiceedit/index/";?>' + id, function()
		{$('#purchase_return_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoicelist' + '\').load(\'<?=site_url();?>/purchase_return_invoicelist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_invoiceview(id)
	{
		$('#purchase_return_invoiceformholder').load('<?=site_url()."/purchase_return_invoiceview/index/";?>' + id, function()
		{$('#purchase_return_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoicelist' + '\').load(\'<?=site_url();?>/purchase_return_invoicelist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_invoicegotopage()
	{
		var page = document.purchase_return_invoicelistform.pageno.options[document.purchase_return_invoicelistform.pageno.selectedIndex].value;
		
		$("#purchase_return_invoicecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_return_invoicelist',
					success: 		purchase_return_invoiceshowResponse,
		}; 
		$('#purchase_return_invoicelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchase_return_invoice-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_return_invoiceclosebutton"></div>
		<div id="purchase_return_invoiceformholder"></div>
		<div id="purchase_return_invoicelist">
		<!--<form method="post" action="<?=site_url();?>/purchase_return_invoicelist/index/" id="purchase_return_invoicelistform" name="purchase_return_invoicelistform">-->
		<form method="post" action="<?=current_url();?>" id="purchase_return_invoicelistform" name="purchase_return_invoicelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_return_invoicecurrsort">
			</div>
			<div id="purchase_return_invoicesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="purchase_return_invoiceadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_return_invoiceadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_return_invoiceadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="purchase_return_invoicesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_return_invoicesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchase_return_invoicesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_return_invoicesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/purchase_return_invoiceview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('purchase_return_invoiceview/index/'.$row['id'], $row['purchasereturninvoice__date']);?></td><td><?=$row['purchasereturninvoice__purchasereturninvoiceid'];?></td><td><?php if (isset($row['purchasereturninvoice__purchasereturndelivery_id']) && $row['purchasereturndelivery__purchasereturndeliveryid'] != "") echo anchor('purchase_return_delivery_for_invoiceview/index/'.$row['purchasereturninvoice__purchasereturndelivery_id'], $row['purchasereturndelivery__purchasereturndeliveryid']);?></td><td align='right'><?=number_format($row['purchasereturninvoice__total'], 2);?></td><td><?=$row['purchasereturninvoice__lastupdate'];?></td><td><?=$row['purchasereturninvoice__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_return_invoiceview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_return_invoiceview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_return_invoiceedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_invoiceedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_invoiceconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_return_invoicegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>