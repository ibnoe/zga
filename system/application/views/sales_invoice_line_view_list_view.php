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
					target:        '#sales_invoice_line_viewlist',
					success: 		sales_invoice_line_viewshowResponse,
		}; 
		
		$('#sales_invoice_line_viewlistform').submit(function() { 
			$('#sales_invoice_line_viewlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_invoice_line_viewconfirmdelete(delid, obj)
	{
		$('#sales_invoice_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_invoice_line_viewconfirmdelete2(delid, obj));
	}
	
	function sales_invoice_line_viewconfirmdelete2(delid, obj)
	{
		$( "#sales_invoice_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_invoice_line_viewcalldeletefn('sales_invoice_line_viewdelete', delid, 'sales_invoice_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_invoice_line_view-dialog-confirm').html('');
	}
	
	function sales_invoice_line_viewsortupdown(field, direction)
	{
		$("#sales_invoice_line_viewcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_invoice_line_viewlist',
					success: 		sales_invoice_line_viewshowResponse,
		}; 
		$('#sales_invoice_line_viewlistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_invoice_line_viewshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_invoice_line_viewlist',
					success: 		sales_invoice_line_viewshowResponse,
		}; 
		
		$('#sales_invoice_line_viewlistform').submit(function() { 
			$('#sales_invoice_line_viewlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_invoice_line_viewcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_invoice_line_viewadd()
	{
		$('#sales_invoice_line_viewformholder').load('<?=site_url()."/sales_invoice_line_viewadd/";?>', function()
		{$('#sales_invoice_line_viewclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_invoice_line_viewformholder' + '\').html(\'\');' + '$(\'' + '#sales_invoice_line_viewclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_invoice_line_viewlist' + '\').load(\'<?=site_url();?>/sales_invoice_line_viewlist\');' + ';"></input>');
		});	
	}
	
	function sales_invoice_line_viewedit(id)
	{
		$('#sales_invoice_line_viewformholder').load('<?=site_url()."/sales_invoice_line_viewedit/index/";?>' + id, function()
		{$('#sales_invoice_line_viewclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_invoice_line_viewformholder' + '\').html(\'\');' + '$(\'' + '#sales_invoice_line_viewclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_invoice_line_viewlist' + '\').load(\'<?=site_url();?>/sales_invoice_line_viewlist\');' + ';"></input>');
		});	
	}
	
	function sales_invoice_line_viewview(id)
	{
		$('#sales_invoice_line_viewformholder').load('<?=site_url()."/sales_invoice_line_viewview/index/";?>' + id, function()
		{$('#sales_invoice_line_viewclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_invoice_line_viewformholder' + '\').html(\'\');' + '$(\'' + '#sales_invoice_line_viewclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_invoice_line_viewlist' + '\').load(\'<?=site_url();?>/sales_invoice_line_viewlist\');' + ';"></input>');
		});	
	}
	
	function sales_invoice_line_viewgotopage()
	{
		var page = document.sales_invoice_line_viewlistform.pageno.options[document.sales_invoice_line_viewlistform.pageno.selectedIndex].value;
		
		$("#sales_invoice_line_viewcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_invoice_line_viewlist',
					success: 		sales_invoice_line_viewshowResponse,
		}; 
		$('#sales_invoice_line_viewlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_invoice_line_view-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_invoice_line_viewclosebutton"></div>
		<div id="sales_invoice_line_viewformholder"></div>
		<div id="sales_invoice_line_viewlist">
		<!--<form method="post" action="<?=site_url();?>/sales_invoice_line_viewlist/index/" id="sales_invoice_line_viewlistform" name="sales_invoice_line_viewlistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_invoice_line_viewlistform" name="sales_invoice_line_viewlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_invoice_line_viewcurrsort">
			</div>
			<div id="sales_invoice_line_viewsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="sales_invoice_line_viewadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_invoice_line_viewadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_invoice_line_viewadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_invoice_line_viewsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_invoice_line_viewsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_invoice_line_viewsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_invoice_line_viewsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/sales_invoice_line_viewview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['salesinvoiceline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['salesinvoiceline__item_id'], $row['item__name']);?></td><td><?=anchor('sales_invoice_line_viewview/index/'.$row['id'], $row['salesinvoiceline__quantity']);?></td><td><?php if (isset($row['salesinvoiceline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['salesinvoiceline__uom_id'], $row['uom__name']);?></td><td><?=number_format($row['salesinvoiceline__price'], 2);?></td><td><?=number_format($row['salesinvoiceline__subtotal'], 2);?></td><td><?=$row['salesinvoiceline__lastupdate'];?></td><td><?=$row['salesinvoiceline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_invoice_line_viewview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_invoice_line_viewview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_invoice_line_viewedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_invoice_line_viewedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_invoice_line_viewconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_invoice_line_viewgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>