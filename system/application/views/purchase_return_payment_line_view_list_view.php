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
					target:        '#purchase_return_payment_line_viewlist',
					success: 		purchase_return_payment_line_viewshowResponse,
		}; 
		
		$('#purchase_return_payment_line_viewlistform').submit(function() { 
			$('#purchase_return_payment_line_viewlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_return_payment_line_viewconfirmdelete(delid, obj)
	{
		$('#purchase_return_payment_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_payment_line_viewconfirmdelete2(delid, obj));
	}
	
	function purchase_return_payment_line_viewconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_payment_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_payment_line_viewcalldeletefn('purchase_return_payment_line_viewdelete', delid, 'purchase_return_payment_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_payment_line_view-dialog-confirm').html('');
	}
	
	function purchase_return_payment_line_viewsortupdown(field, direction)
	{
		$("#purchase_return_payment_line_viewcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_return_payment_line_viewlist',
					success: 		purchase_return_payment_line_viewshowResponse,
		}; 
		$('#purchase_return_payment_line_viewlistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_return_payment_line_viewshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_return_payment_line_viewlist',
					success: 		purchase_return_payment_line_viewshowResponse,
		}; 
		
		$('#purchase_return_payment_line_viewlistform').submit(function() { 
			$('#purchase_return_payment_line_viewlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_return_payment_line_viewcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_return_payment_line_viewadd()
	{
		$('#purchase_return_payment_line_viewformholder').load('<?=site_url()."/purchase_return_payment_line_viewadd/";?>', function()
		{$('#purchase_return_payment_line_viewclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_payment_line_viewformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_payment_line_viewclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_payment_line_viewlist' + '\').load(\'<?=site_url();?>/purchase_return_payment_line_viewlist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_payment_line_viewedit(id)
	{
		$('#purchase_return_payment_line_viewformholder').load('<?=site_url()."/purchase_return_payment_line_viewedit/index/";?>' + id, function()
		{$('#purchase_return_payment_line_viewclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_payment_line_viewformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_payment_line_viewclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_payment_line_viewlist' + '\').load(\'<?=site_url();?>/purchase_return_payment_line_viewlist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_payment_line_viewview(id)
	{
		$('#purchase_return_payment_line_viewformholder').load('<?=site_url()."/purchase_return_payment_line_viewview/index/";?>' + id, function()
		{$('#purchase_return_payment_line_viewclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_payment_line_viewformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_payment_line_viewclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_payment_line_viewlist' + '\').load(\'<?=site_url();?>/purchase_return_payment_line_viewlist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_payment_line_viewgotopage()
	{
		var page = document.purchase_return_payment_line_viewlistform.pageno.options[document.purchase_return_payment_line_viewlistform.pageno.selectedIndex].value;
		
		$("#purchase_return_payment_line_viewcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_return_payment_line_viewlist',
					success: 		purchase_return_payment_line_viewshowResponse,
		}; 
		$('#purchase_return_payment_line_viewlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchase_return_payment_line_view-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_return_payment_line_viewclosebutton"></div>
		<div id="purchase_return_payment_line_viewformholder"></div>
		<div id="purchase_return_payment_line_viewlist">
		<!--<form method="post" action="<?=site_url();?>/purchase_return_payment_line_viewlist/index/" id="purchase_return_payment_line_viewlistform" name="purchase_return_payment_line_viewlistform">-->
		<form method="post" action="<?=current_url();?>" id="purchase_return_payment_line_viewlistform" name="purchase_return_payment_line_viewlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_return_payment_line_viewcurrsort">
			</div>
			<div id="purchase_return_payment_line_viewsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="purchase_return_payment_line_viewadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_return_payment_line_viewadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_return_payment_line_viewadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="purchase_return_payment_line_viewsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_return_payment_line_viewsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchase_return_payment_line_viewsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_return_payment_line_viewsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/purchase_return_payment_line_viewview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['purchasereturnpaymentline__purchasereturninvoice_id']) && $row['purchasereturninvoice__purchasereturninvoiceid'] != "") echo anchor('purchase_return_invoiceview/index/'.$row['purchasereturnpaymentline__purchasereturninvoice_id'], $row['purchasereturninvoice__purchasereturninvoiceid']);?></td><td><?=$row['purchasereturnpaymentline__lastupdate'];?></td><td><?=$row['purchasereturnpaymentline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_return_payment_line_viewview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_return_payment_line_viewview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_return_payment_line_viewedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_payment_line_viewedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_payment_line_viewconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_return_payment_line_viewgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>