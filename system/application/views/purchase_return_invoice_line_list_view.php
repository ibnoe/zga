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
					target:        '#purchase_return_invoice_linelist',
					success: 		purchase_return_invoice_lineshowResponse,
		}; 
		
		$('#purchase_return_invoice_linelistform').submit(function() { 
			$('#purchase_return_invoice_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_return_invoice_lineconfirmdelete(delid, obj)
	{
		$('#purchase_return_invoice_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_invoice_lineconfirmdelete2(delid, obj));
	}
	
	function purchase_return_invoice_lineconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_invoice_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_invoice_linecalldeletefn('purchase_return_invoice_linedelete', delid, 'purchase_return_invoice_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_invoice_line-dialog-confirm').html('');
	}
	
	function purchase_return_invoice_linesortupdown(field, direction)
	{
		$("#purchase_return_invoice_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_return_invoice_linelist',
					success: 		purchase_return_invoice_lineshowResponse,
		}; 
		$('#purchase_return_invoice_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_return_invoice_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_return_invoice_linelist',
					success: 		purchase_return_invoice_lineshowResponse,
		}; 
		
		$('#purchase_return_invoice_linelistform').submit(function() { 
			$('#purchase_return_invoice_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_return_invoice_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_return_invoice_lineadd()
	{
		$('#purchase_return_invoice_lineformholder').load('<?=site_url()."/purchase_return_invoice_lineadd/";?>', function()
		{$('#purchase_return_invoice_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_invoice_lineformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoice_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoice_linelist' + '\').load(\'<?=site_url();?>/purchase_return_invoice_linelist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_invoice_lineedit(id)
	{
		$('#purchase_return_invoice_lineformholder').load('<?=site_url()."/purchase_return_invoice_lineedit/index/";?>' + id, function()
		{$('#purchase_return_invoice_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_invoice_lineformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoice_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoice_linelist' + '\').load(\'<?=site_url();?>/purchase_return_invoice_linelist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_invoice_lineview(id)
	{
		$('#purchase_return_invoice_lineformholder').load('<?=site_url()."/purchase_return_invoice_lineview/index/";?>' + id, function()
		{$('#purchase_return_invoice_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_return_invoice_lineformholder' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoice_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_return_invoice_linelist' + '\').load(\'<?=site_url();?>/purchase_return_invoice_linelist\');' + ';"></input>');
		});	
	}
	
	function purchase_return_invoice_linegotopage()
	{
		var page = document.purchase_return_invoice_linelistform.pageno.options[document.purchase_return_invoice_linelistform.pageno.selectedIndex].value;
		
		$("#purchase_return_invoice_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_return_invoice_linelist',
					success: 		purchase_return_invoice_lineshowResponse,
		}; 
		$('#purchase_return_invoice_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchase_return_invoice_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_return_invoice_lineclosebutton"></div>
		<div id="purchase_return_invoice_lineformholder"></div>
		<div id="purchase_return_invoice_linelist">
		<!--<form method="post" action="<?=site_url();?>/purchase_return_invoice_linelist/index/" id="purchase_return_invoice_linelistform" name="purchase_return_invoice_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="purchase_return_invoice_linelistform" name="purchase_return_invoice_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_return_invoice_linecurrsort">
			</div>
			<div id="purchase_return_invoice_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="purchase_return_invoice_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_return_invoice_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_return_invoice_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="purchase_return_invoice_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_return_invoice_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchase_return_invoice_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_return_invoice_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/purchase_return_invoice_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['purchasereturninvoiceline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['purchasereturninvoiceline__item_id'], $row['item__name']);?></td><td><?=anchor('purchase_return_invoice_lineview/index/'.$row['id'], $row['purchasereturninvoiceline__quantity']);?></td><td><?php if (isset($row['purchasereturninvoiceline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['purchasereturninvoiceline__uom_id'], $row['uom__name']);?></td><td><?=number_format($row['purchasereturninvoiceline__price'], 2);?></td><td><?=number_format($row['purchasereturninvoiceline__subtotal'], 2);?></td><td><?=$row['purchasereturninvoiceline__lastupdate'];?></td><td><?=$row['purchasereturninvoiceline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_return_invoice_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_return_invoice_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_return_invoice_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_invoice_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_invoice_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_return_invoice_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>