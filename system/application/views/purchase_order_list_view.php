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
					target:        '#purchase_orderlist',
					success: 		purchase_ordershowResponse,
		}; 
		
		$('#purchase_orderlistform').submit(function() { 
			$('#purchase_orderlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_orderconfirmdelete(delid, obj)
	{
		$('#purchase_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_orderconfirmdelete2(delid, obj));
	}
	
	function purchase_orderconfirmdelete2(delid, obj)
	{
		$( "#purchase_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_ordercalldeletefn('purchase_orderdelete', delid, 'purchase_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_order-dialog-confirm').html('');
	}
	
	function purchase_ordersortupdown(field, direction)
	{
		$("#purchase_ordercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_orderlist',
					success: 		purchase_ordershowResponse,
		}; 
		$('#purchase_orderlistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_ordershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_orderlist',
					success: 		purchase_ordershowResponse,
		}; 
		
		$('#purchase_orderlistform').submit(function() { 
			$('#purchase_orderlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_ordercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_orderadd()
	{
		$('#purchase_orderformholder').load('<?=site_url()."/purchase_orderadd/";?>', function()
		{$('#purchase_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_orderformholder' + '\').html(\'\');' + '$(\'' + '#purchase_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_orderlist' + '\').load(\'<?=site_url();?>/purchase_orderlist\');' + ';"></input>');
		});	
	}
	
	function purchase_orderedit(id)
	{
		$('#purchase_orderformholder').load('<?=site_url()."/purchase_orderedit/index/";?>' + id, function()
		{$('#purchase_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_orderformholder' + '\').html(\'\');' + '$(\'' + '#purchase_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_orderlist' + '\').load(\'<?=site_url();?>/purchase_orderlist\');' + ';"></input>');
		});	
	}
	
	function purchase_orderview(id)
	{
		$('#purchase_orderformholder').load('<?=site_url()."/purchase_orderview/index/";?>' + id, function()
		{$('#purchase_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_orderformholder' + '\').html(\'\');' + '$(\'' + '#purchase_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_orderlist' + '\').load(\'<?=site_url();?>/purchase_orderlist\');' + ';"></input>');
		});	
	}
	
	function purchase_ordergotopage()
	{
		var page = document.purchase_orderlistform.pageno.options[document.purchase_orderlistform.pageno.selectedIndex].value;
		
		$("#purchase_ordercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_orderlist',
					success: 		purchase_ordershowResponse,
		}; 
		$('#purchase_orderlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchase_order-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_orderclosebutton"></div>
		<div id="purchase_orderformholder"></div>
		<div id="purchase_orderlist">
		<!--<form method="post" action="<?=site_url();?>/purchase_orderlist/index/" id="purchase_orderlistform" name="purchase_orderlistform">-->
		<form method="post" action="<?=current_url();?>" id="purchase_orderlistform" name="purchase_orderlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_ordercurrsort">
			</div>
			<div id="purchase_ordersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="purchase_orderadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_orderadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_orderadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="purchase_ordersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_ordersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchase_ordersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_ordersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/purchase_orderview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('purchase_orderview/index/'.$row['id'], $row['purchaseorder__orderid']);?></td><td><?=$row['purchaseorder__date'];?></td><td><?php if (isset($row['purchaseorder__suratpermintaanpembelian_id']) && $row['suratpermintaanpembelian__orderid'] != "") echo anchor('sppview/index/'.$row['purchaseorder__suratpermintaanpembelian_id'], $row['suratpermintaanpembelian__orderid']);?></td><td><?php if (isset($row['purchaseorder__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['purchaseorder__supplier_id'], $row['supplier__firstname']);?></td><td><?=$row['purchaseorder__buysource'];?></td><td><?php if (isset($row['purchaseorder__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['purchaseorder__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['purchaseorder__currencyrate'], 2);?></td><td><a href="<?=base_url().'/upload//'.$row['purchaseorder__quote1'];?>"> <?=$row['purchaseorder__quote1'];?></a></td><td><?=$row['purchaseorder__notes'];?></td><td><?php if (isset($row['purchaseorder__supplier2_id']) && $row['supplier1__firstname'] != "") echo anchor('supplier_2view/index/'.$row['purchaseorder__supplier2_id'], $row['supplier1__firstname']);?></td><td><a href="<?=base_url().'/upload//'.$row['purchaseorder__quote2'];?>"> <?=$row['purchaseorder__quote2'];?></a></td><td><?=$row['purchaseorder__notes2'];?></td><td><?php if (isset($row['purchaseorder__supplier3_id']) && $row['supplier2__firstname'] != "") echo anchor('supplier_3view/index/'.$row['purchaseorder__supplier3_id'], $row['supplier2__firstname']);?></td><td><a href="<?=base_url().'/upload//'.$row['purchaseorder__quote3'];?>"> <?=$row['purchaseorder__quote3'];?></a></td><td><?=$row['purchaseorder__notes3'];?></td><td><?php if (isset($row['purchaseorder__forwarder_id']) && $row['forwarder__name'] != "") echo anchor('forwarderview/index/'.$row['purchaseorder__forwarder_id'], $row['forwarder__name']);?></td><td><?=$row['purchaseorder__shipmethod'];?></td><td><?=$row['purchaseorder__estarrivaldate'];?></td><td align='right'><?=number_format($row['purchaseorder__total'], 2);?></td><td><?=$row['purchaseorder__lastupdate'];?></td><td><?=$row['purchaseorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_orderview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_orderview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_orderedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_orderedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_orderconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_ordergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>