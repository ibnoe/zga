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
					target:        '#purchase_invoicelist',
					success: 		purchase_invoiceshowResponse,
		}; 
		
		$('#purchase_invoicelistform').submit(function() { 
			$('#purchase_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_invoiceconfirmdelete(delid, obj)
	{
		$('#purchase_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_invoiceconfirmdelete2(delid, obj));
	}
	
	function purchase_invoiceconfirmdelete2(delid, obj)
	{
		$( "#purchase_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_invoicecalldeletefn('purchase_invoicedelete', delid, 'purchase_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_invoice-dialog-confirm').html('');
	}
	
	function purchase_invoicesortupdown(field, direction)
	{
		$("#purchase_invoicecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_invoicelist',
					success: 		purchase_invoiceshowResponse,
		}; 
		$('#purchase_invoicelistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_invoiceshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_invoicelist',
					success: 		purchase_invoiceshowResponse,
		}; 
		
		$('#purchase_invoicelistform').submit(function() { 
			$('#purchase_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_invoicecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_invoiceadd()
	{
		$('#purchase_invoiceformholder').load('<?=site_url()."/purchase_invoiceadd/";?>', function()
		{$('#purchase_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#purchase_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_invoicelist' + '\').load(\'<?=site_url();?>/purchase_invoicelist\');' + ';"></input>');
		});	
	}
	
	function purchase_invoiceedit(id)
	{
		$('#purchase_invoiceformholder').load('<?=site_url()."/purchase_invoiceedit/index/";?>' + id, function()
		{$('#purchase_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#purchase_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_invoicelist' + '\').load(\'<?=site_url();?>/purchase_invoicelist\');' + ';"></input>');
		});	
	}
	
	function purchase_invoiceview(id)
	{
		$('#purchase_invoiceformholder').load('<?=site_url()."/purchase_invoiceview/index/";?>' + id, function()
		{$('#purchase_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#purchase_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_invoicelist' + '\').load(\'<?=site_url();?>/purchase_invoicelist\');' + ';"></input>');
		});	
	}
	
	function purchase_invoicegotopage()
	{
		var page = document.purchase_invoicelistform.pageno.options[document.purchase_invoicelistform.pageno.selectedIndex].value;
		
		$("#purchase_invoicecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_invoicelist',
					success: 		purchase_invoiceshowResponse,
		}; 
		$('#purchase_invoicelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchase_invoice-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_invoiceclosebutton"></div>
		<div id="purchase_invoiceformholder"></div>
		<div id="purchase_invoicelist">
		<!--<form method="post" action="<?=site_url();?>/purchase_invoicelist/index/" id="purchase_invoicelistform" name="purchase_invoicelistform">-->
		<form method="post" action="<?=current_url();?>" id="purchase_invoicelistform" name="purchase_invoicelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_invoicecurrsort">
			</div>
			<div id="purchase_invoicesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="purchase_invoiceadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_invoiceadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_invoiceadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				
				
				<?php foreach ($fields as $k=>$v): ?>
					<th>
						<?=$v;?><br/>
						<?php if (in_array($k, $sortby))
						{
							$index = array_search($k, $sortby);
							if (false)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="purchase_invoicesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_invoicesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="purchase_invoicesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_invoicesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['purchaseinvoice__date'];?></td><td><?=$row['purchaseinvoice__orderid'];?></td><td><?php if (isset($row['purchaseinvoice__receiveditem_id']) && $row['purchaseinvoice__receiveditem_id'] > 0) echo $row['receiveditem__suratjalanno'];?></td><td align='right'><?=number_format($row['purchaseinvoice__total'], 2);?></td><td><?=$row['purchaseinvoice__top'];?></td><td><?php if (isset($row['purchaseinvoice__ongkoskirimimport_id']) && $row['purchaseinvoice__ongkoskirimimport_id'] > 0) echo $row['ongkoskirimimport__idstring'];?></td><td><?=$row['purchaseinvoice__lastupdate'];?></td><td><?=$row['purchaseinvoice__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_invoiceview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_invoiceview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_invoiceedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_invoiceedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_invoiceconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_invoicegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>