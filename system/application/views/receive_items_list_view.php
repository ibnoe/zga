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
					target:        '#receive_itemslist',
					success: 		receive_itemsshowResponse,
		}; 
		
		$('#receive_itemslistform').submit(function() { 
			$('#receive_itemslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function receive_itemsconfirmdelete(delid, obj)
	{
		$('#receive_items-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', receive_itemsconfirmdelete2(delid, obj));
	}
	
	function receive_itemsconfirmdelete2(delid, obj)
	{
		$( "#receive_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					receive_itemscalldeletefn('receive_itemsdelete', delid, 'receive_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#receive_items-dialog-confirm').html('');
	}
	
	function receive_itemssortupdown(field, direction)
	{
		$("#receive_itemscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#receive_itemslist',
					success: 		receive_itemsshowResponse,
		}; 
		$('#receive_itemslistform').ajaxSubmit(options);
		return false;
	}
	
	function receive_itemsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#receive_itemslist',
					success: 		receive_itemsshowResponse,
		}; 
		
		$('#receive_itemslistform').submit(function() { 
			$('#receive_itemslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function receive_itemscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function receive_itemsadd()
	{
		$('#receive_itemsformholder').load('<?=site_url()."/receive_itemsadd/";?>', function()
		{$('#receive_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#receive_itemsformholder' + '\').html(\'\');' + '$(\'' + '#receive_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#receive_itemslist' + '\').load(\'<?=site_url();?>/receive_itemslist\');' + ';"></input>');
		});	
	}
	
	function receive_itemsedit(id)
	{
		$('#receive_itemsformholder').load('<?=site_url()."/receive_itemsedit/index/";?>' + id, function()
		{$('#receive_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#receive_itemsformholder' + '\').html(\'\');' + '$(\'' + '#receive_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#receive_itemslist' + '\').load(\'<?=site_url();?>/receive_itemslist\');' + ';"></input>');
		});	
	}
	
	function receive_itemsview(id)
	{
		$('#receive_itemsformholder').load('<?=site_url()."/receive_itemsview/index/";?>' + id, function()
		{$('#receive_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#receive_itemsformholder' + '\').html(\'\');' + '$(\'' + '#receive_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#receive_itemslist' + '\').load(\'<?=site_url();?>/receive_itemslist\');' + ';"></input>');
		});	
	}
	
	function receive_itemsgotopage()
	{
		var page = document.receive_itemslistform.pageno.options[document.receive_itemslistform.pageno.selectedIndex].value;
		
		$("#receive_itemscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#receive_itemslist',
					success: 		receive_itemsshowResponse,
		}; 
		$('#receive_itemslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="receive_items-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="receive_itemsclosebutton"></div>
		<div id="receive_itemsformholder"></div>
		<div id="receive_itemslist">
		<!--<form method="post" action="<?=site_url();?>/receive_itemslist/index/" id="receive_itemslistform" name="receive_itemslistform">-->
		<form method="post" action="<?=current_url();?>" id="receive_itemslistform" name="receive_itemslistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="receive_itemscurrsort">
			</div>
			<div id="receive_itemssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="receive_itemsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/receive_itemsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/receive_itemsadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="receive_itemssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="receive_itemssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="receive_itemssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="receive_itemssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/receive_itemsview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('receive_itemsview/index/'.$row['id'], $row['receiveditem__date']);?></td><td><?=$row['receiveditem__orderid'];?></td><td><?=$row['receiveditem__suratjalanno'];?></td><td><?php if (isset($row['receiveditem__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['receiveditem__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['receiveditem__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['receiveditem__warehouse_id'], $row['warehouse__name']);?></td><td><?=$row['receiveditem__lastupdate'];?></td><td><?=$row['receiveditem__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="receive_itemsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/receive_itemsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="receive_itemsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/receive_itemsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="receive_itemsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="receive_itemsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>