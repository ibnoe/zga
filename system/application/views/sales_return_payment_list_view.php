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
					target:        '#sales_return_paymentlist',
					success: 		sales_return_paymentshowResponse,
		}; 
		
		$('#sales_return_paymentlistform').submit(function() { 
			$('#sales_return_paymentlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_return_paymentconfirmdelete(delid, obj)
	{
		$('#sales_return_payment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_paymentconfirmdelete2(delid, obj));
	}
	
	function sales_return_paymentconfirmdelete2(delid, obj)
	{
		$( "#sales_return_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_paymentcalldeletefn('sales_return_paymentdelete', delid, 'sales_return_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_payment-dialog-confirm').html('');
	}
	
	function sales_return_paymentsortupdown(field, direction)
	{
		$("#sales_return_paymentcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_return_paymentlist',
					success: 		sales_return_paymentshowResponse,
		}; 
		$('#sales_return_paymentlistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_return_paymentshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_return_paymentlist',
					success: 		sales_return_paymentshowResponse,
		}; 
		
		$('#sales_return_paymentlistform').submit(function() { 
			$('#sales_return_paymentlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_return_paymentcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_return_paymentadd()
	{
		$('#sales_return_paymentformholder').load('<?=site_url()."/sales_return_paymentadd/";?>', function()
		{$('#sales_return_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_paymentformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_paymentlist' + '\').load(\'<?=site_url();?>/sales_return_paymentlist\');' + ';"></input>');
		});	
	}
	
	function sales_return_paymentedit(id)
	{
		$('#sales_return_paymentformholder').load('<?=site_url()."/sales_return_paymentedit/index/";?>' + id, function()
		{$('#sales_return_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_paymentformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_paymentlist' + '\').load(\'<?=site_url();?>/sales_return_paymentlist\');' + ';"></input>');
		});	
	}
	
	function sales_return_paymentview(id)
	{
		$('#sales_return_paymentformholder').load('<?=site_url()."/sales_return_paymentview/index/";?>' + id, function()
		{$('#sales_return_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_paymentformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_paymentlist' + '\').load(\'<?=site_url();?>/sales_return_paymentlist\');' + ';"></input>');
		});	
	}
	
	function sales_return_paymentgotopage()
	{
		var page = document.sales_return_paymentlistform.pageno.options[document.sales_return_paymentlistform.pageno.selectedIndex].value;
		
		$("#sales_return_paymentcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_return_paymentlist',
					success: 		sales_return_paymentshowResponse,
		}; 
		$('#sales_return_paymentlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_return_payment-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_return_paymentclosebutton"></div>
		<div id="sales_return_paymentformholder"></div>
		<div id="sales_return_paymentlist">
		<!--<form method="post" action="<?=site_url();?>/sales_return_paymentlist/index/" id="sales_return_paymentlistform" name="sales_return_paymentlistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_return_paymentlistform" name="sales_return_paymentlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_return_paymentcurrsort">
			</div>
			<div id="sales_return_paymentsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="sales_return_paymentadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_paymentadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_paymentadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_return_paymentsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_return_paymentsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_return_paymentsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_return_paymentsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/sales_return_paymentview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('sales_return_paymentview/index/'.$row['id'], $row['salesreturnpayment__date']);?></td><td><?=$row['salesreturnpayment__salesreturnpaymentid'];?></td><td><?php if (isset($row['salesreturnpayment__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['salesreturnpayment__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['salesreturnpayment__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['salesreturnpayment__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['salesreturnpayment__currencyrate'], 2);?></td><td><?=$row['salesreturnpayment__paymenttype'];?></td><td><?php if (isset($row['salesreturnpayment__cashbank_id']) && $row['cashbank__name'] != "") echo anchor('cash_bankview/index/'.$row['salesreturnpayment__cashbank_id'], $row['cashbank__name']);?></td><td><?php if (isset($row['salesreturnpayment__giroout_id']) && $row['giroout__girooutid'] != "") echo anchor('giro_outview/index/'.$row['salesreturnpayment__giroout_id'], $row['giroout__girooutid']);?></td><td><?php if (isset($row['salesreturnpayment__creditnoteout_id']) && $row['creditnoteout__creditnoteoutid'] != "") echo anchor('credit_note_outview/index/'.$row['salesreturnpayment__creditnoteout_id'], $row['creditnoteout__creditnoteoutid']);?></td><td><?=$row['salesreturnpayment__total'];?></td><td align='right'><?=number_format($row['salesreturnpayment__totalpay'], 2);?></td><td align='right'><?=number_format($row['salesreturnpayment__adjustment'], 2);?></td><td><?=$row['salesreturnpayment__lastupdate'];?></td><td><?=$row['salesreturnpayment__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_return_paymentview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_return_paymentview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_return_paymentedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_paymentedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_paymentconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_return_paymentgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>