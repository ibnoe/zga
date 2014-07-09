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
					target:        '#receive_items_for_invoicelist',
					success: 		receive_items_for_invoiceshowResponse,
		}; 
		
		$('#receive_items_for_invoicelistform').submit(function() { 
			$('#receive_items_for_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function receive_items_for_invoiceconfirmdelete(delid, obj)
	{
		$('#receive_items_for_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', receive_items_for_invoiceconfirmdelete2(delid, obj));
	}
	
	function receive_items_for_invoiceconfirmdelete2(delid, obj)
	{
		$( "#receive_items_for_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					receive_items_for_invoicecalldeletefn('receive_items_for_invoicedelete', delid, 'receive_items_for_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#receive_items_for_invoice-dialog-confirm').html('');
	}
	
	function receive_items_for_invoicesortupdown(field, direction)
	{
		$("#receive_items_for_invoicecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#receive_items_for_invoicelist',
					success: 		receive_items_for_invoiceshowResponse,
		}; 
		$('#receive_items_for_invoicelistform').ajaxSubmit(options);
		return false;
	}
	
	function receive_items_for_invoiceshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#receive_items_for_invoicelist',
					success: 		receive_items_for_invoiceshowResponse,
		}; 
		
		$('#receive_items_for_invoicelistform').submit(function() { 
			$('#receive_items_for_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function receive_items_for_invoicecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function receive_items_for_invoiceadd()
	{
		$('#receive_items_for_invoiceformholder').load('<?=site_url()."/receive_items_for_invoiceadd/";?>', function()
		{$('#receive_items_for_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#receive_items_for_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#receive_items_for_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#receive_items_for_invoicelist' + '\').load(\'<?=site_url();?>/receive_items_for_invoicelist\');' + ';"></input>');
		});	
	}
	
	function receive_items_for_invoiceedit(id)
	{
		$('#receive_items_for_invoiceformholder').load('<?=site_url()."/receive_items_for_invoiceedit/index/";?>' + id, function()
		{$('#receive_items_for_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#receive_items_for_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#receive_items_for_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#receive_items_for_invoicelist' + '\').load(\'<?=site_url();?>/receive_items_for_invoicelist\');' + ';"></input>');
		});	
	}
	
	function receive_items_for_invoiceview(id)
	{
		$('#receive_items_for_invoiceformholder').load('<?=site_url()."/receive_items_for_invoiceview/index/";?>' + id, function()
		{$('#receive_items_for_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#receive_items_for_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#receive_items_for_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#receive_items_for_invoicelist' + '\').load(\'<?=site_url();?>/receive_items_for_invoicelist\');' + ';"></input>');
		});	
	}
	
	function receive_items_for_invoicegotopage()
	{
		var page = document.receive_items_for_invoicelistform.pageno.options[document.receive_items_for_invoicelistform.pageno.selectedIndex].value;
		
		$("#receive_items_for_invoicecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#receive_items_for_invoicelist',
					success: 		receive_items_for_invoiceshowResponse,
		}; 
		$('#receive_items_for_invoicelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="receive_items_for_invoice-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="receive_items_for_invoiceclosebutton"></div>
		<div id="receive_items_for_invoiceformholder"></div>
		<div id="receive_items_for_invoicelist">
		<!--<form method="post" action="<?=site_url();?>/receive_items_for_invoicelist/index/" id="receive_items_for_invoicelistform" name="receive_items_for_invoicelistform">-->
		<form method="post" action="<?=current_url();?>" id="receive_items_for_invoicelistform" name="receive_items_for_invoicelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="receive_items_for_invoicecurrsort">
			</div>
			<div id="receive_items_for_invoicesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="receive_items_for_invoiceadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/receive_items_for_invoiceadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/receive_items_for_invoiceadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="receive_items_for_invoicesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="receive_items_for_invoicesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="receive_items_for_invoicesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="receive_items_for_invoicesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['receiveditem__date'];?></td><td><?=$row['receiveditem__orderid'];?></td><td><?=$row['receiveditem__suratjalanno'];?></td><td><?php if (isset($row['receiveditem__supplier_id']) && $row['receiveditem__supplier_id'] > 0) echo $row['supplier__firstname'];?></td><td><?php if (isset($row['receiveditem__warehouse_id']) && $row['receiveditem__warehouse_id'] > 0) echo $row['warehouse__name'];?></td><td><?=$row['receiveditem__lastupdate'];?></td><td><?=$row['receiveditem__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="receive_items_for_invoiceview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/receive_items_for_invoiceview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="receive_items_for_invoiceedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/receive_items_for_invoiceedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="receive_items_for_invoiceconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="receive_items_for_invoicegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>