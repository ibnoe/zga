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
					target:        '#sales_return_payment_linelist',
					success: 		sales_return_payment_lineshowResponse,
		}; 
		
		$('#sales_return_payment_linelistform').submit(function() { 
			$('#sales_return_payment_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_return_payment_lineconfirmdelete(delid, obj)
	{
		$('#sales_return_payment_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_payment_lineconfirmdelete2(delid, obj));
	}
	
	function sales_return_payment_lineconfirmdelete2(delid, obj)
	{
		$( "#sales_return_payment_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_payment_linecalldeletefn('sales_return_payment_linedelete', delid, 'sales_return_payment_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_payment_line-dialog-confirm').html('');
	}
	
	function sales_return_payment_linesortupdown(field, direction)
	{
		$("#sales_return_payment_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_return_payment_linelist',
					success: 		sales_return_payment_lineshowResponse,
		}; 
		$('#sales_return_payment_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_return_payment_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_return_payment_linelist',
					success: 		sales_return_payment_lineshowResponse,
		}; 
		
		$('#sales_return_payment_linelistform').submit(function() { 
			$('#sales_return_payment_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_return_payment_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_return_payment_lineadd()
	{
		$('#sales_return_payment_lineformholder').load('<?=site_url()."/sales_return_payment_lineadd/";?>', function()
		{$('#sales_return_payment_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_payment_lineformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_payment_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_payment_linelist' + '\').load(\'<?=site_url();?>/sales_return_payment_linelist\');' + ';"></input>');
		});	
	}
	
	function sales_return_payment_lineedit(id)
	{
		$('#sales_return_payment_lineformholder').load('<?=site_url()."/sales_return_payment_lineedit/index/";?>' + id, function()
		{$('#sales_return_payment_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_payment_lineformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_payment_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_payment_linelist' + '\').load(\'<?=site_url();?>/sales_return_payment_linelist\');' + ';"></input>');
		});	
	}
	
	function sales_return_payment_lineview(id)
	{
		$('#sales_return_payment_lineformholder').load('<?=site_url()."/sales_return_payment_lineview/index/";?>' + id, function()
		{$('#sales_return_payment_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_payment_lineformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_payment_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_payment_linelist' + '\').load(\'<?=site_url();?>/sales_return_payment_linelist\');' + ';"></input>');
		});	
	}
	
	function sales_return_payment_linegotopage()
	{
		var page = document.sales_return_payment_linelistform.pageno.options[document.sales_return_payment_linelistform.pageno.selectedIndex].value;
		
		$("#sales_return_payment_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_return_payment_linelist',
					success: 		sales_return_payment_lineshowResponse,
		}; 
		$('#sales_return_payment_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_return_payment_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_return_payment_lineclosebutton"></div>
		<div id="sales_return_payment_lineformholder"></div>
		<div id="sales_return_payment_linelist">
		<!--<form method="post" action="<?=site_url();?>/sales_return_payment_linelist/index/" id="sales_return_payment_linelistform" name="sales_return_payment_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_return_payment_linelistform" name="sales_return_payment_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_return_payment_linecurrsort">
			</div>
			<div id="sales_return_payment_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="sales_return_payment_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_payment_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_payment_lineadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_return_payment_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_return_payment_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_return_payment_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_return_payment_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/sales_return_payment_lineview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['salesreturnpaymentline__salesreturninvoice_id']) && $row['salesreturninvoice__salesreturninvoiceid'] != "") echo anchor('sales_return_invoiceview/index/'.$row['salesreturnpaymentline__salesreturninvoice_id'], $row['salesreturninvoice__salesreturninvoiceid']);?></td><td><?=$row['salesreturnpaymentline__lastupdate'];?></td><td><?=$row['salesreturnpaymentline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_return_payment_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_return_payment_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_return_payment_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_payment_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_payment_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_return_payment_linegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>