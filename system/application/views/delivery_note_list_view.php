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
					target:        '#delivery_notelist',
					success: 		delivery_noteshowResponse,
		}; 
		
		$('#delivery_notelistform').submit(function() { 
			$('#delivery_notelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function delivery_noteconfirmdelete(delid, obj)
	{
		$('#delivery_note-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', delivery_noteconfirmdelete2(delid, obj));
	}
	
	function delivery_noteconfirmdelete2(delid, obj)
	{
		$( "#delivery_note-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					delivery_notecalldeletefn('delivery_notedelete', delid, 'delivery_notelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#delivery_note-dialog-confirm').html('');
	}
	
	function delivery_notesortupdown(field, direction)
	{
		$("#delivery_notecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#delivery_notelist',
					success: 		delivery_noteshowResponse,
		}; 
		$('#delivery_notelistform').ajaxSubmit(options);
		return false;
	}
	
	function delivery_noteshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#delivery_notelist',
					success: 		delivery_noteshowResponse,
		}; 
		
		$('#delivery_notelistform').submit(function() { 
			$('#delivery_notelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function delivery_notecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function delivery_noteadd()
	{
		$('#delivery_noteformholder').load('<?=site_url()."/delivery_noteadd/";?>', function()
		{$('#delivery_noteclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_noteformholder' + '\').html(\'\');' + '$(\'' + '#delivery_noteclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_notelist' + '\').load(\'<?=site_url();?>/delivery_notelist\');' + ';"></input>');
		});	
	}
	
	function delivery_noteedit(id)
	{
		$('#delivery_noteformholder').load('<?=site_url()."/delivery_noteedit/index/";?>' + id, function()
		{$('#delivery_noteclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_noteformholder' + '\').html(\'\');' + '$(\'' + '#delivery_noteclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_notelist' + '\').load(\'<?=site_url();?>/delivery_notelist\');' + ';"></input>');
		});	
	}
	
	function delivery_noteview(id)
	{
		$('#delivery_noteformholder').load('<?=site_url()."/delivery_noteview/index/";?>' + id, function()
		{$('#delivery_noteclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_noteformholder' + '\').html(\'\');' + '$(\'' + '#delivery_noteclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_notelist' + '\').load(\'<?=site_url();?>/delivery_notelist\');' + ';"></input>');
		});	
	}
	
	function delivery_notegotopage()
	{
		var page = document.delivery_notelistform.pageno.options[document.delivery_notelistform.pageno.selectedIndex].value;
		
		$("#delivery_notecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#delivery_notelist',
					success: 		delivery_noteshowResponse,
		}; 
		$('#delivery_notelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="delivery_note-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="delivery_noteclosebutton"></div>
		<div id="delivery_noteformholder"></div>
		<div id="delivery_notelist">
		<!--<form method="post" action="<?=site_url();?>/delivery_notelist/index/" id="delivery_notelistform" name="delivery_notelistform">-->
		<form method="post" action="<?=current_url();?>" id="delivery_notelistform" name="delivery_notelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="delivery_notecurrsort">
			</div>
			<div id="delivery_notesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="delivery_noteadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/delivery_noteadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/delivery_noteadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="delivery_notesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="delivery_notesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="delivery_notesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="delivery_notesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/delivery_noteview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('delivery_orderview/index/'.$row['id'], $row['deliveryorder__date']);?></td><td><?=$row['deliveryorder__orderid'];?></td><td><?=$row['deliveryorder__donum'];?></td><td><?=$row['deliveryorder__dodate'];?></td><td><?php if (isset($row['deliveryorder__customer_id']) && $row['deliveryorder__customer_id'] > 0) echo anchor('customerview/index/'.$row['deliveryorder__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['deliveryorder__warehouse_id']) && $row['deliveryorder__warehouse_id'] > 0) echo anchor('warehouseview/index/'.$row['deliveryorder__warehouse_id'], $row['warehouse__name']);?></td><td><?=$row['deliveryorder__deliveredby'];?></td><td><?=$row['deliveryorder__vehicleno'];?></td><td><?=$row['deliveryorder__notes'];?></td><td><?=$row['deliveryorder__lastupdate'];?></td><td><?=$row['deliveryorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="delivery_noteview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/delivery_noteview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="delivery_noteedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/delivery_noteedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="delivery_noteconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="delivery_notegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>