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
					target:        '#customerlist',
					success: 		customershowResponse,
		}; 
		
		$('#customerlistform').submit(function() { 
			$('#customerlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function customerconfirmdelete(delid, obj)
	{
		$('#customer-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', customerconfirmdelete2(delid, obj));
	}
	
	function customerconfirmdelete2(delid, obj)
	{
		$( "#customer-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					customercalldeletefn('customerdelete', delid, 'customerlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#customer-dialog-confirm').html('');
	}
	
	function customersortupdown(field, direction)
	{
		$("#customercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#customerlist',
					success: 		customershowResponse,
		}; 
		$('#customerlistform').ajaxSubmit(options);
		return false;
	}
	
	function customershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#customerlist',
					success: 		customershowResponse,
		}; 
		
		$('#customerlistform').submit(function() { 
			$('#customerlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function customercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function customeradd()
	{
		$('#customerformholder').load('<?=site_url()."/customeradd/";?>', function()
		{$('#customerclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#customerformholder' + '\').html(\'\');' + '$(\'' + '#customerclosebutton' + '\').html(\'\');' + '$(\'' + '#customerlist' + '\').load(\'<?=site_url();?>/customerlist\');' + ';"></input>');
		});	
	}
	
	function customeredit(id)
	{
		$('#customerformholder').load('<?=site_url()."/customeredit/index/";?>' + id, function()
		{$('#customerclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#customerformholder' + '\').html(\'\');' + '$(\'' + '#customerclosebutton' + '\').html(\'\');' + '$(\'' + '#customerlist' + '\').load(\'<?=site_url();?>/customerlist\');' + ';"></input>');
		});	
	}
	
	function customerview(id)
	{
		$('#customerformholder').load('<?=site_url()."/customerview/index/";?>' + id, function()
		{$('#customerclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#customerformholder' + '\').html(\'\');' + '$(\'' + '#customerclosebutton' + '\').html(\'\');' + '$(\'' + '#customerlist' + '\').load(\'<?=site_url();?>/customerlist\');' + ';"></input>');
		});	
	}
	
	function customergotopage()
	{
		var page = document.customerlistform.pageno.options[document.customerlistform.pageno.selectedIndex].value;
		
		$("#customercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#customerlist',
					success: 		customershowResponse,
		}; 
		$('#customerlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="customer-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="customerclosebutton"></div>
		<div id="customerformholder"></div>
		<div id="customerlist">
		<!--<form method="post" action="<?=site_url();?>/customerlist/index/" id="customerlistform" name="customerlistform">-->
		<form method="post" action="<?=current_url();?>" id="customerlistform" name="customerlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="customercurrsort">
			</div>
			<div id="customersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="customeradd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/customeradd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/customeradd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="customersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="customersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="customersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="customersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/customerview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('customerview/index/'.$row['id'], $row['customer__idstring']);?></td><td><?=$row['customer__firstname'];?></td><td><?=$row['customer__lastname'];?></td><td><?=$row['customer__address'];?></td><td><?=$row['customer__deliveryrecipient'];?></td><td><?=$row['customer__deliveryaddress'];?></td><td align='right'><?=number_format($row['customer__tax_rate'], 2);?></td><td align='right'><?=number_format($row['customer__discount'], 2);?></td><td><?=$row['customer__top'];?></td><td><?=$row['customer__phone'];?></td><td><?=$row['customer__fax'];?></td><td><?=$row['customer__npwp'];?></td><td><?=$row['customer__email'];?></td><td><?=$row['customer__website'];?></td><td><?php if (isset($row['customer__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['customer__currency_id'], $row['currency__name']);?></td><td><?php if (isset($row['customer__customergroup_id']) && $row['customergroup__name'] != "") echo anchor('company_groupview/index/'.$row['customer__customergroup_id'], $row['customergroup__name']);?></td><td><?php if (isset($row['customer__marketingofficer_id']) && $row['marketingofficer__name'] != "") echo anchor('marketing_officerview/index/'.$row['customer__marketingofficer_id'], $row['marketingofficer__name']);?></td><td><?=$row['customer__status'];?></td><td><?=$row['customer__rating'];?></td><td><?=$row['customer__lastupdate'];?></td><td><?=$row['customer__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="customerview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/customerview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="customeredit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/customeredit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="customerconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="customergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>