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
					target:        '#purchase_paymentlist',
					success: 		purchase_paymentshowResponse,
		}; 
		
		$('#purchase_paymentlistform').submit(function() { 
			$('#purchase_paymentlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_paymentconfirmdelete(delid, obj)
	{
		$('#purchase_payment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_paymentconfirmdelete2(delid, obj));
	}
	
	function purchase_paymentconfirmdelete2(delid, obj)
	{
		$( "#purchase_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_paymentcalldeletefn('purchase_paymentdelete', delid, 'purchase_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_payment-dialog-confirm').html('');
	}
	
	function purchase_paymentsortupdown(field, direction)
	{
		$("#purchase_paymentcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_paymentlist',
					success: 		purchase_paymentshowResponse,
		}; 
		$('#purchase_paymentlistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_paymentshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_paymentlist',
					success: 		purchase_paymentshowResponse,
		}; 
		
		$('#purchase_paymentlistform').submit(function() { 
			$('#purchase_paymentlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_paymentcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_paymentadd()
	{
		$('#purchase_paymentformholder').load('<?=site_url()."/purchase_paymentadd/";?>', function()
		{$('#purchase_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_paymentformholder' + '\').html(\'\');' + '$(\'' + '#purchase_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_paymentlist' + '\').load(\'<?=site_url();?>/purchase_paymentlist\');' + ';"></input>');
		});	
	}
	
	function purchase_paymentedit(id)
	{
		$('#purchase_paymentformholder').load('<?=site_url()."/purchase_paymentedit/index/";?>' + id, function()
		{$('#purchase_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_paymentformholder' + '\').html(\'\');' + '$(\'' + '#purchase_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_paymentlist' + '\').load(\'<?=site_url();?>/purchase_paymentlist\');' + ';"></input>');
		});	
	}
	
	function purchase_paymentview(id)
	{
		$('#purchase_paymentformholder').load('<?=site_url()."/purchase_paymentview/index/";?>' + id, function()
		{$('#purchase_paymentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_paymentformholder' + '\').html(\'\');' + '$(\'' + '#purchase_paymentclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_paymentlist' + '\').load(\'<?=site_url();?>/purchase_paymentlist\');' + ';"></input>');
		});	
	}
	
	function purchase_paymentgotopage()
	{
		var page = document.purchase_paymentlistform.pageno.options[document.purchase_paymentlistform.pageno.selectedIndex].value;
		
		$("#purchase_paymentcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_paymentlist',
					success: 		purchase_paymentshowResponse,
		}; 
		$('#purchase_paymentlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchase_payment-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_paymentclosebutton"></div>
		<div id="purchase_paymentformholder"></div>
		<div id="purchase_paymentlist">
		<!--<form method="post" action="<?=site_url();?>/purchase_paymentlist/index/" id="purchase_paymentlistform" name="purchase_paymentlistform">-->
		<form method="post" action="<?=current_url();?>" id="purchase_paymentlistform" name="purchase_paymentlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_paymentcurrsort">
			</div>
			<div id="purchase_paymentsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="purchase_paymentadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_paymentadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_paymentadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="purchase_paymentsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_paymentsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchase_paymentsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_paymentsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/purchase_paymentview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('purchase_paymentview/index/'.$row['id'], $row['purchasepayment__date']);?></td><td><?=$row['purchasepayment__purchasepaymentid'];?></td><td><?php if (isset($row['purchasepayment__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['purchasepayment__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['purchasepayment__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['purchasepayment__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['purchasepayment__currencyrate'], 2);?></td><td><?=$row['purchasepayment__paymenttype'];?></td><td><?php if (isset($row['purchasepayment__cashbank_id']) && $row['cashbank__name'] != "") echo anchor('cash_bankview/index/'.$row['purchasepayment__cashbank_id'], $row['cashbank__name']);?></td><td><?php if (isset($row['purchasepayment__giroout_id']) && $row['giroout__girooutid'] != "") echo anchor('giro_outview/index/'.$row['purchasepayment__giroout_id'], $row['giroout__girooutid']);?></td><td><?php if (isset($row['purchasepayment__creditnotein_id']) && $row['creditnotein__creditnoteinid'] != "") echo anchor('credit_note_inview/index/'.$row['purchasepayment__creditnotein_id'], $row['creditnotein__creditnoteinid']);?></td><td><?=$row['purchasepayment__total'];?></td><td align='right'><?=number_format($row['purchasepayment__totalpay'], 2);?></td><td align='right'><?=number_format($row['purchasepayment__adjustment'], 2);?></td><td><?=$row['purchasepayment__lastupdate'];?></td><td><?=$row['purchasepayment__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_paymentview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_paymentview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_paymentedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_paymentedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_paymentconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_paymentgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>