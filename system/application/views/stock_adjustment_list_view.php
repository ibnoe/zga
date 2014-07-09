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
					target:        '#stock_adjustmentlist',
					success: 		stock_adjustmentshowResponse,
		}; 
		
		$('#stock_adjustmentlistform').submit(function() { 
			$('#stock_adjustmentlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function stock_adjustmentconfirmdelete(delid, obj)
	{
		$('#stock_adjustment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', stock_adjustmentconfirmdelete2(delid, obj));
	}
	
	function stock_adjustmentconfirmdelete2(delid, obj)
	{
		$( "#stock_adjustment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					stock_adjustmentcalldeletefn('stock_adjustmentdelete', delid, 'stock_adjustmentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_adjustment-dialog-confirm').html('');
	}
	
	function stock_adjustmentsortupdown(field, direction)
	{
		$("#stock_adjustmentcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#stock_adjustmentlist',
					success: 		stock_adjustmentshowResponse,
		}; 
		$('#stock_adjustmentlistform').ajaxSubmit(options);
		return false;
	}
	
	function stock_adjustmentshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#stock_adjustmentlist',
					success: 		stock_adjustmentshowResponse,
		}; 
		
		$('#stock_adjustmentlistform').submit(function() { 
			$('#stock_adjustmentlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function stock_adjustmentcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function stock_adjustmentadd()
	{
		$('#stock_adjustmentformholder').load('<?=site_url()."/stock_adjustmentadd/";?>', function()
		{$('#stock_adjustmentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_adjustmentformholder' + '\').html(\'\');' + '$(\'' + '#stock_adjustmentclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_adjustmentlist' + '\').load(\'<?=site_url();?>/stock_adjustmentlist\');' + ';"></input>');
		});	
	}
	
	function stock_adjustmentedit(id)
	{
		$('#stock_adjustmentformholder').load('<?=site_url()."/stock_adjustmentedit/index/";?>' + id, function()
		{$('#stock_adjustmentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_adjustmentformholder' + '\').html(\'\');' + '$(\'' + '#stock_adjustmentclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_adjustmentlist' + '\').load(\'<?=site_url();?>/stock_adjustmentlist\');' + ';"></input>');
		});	
	}
	
	function stock_adjustmentview(id)
	{
		$('#stock_adjustmentformholder').load('<?=site_url()."/stock_adjustmentview/index/";?>' + id, function()
		{$('#stock_adjustmentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#stock_adjustmentformholder' + '\').html(\'\');' + '$(\'' + '#stock_adjustmentclosebutton' + '\').html(\'\');' + '$(\'' + '#stock_adjustmentlist' + '\').load(\'<?=site_url();?>/stock_adjustmentlist\');' + ';"></input>');
		});	
	}
	
	function stock_adjustmentgotopage()
	{
		var page = document.stock_adjustmentlistform.pageno.options[document.stock_adjustmentlistform.pageno.selectedIndex].value;
		
		$("#stock_adjustmentcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#stock_adjustmentlist',
					success: 		stock_adjustmentshowResponse,
		}; 
		$('#stock_adjustmentlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="stock_adjustment-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="stock_adjustmentclosebutton"></div>
		<div id="stock_adjustmentformholder"></div>
		<div id="stock_adjustmentlist">
		<!--<form method="post" action="<?=site_url();?>/stock_adjustmentlist/index/" id="stock_adjustmentlistform" name="stock_adjustmentlistform">-->
		<form method="post" action="<?=current_url();?>" id="stock_adjustmentlistform" name="stock_adjustmentlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="stock_adjustmentcurrsort">
			</div>
			<div id="stock_adjustmentsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="stock_adjustmentadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/stock_adjustmentadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/stock_adjustmentadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="stock_adjustmentsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="stock_adjustmentsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="stock_adjustmentsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="stock_adjustmentsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/stock_adjustmentview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('stock_adjustmentview/index/'.$row['id'], $row['stockadjustment__idstring']);?></td><td><?=$row['stockadjustment__date'];?></td><td><?=$row['stockadjustment__notes'];?></td><td><?php if (isset($row['stockadjustment__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['stockadjustment__warehouse_id'], $row['warehouse__name']);?></td><td><?=$row['stockadjustment__lastupdate'];?></td><td><?=$row['stockadjustment__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="stock_adjustmentview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/stock_adjustmentview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="stock_adjustmentedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/stock_adjustmentedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="stock_adjustmentconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="stock_adjustmentgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>