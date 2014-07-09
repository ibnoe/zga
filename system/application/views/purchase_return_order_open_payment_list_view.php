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
					target:        '#purchase_return_order_open_paymentlist',
					success: 		purchase_return_order_open_paymentshowResponse,
		}; 
		
		$('#purchase_return_order_open_paymentlistform').submit(function() { 
			$('#purchase_return_order_open_paymentlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_return_order_open_paymentconfirmdelete(delid, obj)
	{
		$('#purchase_return_order_open_payment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_order_open_paymentconfirmdelete2(delid, obj));
	}
	
	function purchase_return_order_open_paymentconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_order_open_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_order_open_paymentcalldeletefn('purchase_return_order_open_paymentdelete', delid, 'purchase_return_order_open_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_order_open_payment-dialog-confirm').html('');
	}
	
	function purchase_return_order_open_paymentsortupdown(field, direction)
	{
		$("#purchase_return_order_open_paymentcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_return_order_open_paymentlist',
					success: 		purchase_return_order_open_paymentshowResponse,
		}; 
		$('#purchase_return_order_open_paymentlistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_return_order_open_paymentshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_return_order_open_paymentlist',
					success: 		purchase_return_order_open_paymentshowResponse,
		}; 
		
		$('#purchase_return_order_open_paymentlistform').submit(function() { 
			$('#purchase_return_order_open_paymentlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_return_order_open_paymentcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_return_order_open_paymentadd()
	{
		$('#purchase_return_order_open_paymentformholder').load('<?=site_url()."/purchase_return_order_open_paymentadd/";?>', function()
		{$('#purchase_return_order_open_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_order_open_paymentformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_open_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_open_paymentlist' + '\').load(\'<?=site_url();?>/purchase_return_order_open_paymentlist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_order_open_paymentedit(id)
	{
		$('#purchase_return_order_open_paymentformholder').load('<?=site_url()."/purchase_return_order_open_paymentedit/index/";?>' + id, function()
		{$('#purchase_return_order_open_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_order_open_paymentformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_open_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_open_paymentlist' + '\').load(\'<?=site_url();?>/purchase_return_order_open_paymentlist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_order_open_paymentview(id)
	{
		$('#purchase_return_order_open_paymentformholder').load('<?=site_url()."/purchase_return_order_open_paymentview/index/";?>' + id, function()
		{$('#purchase_return_order_open_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_order_open_paymentformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_open_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_order_open_paymentlist' + '\').load(\'<?=site_url();?>/purchase_return_order_open_paymentlist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_order_open_paymentgotopage()
	{
		var page = document.purchase_return_order_open_paymentlistform.pageno.options[document.purchase_return_order_open_paymentlistform.pageno.selectedIndex].value;
		
		$("#purchase_return_order_open_paymentcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_return_order_open_paymentlist',
					success: 		purchase_return_order_open_paymentshowResponse,
		}; 
		$('#purchase_return_order_open_paymentlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchase_return_order_open_payment-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_return_order_open_paymentclosebutton"></div>
		<div id="purchase_return_order_open_paymentformholder"></div>
		<div id="purchase_return_order_open_paymentlist">
		<!--<form method="post" action="<?=site_url();?>/purchase_return_order_open_paymentlist/index/" id="purchase_return_order_open_paymentlistform" name="purchase_return_order_open_paymentlistform">-->
		<form method="post" action="<?=current_url();?>" id="purchase_return_order_open_paymentlistform" name="purchase_return_order_open_paymentlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_return_order_open_paymentcurrsort">
			</div>
			<div id="purchase_return_order_open_paymentsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="purchase_return_order_open_paymentadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_return_order_open_paymentadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_return_order_open_paymentadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="purchase_return_order_open_paymentsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_return_order_open_paymentsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchase_return_order_open_paymentsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_return_order_open_paymentsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/purchase_return_order_open_paymentview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['purchasereturnorder__date'];?></td><td><?=$row['purchasereturnorder__purchasereturnorderid'];?></td><td><?php if (isset($row['purchasereturnorder__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['purchasereturnorder__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['purchasereturnorder__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['purchasereturnorder__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['purchasereturnorder__currencyrate'], 2);?></td><td><?=$row['purchasereturnorder__notes'];?></td><td><?=$row['purchasereturnorder__lastupdate'];?></td><td><?=$row['purchasereturnorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_return_order_open_paymentview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_return_order_open_paymentview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_return_order_open_paymentedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_order_open_paymentedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_order_open_paymentconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_return_order_open_paymentgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>