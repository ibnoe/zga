<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		/*
		$('a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		*/
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#open_purchase_orderlist',
					success: 		open_purchase_ordershowResponse,
		}; 
		
		$('#open_purchase_orderlistform').submit(function() { 
			$('#open_purchase_orderlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function open_purchase_orderconfirmdelete(delid, obj)
	{
		$('#open_purchase_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_purchase_orderconfirmdelete2(delid, obj));
	}
	
	function open_purchase_orderconfirmdelete2(delid, obj)
	{
		$( "#open_purchase_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_purchase_ordercalldeletefn('open_purchase_orderdelete', delid, 'open_purchase_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_purchase_order-dialog-confirm').html('');
	}
	
	function open_purchase_ordersortupdown(field, direction)
	{
		$("#open_purchase_ordercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#open_purchase_orderlist',
					success: 		open_purchase_ordershowResponse,
		}; 
		$('#open_purchase_orderlistform').ajaxSubmit(options);
		return false;
	}
	
	function open_purchase_ordershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#open_purchase_orderlist',
					success: 		open_purchase_ordershowResponse,
		}; 
		
		$('#open_purchase_orderlistform').submit(function() { 
			$('#open_purchase_orderlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function open_purchase_ordercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function open_purchase_orderadd()
	{
		$('#open_purchase_orderformholder').load('<?=site_url()."/open_purchase_orderadd/";?>', function()
		{$('#open_purchase_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_purchase_orderformholder' + '\').html(\'\');' + '$(\'' + '#open_purchase_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#open_purchase_orderlist' + '\').load(\'<?=site_url();?>/open_purchase_orderlist\');' + ';"></input>');
		});	
	}
	
	function open_purchase_orderedit(id)
	{
		$('#open_purchase_orderformholder').load('<?=site_url()."/open_purchase_orderedit/index/";?>' + id, function()
		{$('#open_purchase_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_purchase_orderformholder' + '\').html(\'\');' + '$(\'' + '#open_purchase_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#open_purchase_orderlist' + '\').load(\'<?=site_url();?>/open_purchase_orderlist\');' + ';"></input>');
		});	
	}
	
	function open_purchase_orderview(id)
	{
		$('#open_purchase_orderformholder').load('<?=site_url()."/open_purchase_orderview/index/";?>' + id, function()
		{$('#open_purchase_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_purchase_orderformholder' + '\').html(\'\');' + '$(\'' + '#open_purchase_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#open_purchase_orderlist' + '\').load(\'<?=site_url();?>/open_purchase_orderlist\');' + ';"></input>');
		});	
	}
	
	function open_purchase_ordergotopage()
	{
		var page = document.open_purchase_orderlistform.pageno.options[document.open_purchase_orderlistform.pageno.selectedIndex].value;
		
		$("#open_purchase_ordercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#open_purchase_orderlist',
					success: 		open_purchase_ordershowResponse,
		}; 
		$('#open_purchase_orderlistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="open_purchase_order-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="open_purchase_orderclosebutton"></div>
		<div id="open_purchase_orderformholder"></div>
		<div id="open_purchase_orderlist">
		<form method="post" action="<?=site_url();?>/open_purchase_orderlist/index/" id="open_purchase_orderlistform" name="open_purchase_orderlistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="open_purchase_ordercurrsort">
			</div>
			<div id="open_purchase_ordersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="open_purchase_orderadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_purchase_orderadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_purchase_orderadd/index/";?>')">
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
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="open_purchase_ordersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="open_purchase_ordersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="open_purchase_ordersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="open_purchase_ordersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['porder__orderid'];?></td><td><?=$row['porder__date'];?></td><td><?=$row['porder__notes'];?></td><td><?=anchor('supplierview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=anchor('currencyview/index/'.$row['id'], $row['currency__name']);?></td><td><?=$row['porder__currencyrate'];?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=$row['porder__taxable'];?></td><td><?=$row['porder__taxincluded'];?></td><td><?=$row['porder__'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="open_purchase_orderview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/open_purchase_orderview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="open_purchase_orderedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_purchase_orderedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="open_purchase_orderconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="open_purchase_ordergotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>